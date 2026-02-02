<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Membre;
use App\Models\Tblotp;
use App\Models\Tblrdv;
use App\Models\Contrat;
use App\Models\Signature;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MembreContrat;
use App\Models\TblPrestation;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TblDocPrestation;
use App\Models\TblTypePrestation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\TblProductPrestation;
use Illuminate\Support\Facades\Http;
use App\Models\TblMotifrejetbyprestat;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PrestationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $prestations = TblPrestation::where('etat', 'Actif')->with('docPrestation', 'otp', 'membre')->get();
        // dd($prestations);
        return view('prestations.index');
    }

    public function selectPrestation()
    {
        // $typePrestations = TblTypePrestation::where('etat', 'Actif')->get();
        // dd($contractDetails, $membreDetails);
        if (!session()->has('contractDetails')) {
            return redirect()->route('prestation.index');
        }else{
            $contract = session('contractDetails', []);
            $contractDetails = $contract['details'][0] ?? [];
            $membreDetails   = $contract['membre'] ?? [];
            $NbrencConfirmer = session('NbrencConfirmer', 0);
            // $contratDetails = session('contractDetails', null);
            $cumulCotisationTerme = session('cumulCotisationTerme', 0);
            $contisationPourcentage = session('contisationPourcentage', 0);
            $TotalEncaissement = session('TotalEncaissement', 0);
            $ProductPrestations = TblProductPrestation::where('product_id', $contractDetails['codeProduit'])->get();
            // Utilisation de pluck() si la relation est une simple clé étrangère
            $typePrestations = $ProductPrestations->pluck('prestation');
            $typePrestationAutre = TblTypePrestation::where('impact', 'Autre')->where('etat', 'Actif')->first();
        }
        return view('prestations.selectPrestation', compact('typePrestations', 'contractDetails', 'membreDetails', 'typePrestationAutre', 'NbrencConfirmer', 'cumulCotisationTerme', 'contisationPourcentage', 'TotalEncaissement'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function printFichePrestation()
    {
        // $prestation = TblPrestation::where('id', $id)->first();

       
        // Génération de QR Code en base64
        $qrcode = base64_encode(QrCode::format('svg')->size(80)->generate("http://yakoafrica_live.test/espace-client/prestation/getInfoPrestation/1"));
        $prestation = TblPrestation::where('id', 2)->first();
         $imageUrl = env('SIGN_API') . "api/get-signature/" . $prestation->code . "/E-PRESTATION";
        if ($imageUrl != null || $imageUrl != '') {
            $imageData = file_get_contents($imageUrl);
            $base64Image = base64_encode($imageData);
            $imageSrc = 'data:image/png;base64,' . $base64Image;
        } else {
            $imageSrc = '';
        }
        $pdf = Pdf::loadView('prestations.fiches.courrier', compact('qrcode', 'prestation', 'imageSrc'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true, // Permet le chargement des ressources distantes si nécessaire
                'margin-left' => 0,
                'margin-right' => 0,
                'margin-top' => 0,
                'margin-bottom' => 0,
            ]);

        $fileName = 'Prestation.pdf';
        return $pdf->stream($fileName);
        // $PrestationDir = public_path('documents/prestations/');
        // if (!is_dir($PrestationDir)) {
        //     mkdir($PrestationDir, 0777, true);
        // }
        // $pdf->save($PrestationDir . $fileName);
        // return view('prestations.fiches.prestation');
    }

    public function getInfoPrestation(string $id)
    {
        $prestation = TblPrestation::where('id', $id)->first();
        // dd($prestation);
        return view('prestations.fiches.infoPrestByQrcode', compact('prestation'));
    }
    public function fetchContractDetails(Request $request)
    {
        $idcontrat = $request->input('idcontrat');
        if (!$idcontrat) {
            return response()->json([
                'status' => 'error',
                'message' => 'Aucun contrat sélectionné.',
            ], 400);
        }

        try {
            // Utiliser Guzzle directement pour un meilleur contrôle
            $response = Http::withOptions(['timeout' => 60])
                ->post(config('services.api.encaissement_bis'), [
                    'idContrat' => $idcontrat,
                ]);

            if ($response->successful()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $response->json(),
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Impossible de récupérer les informations du contrat.',
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur s\'est produite : ' . $e->getMessage(),
            ], 500);
        }
    }

    public function fetchCustomerDetails(Request $request)
    {
        $idcontrat = $request->input('idcontrat');
        session(['idcontrat' => $idcontrat]);
        if (!$idcontrat) {
            // retourner une erreur ou un message d'erreur approprié en json
            return response()->json([
                'type' => 'error',
                'urlback' => '', // URL du PDF
                'message' => "Aucun ID de contrat fourni.",
                'code' => 400,
            ]);
        }

        try {
            $response = Http::withOptions(['timeout' => 60])
                ->post(config('services.api.encaissement_bis'), [
                    'idContrat' => $idcontrat,
                ]);

            $contractAdherent   = Contrat::where('idproposition', $idcontrat)->with('adherent')->first();

            if ($response->successful()) {
                $data = $response->json();
                $data['membre'] = $contractAdherent->adherent ?? [];
                if (!empty($data['details']) && !empty($data['enc']['confirmer'])) {
                    // Stocker les informations dans la session pour l'utiliser après redirection
                    session(['contractDetails' => $data]);
                    session(['details' => $data['details'][0]]);
                    session(['encConfirmer' => $data['enc']['confirmer']]);
                    session(['NbrencConfirmer' => count($data['enc']['confirmer'])]);
                    $NbrencConfirmer = session('NbrencConfirmer', 0);
                    $prime = (float) $data['details'][0]['TotalPrime'];
                    // $TotalEncaissement = 0
                    $TotalEncaissement = array_sum(array_map(function ($item) {
                        return isset($item['RegltMontant']) ? (float) $item['RegltMontant'] : 0;
                    }, $data['enc']['confirmer']));
                    
                    // $TotalEncaissement = (float) $NbrencConfirmer * $prime;
                    $DureeCotisationMois = ((float) $data['details'][0]['DureeCotisationAns'] * 12);
                    

                    switch ($data['details'][0]['periodicite']) {
                        case "M":
                            $Duree = $DureeCotisationMois;
                            break;
                        case "T":
                            $Duree = $DureeCotisationMois / 3; // Trimestriel = tous les 3 mois
                            break;
                        case "S":
                            $Duree = $DureeCotisationMois / 6; // Semestriel = tous les 6 mois
                            break;
                        case "A":
                            $Duree = $DureeCotisationMois / 12; // Annuel = tous les 12 mois
                            break;
                        case "U":
                            $Duree = $NbrencConfirmer; // Annuel = tous les 12 mois
                            break;
                        default:
                            $Duree = 0; // Gérer les cas non définis
                            break;
                    }
                    
                    // calculer le cumul des Cotisation à Terme du contrat
                    $cumulCotisationTerme = $Duree * $prime;
                    // calculer 15% du cumul des Cotisation à Terme du contrat
                    $contisationPourcentage = $cumulCotisationTerme * 0.10;
                    session(['contisationPourcentage' => $contisationPourcentage]);
                    session(['cumulCotisationTerme' => $cumulCotisationTerme]);
                    session(['TotalEncaissement' => $TotalEncaissement]);

                    // afficher le dernier encaissement
                    $dernierEncaissement = end($data['enc']['confirmer']);
                    session(['dernierEncaissement' => $dernierEncaissement]);
                    session(['payeur' => $data['payeur']]);

                    session([
                        'contratActeur' => $data['allActeur'] ?? [],
                        'contratActeurAssure' => collect($data['allActeur'])->where('CodeRole', 'ASS') ?? [],
                        'contratActeurPayeur' => collect($data['allActeur'])->where('CodeRole', 'PAY') ?? [],
                        'contratActeurBeneficiaire' => collect($data['allActeur'])->where('CodeRole', 'BEN') ?? [],
                    ]);
                    
                    if ($data['details'][0]['OnStdbyOff'] != "1") {
                        return response()->json([
                            'type' => 'error',
                            'urlback' => '', // URL du PDF
                            'message' => 'Ce contrat est arreté ou en veille.',
                            'code' => 400,
                        ]);
                    } else {
                        return response()->json([
                            'type' => 'success',
                            'urlback' =>route('prestation.selectPrestation'), // URL du PDF
                            'message' => 'Détails du contrat récupérer.',
                            'code' => 200,
                        ]);
                    }
                }

                return response()->json([
                    'type' => 'error',
                    'urlback' => '', // URL du PDF
                    'message' => 'Aucun détail trouvé pour ce contrat.',
                    'code' => 400,
                ]);
            }

            return response()->json([
                'type' => 'error',
                'urlback' => '', // URL du PDF
                'message' => "Erreur : Impossible de récupérer les informations du contrat.",
                'code' => 400,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'urlback' => '', // URL du PDF
                'message' => 'Une erreur s\'est produite : ' . $e->getMessage(),
                'code' => 400,
            ]);
        }
    }


    public function modifyInfosPerso($idcontrat)
    {
        // $idcontrat = $request->input('idcontrat');
        session(['idcontrat' => $idcontrat]);
        $typePrestationAutre = TblTypePrestation::where('impact', 'Autre')->where('etat', 'Actif')->first();
        if (!$idcontrat) {
            // retourner une erreur ou un message d'erreur approprié en json
            return response()->json([
                'type' => 'error',
                'urlback' => '', // URL du PDF
                'message' => "Aucun ID de contrat fourni.",
                'code' => 400,
            ]);
        }

        try {
            $response = Http::withOptions(['timeout' => 60])
                ->post(config('services.api.encaissement_bis'), [
                    'idContrat' => $idcontrat,
                ]);

            $contractAdherent   = Contrat::where('idproposition', $idcontrat)->with('adherent')->first();

            if ($response->successful()) {
                $data = $response->json();
                $data['membre'] = $contractAdherent->adherent ?? [];
                if (!empty($data['details']) && !empty($data['enc']['confirmer'])) {
                    // Stocker les informations dans la session pour l'utiliser après redirection
                    session(['contractDetails' => $data]);
                    session(['details' => $data['details'][0]]);
                    session(['encConfirmer' => $data['enc']['confirmer']]);
                    session(['NbrencConfirmer' => count($data['enc']['confirmer'])]);
                    $NbrencConfirmer = session('NbrencConfirmer', 0);
                    $prime = (float) $data['details'][0]['TotalPrime'];
                    // $TotalEncaissement = 0
                    $TotalEncaissement = array_sum(array_map(function ($item) {
                        return isset($item['RegltMontant']) ? (float) $item['RegltMontant'] : 0;
                    }, $data['enc']['confirmer']));
                    
                    // $TotalEncaissement = (float) $NbrencConfirmer * $prime;
                    $DureeCotisationMois = ((float) $data['details'][0]['DureeCotisationAns'] * 12);
                    

                    switch ($data['details'][0]['periodicite']) {
                        case "M":
                            $Duree = $DureeCotisationMois;
                            break;
                        case "T":
                            $Duree = $DureeCotisationMois / 3; // Trimestriel = tous les 3 mois
                            break;
                        case "S":
                            $Duree = $DureeCotisationMois / 6; // Semestriel = tous les 6 mois
                            break;
                        case "A":
                            $Duree = $DureeCotisationMois / 12; // Annuel = tous les 12 mois
                            break;
                        case "U":
                            $Duree = $NbrencConfirmer; // Annuel = tous les 12 mois
                            break;
                        default:
                            $Duree = 0; // Gérer les cas non définis
                            break;
                    }
                    
                    // calculer le cumul des Cotisation à Terme du contrat
                    $cumulCotisationTerme = $Duree * $prime;
                    // calculer 15% du cumul des Cotisation à Terme du contrat
                    $contisationPourcentage = $cumulCotisationTerme * 0.15;
                    session(['contisationPourcentage' => $contisationPourcentage]);
                    session(['cumulCotisationTerme' => $cumulCotisationTerme]);
                    session(['TotalEncaissement' => $TotalEncaissement]);

                    // afficher le dernier encaissement
                    $dernierEncaissement = end($data['enc']['confirmer']);
                    session(['dernierEncaissement' => $dernierEncaissement]);
                    session(['payeur' => $data['payeur']]);

                    session([
                        'contratActeur' => $data['allActeur'] ?? [],
                        'contratActeurAssure' => collect($data['allActeur'])->where('CodeRole', 'ASS') ?? [],
                        'contratActeurPayeur' => collect($data['allActeur'])->where('CodeRole', 'PAY') ?? [],
                        'contratActeurBeneficiaire' => collect($data['allActeur'])->where('CodeRole', 'BEN') ?? [],
                    ]);
                    
                    if ($data['details'][0]['OnStdbyOff'] != "1") {
                        return response()->json([
                            'type' => 'error',
                            'urlback' => '', // URL du PDF
                            'message' => 'Ce contrat est arreté ou en veille.',
                            'code' => 400,
                        ]);
                    } else {
                        return response()->json([
                            'type' => 'success',
                            'urlback' =>route('prestation.autre', $typePrestationAutre->id),
                            'message' => '',
                            'code' => 200,
                        ]);
                    }
                }

                return response()->json([
                    'type' => 'error',
                    'urlback' => '', // URL du PDF
                    'message' => 'Aucun détail trouvé pour ce contrat.',
                    'code' => 400,
                ]);
            }

            return response()->json([
                'type' => 'error',
                'urlback' => '', // URL du PDF
                'message' => "Erreur : Impossible de récupérer les informations du contrat.",
                'code' => 400,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'urlback' => '', // URL du PDF
                'message' => 'Une erreur s\'est produite : ' . $e->getMessage(),
                'code' => 400,
            ]);
        }
    }

    
    public function create(string $id)
    {
        $idcontrat = session('idcontrat');
        if (!session()->has('contractDetails')) {
            return redirect()->route('prestation.index');
        }
        $typePrestation = TblTypePrestation::where('id', $id)->first();
        $typePrestationAutre = TblTypePrestation::where('impact', 'Autre')->where('etat', 'Actif')->first();
        $TotalEncaissement = session('TotalEncaissement', 0);

        $tok = Str::random(80);
        $token = [
            'token' => $tok,
            'operation_type' => "E-PRESTATION",
            'key_uuid' => $tok
        ];
        // dd($TotalEncaissement);
        $contract = session('contractDetails', []);
        $contractDetails = $contract['details'][0] ?? [];
        $membreDetails   = $contract['membre'] ?? [];
        // dd($contractDetails, $membreDetails);

        $prestation = TblPrestation::where(['idcontrat'=> $idcontrat, 'typeprestation' => $typePrestation->libelle, 'etape' => 1])->first();
        
        $rdv = Tblrdv::where(['police'=> $idcontrat, 'motifrdv' => $typePrestation->libelle, 'etat' => 1])->first();

        
       if ($prestation) {
            return redirect()->back()->with('fail','Une prestation de type "' . $typePrestation->libelle . '" pour le contrat ' . $idcontrat . ' est déja en cours. N° de prestation : ' . $prestation->code);
        }else{
            session()->forget('contractDetails');
            return view('prestations.create', compact('typePrestation', 'contractDetails', 'membreDetails', 'typePrestationAutre', 'TotalEncaissement', 'token', 'tok'));
        }
        
    }

    // public function createAutre(string $id)
    // {
    //     if (!session()->has('contractDetails')) {
    //         return redirect()->route('prestation.index');
    //     }
    //     $typePrestation = TblTypePrestation::where('id', $id)->first();
    //     $contract = session('contractDetails', []);
    //     $contractDetails = $contract['details'][0] ?? [];
    //     $membreDetails   = $contract['membre'] ?? [];
    //     $response = Http::withOptions(['timeout' => 60])
    //     ->post('https://api.laloyalevie.com/enov/op-type-operation-list', [
    //         'type' => 'AVT',
    //     ]);
    //     if ($response->successful()) {
    //         $typeOperation = $response->json();
            
    //     }
    //     session()->forget('contractDetails');
    //     return view('prestations.createAutre', compact('typePrestation', 'typeOperation', 'contractDetails', 'membreDetails'));
    // }

    public function createAutre(string $id)
    {
        if (!session()->has('contractDetails')) {
            return redirect()->route('prestation.index');
        }
        $peuSuspendreContrat = true;
        $peuModifDureeContrat = true;
        $peuReduireCapital = true;
        $peuReduirePrime = true;
        $contratDetails = session('details', null);
        $NbrencConfirmer = session('NbrencConfirmer', 0);
        $dernierEncaissement = session('dernierEncaissement', null);
        $payeur = session('payeur', null);

        

        // $TotalEncaissement = (float) $NbrencConfirmer * $prime;
        // $NbreCotisationMois = ((float) $contratDetails['DureeCotisationAns'] * 12);

        switch ($contratDetails['periodicite']) {
            case "M":
                $NbreCotisationMois = $NbrencConfirmer;
                break;
            case "T":
                $NbreCotisationMois = $NbrencConfirmer * 3; 
                break;
            case "S":
                $NbreCotisationMois = $NbrencConfirmer * 6; 
                break;
            case "A":
                $NbreCotisationMois = $NbrencConfirmer * 12; 
                break;
            case "U":
                $NbreCotisationMois = $NbrencConfirmer; 
                break;
            default:
                $NbreCotisationMois = 0; 
                break;
        }


        $acteurs = session('contratActeur');
        $assurees = session('contratActeurAssure');
        $acteurPayeur = session('contratActeurPayeur');
        $beneficiaires = session('contratActeurBeneficiaire');
        $NbreEmission = intval($contratDetails['NbreEmission']);
        // dd($NbreEmission);
        $codeProduitYAKO = ['YKE_2008','YKE_2018','YKS_2008','YKS_2018','YKF_2008','YKF_2018','YKR_2021','YKL_2004'];
        $codeProduitEPAGNE = ["DOIHOO"];
        if (in_array($contratDetails['codeProduit'], $codeProduitYAKO)) {
            $peuSuspendreContrat = false;
        }
        if (in_array($contratDetails['codeProduit'], $codeProduitEPAGNE) || in_array($contratDetails['codeProduit'], $codeProduitYAKO)) {
            $peuModifDureeContrat = false;
        }

        if (in_array($contratDetails['codeProduit'], $codeProduitYAKO) && $NbreCotisationMois < 12) {
            $peuReduireCapital = false;
            $peuReduirePrime = false;
        }

        $typePrestation = TblTypePrestation::where('id', $id)->first();
        $tok = Str::random(80);
        $token = [
            'token' => $tok,
            'operation_type' => "E-PRESTATION",
            'key_uuid' => $tok
        ];
        $response = Http::withOptions(['timeout' => 60])
            ->get(config('services.api.filiations'));
        if ($response->successful()) {
            $data = $response->json();
            if (!empty($data)) {
                $filiations = $data;
            }
        } else {
            $filiations = [];
        }
        $response = Http::withOptions(['timeout' => 60])
            ->post('https://api.laloyalevie.com/enov/op-type-operation-list', [
                'type' => 'AVT',
            ]);
        if ($response->successful()) {
            $typeOperation = $response->json();
        }
        $this->clearPrestationSessions();
        return view('prestations.createAutre', compact('typePrestation', 'typeOperation', 'contratDetails', 'dernierEncaissement', 'token', 'tok', 'payeur','acteurs','assurees','acteurPayeur','beneficiaires','filiations','NbreEmission','peuSuspendreContrat','peuModifDureeContrat','peuReduireCapital','peuReduirePrime'));
    }

    private function clearPrestationSessions()
    {
        session()->forget([
            'contractDetails',
            'contratActeur',
            'contratActeurAssure',
            'contratActeurPayeur',
            'contratActeurBeneficiaire',
            'dernierEncaissement',
            'payeur',
        ]);
    }

    // public function fetchContractDetails(Request $request)
    // {
    //     $idcontrat = $request->input('idcontrat') ?? $request->input('MonContrat');
    //     session(['idcontrat' => $idcontrat]);
    //     if (!$idcontrat) {
    //         // retourner une erreur ou un message d'erreur approprié en json
    //         return response()->json([
    //             'type' => 'error',
    //             'urlback' => '', // URL du PDF
    //             'message' => "Aucun ID de contrat fourni.",
    //             'code' => 400,
    //         ]);
    //     }

    //     try {
    //         $response = Http::withOptions(['timeout' => 60])
    //             ->post(config('services.api.encaissement_bis'), [
    //                 'idContrat' => $idcontrat,
    //             ]);

    //         if ($response->successful()) {
    //             $data = $response->json();
    //             if (!empty($data['details']) && !empty($data['enc']['confirmer'])) {
    //                 // Stocker les informations dans la session pour l'utiliser après redirection
    //                 session(['contractDetails' => $data['details'][0]]);
    //                 session(['encConfirmer' => $data['enc']['confirmer']]);
    //                 session(['NbrencConfirmer' => count($data['enc']['confirmer'])]);
    //                 $NbrencConfirmer = session('NbrencConfirmer', 0);
    //                 $prime = (float) $data['details'][0]['TotalPrime'];
    //                 // $TotalEncaissement = 0
    //                 $TotalEncaissement = array_sum(array_map(function ($item) {
    //                     return isset($item['RegltMontant']) ? (float) $item['RegltMontant'] : 0;
    //                 }, $data['enc']['confirmer']));

    //                 // $TotalEncaissement = (float) $NbrencConfirmer * $prime;
    //                 $DureeCotisationMois = ((float) $data['details'][0]['DureeCotisationAns'] * 12);

    //                 switch ($data['details'][0]['periodicite']) {
    //                     case "M":
    //                         $Duree = $DureeCotisationMois;
    //                         break;
    //                     case "T":
    //                         $Duree = $DureeCotisationMois / 3; // Trimestriel = tous les 3 mois
    //                         break;
    //                     case "S":
    //                         $Duree = $DureeCotisationMois / 6; // Semestriel = tous les 6 mois
    //                         break;
    //                     case "A":
    //                         $Duree = $DureeCotisationMois / 12; // Annuel = tous les 12 mois
    //                         break;
    //                     case "U":
    //                         $Duree = $NbrencConfirmer; // Annuel = tous les 12 mois
    //                         break;
    //                     default:
    //                         $Duree = 0; // Gérer les cas non définis
    //                         break;
    //                 }

    //                 // calculer le cumul des Cotisation à Terme du contrat
    //                 $cumulCotisationTerme = $Duree * $prime;
    //                 // calculer 15% du cumul des Cotisation à Terme du contrat
    //                 $contisationPourcentage = $cumulCotisationTerme * 0.15;
    //                 session(['contisationPourcentage' => $contisationPourcentage]);
    //                 session(['cumulCotisationTerme' => $cumulCotisationTerme]);
    //                 session(['TotalEncaissement' => $TotalEncaissement]);
    //                 // afficher le dernier encaissement
    //                 $dernierEncaissement = end($data['enc']['confirmer']);
    //                 session(['dernierEncaissement' => $dernierEncaissement]);
    //                 session(['payeur' => $data['payeur']]);

    //                 session([
    //                     'contratActeur' => $data['allActeur'] ?? [],
    //                     'contratActeurAssure' => collect($data['allActeur'])->where('CodeRole', 'ASS') ?? [],
    //                     'contratActeurPayeur' => collect($data['allActeur'])->where('CodeRole', 'PAY') ?? [],
    //                     'contratActeurBeneficiaire' => collect($data['allActeur'])->where('CodeRole', 'BEN') ?? [],
    //                 ]);
                    
                    
    //                 // dd($data);
    //                 // dd($data, $prime, $TotalEncaissement, $contisationPourcentage, $cumulCotisationTerme, $Duree); 
    //                 if ($data['details'][0]['OnStdbyOff'] != "1") {
    //                     return response()->json([
    //                         'type' => 'error',
    //                         'urlback' => '', // URL du PDF
    //                         'message' => 'Ce contrat est arreté ou en veille.',
    //                         'code' => 400,
    //                     ]);
    //                 } else {

    //                     return response()->json([
    //                         'type' => 'success',
    //                         'urlback' => ($request->type == 'Prestation') ? route('customer.selectPrestation') : route('customer.rdv.selectPrestation'), // URL du PDF
    //                         'message' => 'Un instant...',
    //                         'code' => 200,
    //                     ]);
    //                 }
    //             }

    //             return response()->json([
    //                 'type' => 'error',
    //                 'urlback' => '', // URL du PDF
    //                 'message' => 'Aucun détail trouvé pour ce contrat.',
    //                 'code' => 400,
    //             ]);
    //         }

    //         return response()->json([
    //             'type' => 'error',
    //             'urlback' => '', // URL du PDF
    //             'message' => "Erreur : Impossible de récupérer les informations du contrat.",
    //             'code' => 400,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'type' => 'error',
    //             'urlback' => '', // URL du PDF
    //             'message' => 'Une erreur s\'est produite : ' . $e->getMessage(),
    //             'code' => 400,
    //         ]);
    //     }
    // }

    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $saisiepar = auth()->user()->idmembre;
            $otp = $request->otp_1 . $request->otp_2 . $request->otp_3 . $request->otp_4 . $request->otp_5 . $request->otp_6;
            $otpVerif = Tblotp::where('codeOTP', $otp)->first();

            // if ($otpVerif) {
            $idOtp = $otpVerif->id ?? null;
            // Vérifier si une prestation similaire existe déjà

            $moyenPaiement = $request->moyenPaiement;
            $TelPaiement = ($moyenPaiement == 'Virement_Bancaire') ? null : $request->TelPaiement;
            // 5 caracteres
            $codeBanque = ($moyenPaiement == 'Virement_Bancaire') ? $request->rib_1 . $request->rib_2 . $request->rib_3 .$request->rib_4 . $request->rib_5 : null;

            // 5 caracteres
            $codeGuichet = ($moyenPaiement == 'Virement_Bancaire') ? $request->rib_6 . $request->rib_7 . $request->rib_8 .$request->rib_9 . $request->rib_10 : null;

            // 12 caracteres
            $numCompte = ($moyenPaiement == 'Virement_Bancaire') ? $request->rib_11 . $request->rib_12 . $request->rib_13 . $request->rib_14 . $request->rib_15 . $request->rib_16 . $request->rib_17 . $request->rib_18 . $request->rib_19 . $request->rib_20 . $request->rib_21 . $request->rib_22 : null;

            // 2 caracteres
            $cleRIB = ($moyenPaiement == 'Virement_Bancaire') ? $request->rib_23 . $request->rib_24 : null;
            $IBAN = ($moyenPaiement == 'Virement_Bancaire') ? $codeBanque . $codeGuichet . $numCompte . $cleRIB : null;

            // supprimer Espace en cas de $TelPaiement
            $montantSouhaite = preg_replace('/\s+/u', '', $request->montantSouhaite);

            // Création de la prestation
            $prestation = TblPrestation::create([
                'code' => RefgenerateCodePrest(TblPrestation::class, 'PREST-', 'code'),
                'idOtp' => $idOtp,
                'idcontrat' => $request->idcontrat,
                'typeprestation' => $request->typeprestation,
                'prestationlibelle' => $request->typeprestation,
                'idclient' => $request->idclient,
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'datenaissance' => $request->datenaissance,
                'lieunaissance' => $request->lieunaissance,
                'sexe' => $request->sexe,
                'cel' => $request->cel,
                'tel' => $request->tel,
                'email' => $request->email,
                'msgClient' => $request->msgClient,
                'lieuresidence' => $request->lieuresidence,
                'montantSouhaite' => $montantSouhaite,
                'moyenPaiement' => $moyenPaiement,
                'Operateur' => $request->Operateur,
                'telPaiement' => $TelPaiement,
                'codeBanque' => $codeBanque,
                'codeGuichet' => $codeGuichet,
                'numCompte' => $numCompte,
                'cleRIB' => $cleRIB,
                'IBAN' => $IBAN,
                'saisiepar' => $saisiepar,
                'etape' => 0,
                // 'villedeclaration' => $request->villedeclaration,
                // 'mailtraitement' => $request->mailtraitement,
            ]);

            // Vérification si la prestation a été créée
            if (!$prestation) {
                throw new \Exception("Erreur lors de l'enregistrement de la prestation");
            }

            // Chemin externe pour stocker les fichiers
            $externalUploadDir = base_path(env('UPLOAD_PRESTATION_FILE'));
            if (!is_dir($externalUploadDir)) {
                mkdir($externalUploadDir, 0777, true);
            }

            // Gestion des fichiers uploadés
            if ($request->hasFile('libelle')) {
                $contrat = $request->idcontrat;
                $rectoFile = null;
                $versoFile = null;
                $prestationFiles = [];

                if ($moyenPaiement != 'Virement_Bancaire') {
                    foreach ($request->file('libelle') as $index => $file) {
                        $fileType = $request->type[$index];
                        $fileLabel = $request->filename[$index];

                        // Si le fichier est de type 'IBAN', ne pas l'enregistrer
                        if ($fileType === 'RIB') {
                            continue;
                        }

                        if ($fileType === 'CNIrecto') {
                            $rectoFile = $file;
                        } elseif ($fileType === 'CNIverso') {
                            $versoFile = $file;
                        } else {
                            $fileName = Carbon::now()->format('Ymd_His') . '_' . $contrat . '_' . $fileType . '.' . $file->extension();
                            $file->move($externalUploadDir . 'docsPrestation/', $fileName);
                            $prestationFiles[] = [
                                'idPrestation' => $prestation->id,
                                'libelle' => $fileName,
                                'filename' => $fileLabel,
                                'path' => 'storage/prestations/docsPrestation/' . $fileName,
                                'type' => $fileType,
                            ];
                        }
                    }
                } else {
                    foreach ($request->file('libelle') as $index => $file) {
                        $fileType = $request->type[$index];
                        $fileLabel = $request->filename[$index];

                        // Si le fichier est de type 'FicheIDNum', ne pas l'enregistrer
                        if ($fileType === 'FicheIDNum') {
                            continue;
                        }

                        if ($fileType === 'CNIrecto') {
                            $rectoFile = $file;
                        } elseif ($fileType === 'CNIverso') {
                            $versoFile = $file;
                        } else {
                            $fileName = Carbon::now()->format('Ymd_His') . '_' . $contrat . '_' . $fileType . '.' . $file->extension();
                            $file->move($externalUploadDir . 'docsPrestation/', $fileName);
                            $prestationFiles[] = [
                                'idPrestation' => $prestation->id,
                                'libelle' => $fileName,
                                'filename' => $fileLabel,
                                'path' => 'storage/prestations/docsPrestation/' . $fileName,
                                'type' => $fileType,
                            ];
                        }
                    }
                }


                // Si les fichiers recto et verso sont présents, fusionner en un fichier PDF
                if ($rectoFile && $versoFile) {
                    $mergedFileName = Carbon::now()->format('Ymd_His') . '_CNI_' . $contrat . '.pdf';
                    $mergedFilePath = $externalUploadDir . 'docsPrestation/' . $mergedFileName;

                    // Charger les fichiers recto et verso
                    $rectoContent = file_get_contents($rectoFile->getPathname());
                    $versoContent = file_get_contents($versoFile->getPathname());

                    // Créer une vue HTML pour le PDF
                    $html = view('prestations.fiches.cni', [
                        'rectoContent' => base64_encode($rectoContent),
                        'versoContent' => base64_encode($versoContent)
                    ])->render();

                    // Générer le PDF
                    $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
                    $pdf->save($mergedFilePath);

                    // Enregistrer dans la base de données
                    $prestationFiles[] = [
                        'idPrestation' => $prestation->id,
                        'libelle' => $mergedFileName,
                        'filename' => 'CNI complète',
                        'path' => 'storage/prestations/docsPrestation/' . $mergedFileName,
                        'type' => 'CNI',
                    ];
                }

                // Enregistrer tous les fichiers
                foreach ($prestationFiles as $fileData) {
                    TblDocPrestation::create($fileData);
                }
            }
            $sign = Signature::where('key_uuid', $request->tokGenerate)->first();
            $sign->update([
                'reference_key' => $prestation->code
            ]);
            $prestationPdfUrl = $this->generatePrestationPdf($prestation);
            return response()->json([
                'type' => 'success',
                'urlback' => route('prestation.edit', $prestation->code),
                'url' => $prestationPdfUrl['file_url'],
                'message' => "Demande Enregistré avec succès !",
                'code' => 200,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }

    private function generatePrestationPdf($prestation)
    {
        try {
            // Chemin externe pour stocker les fichiers
            // $externalUploadDir = base_path('../uploads/prestations/');
            $externalUploadDir = base_path(env('UPLOAD_PRESTATION_FILE'));
            if (!is_dir($externalUploadDir)) {
                mkdir($externalUploadDir, 0777, true);
            }
            $imageUrl = env('SIGN_API') . "api/get-signature/" . $prestation->code . "/E-PRESTATION";
            if ($imageUrl != null || $imageUrl != '') {
                $imageData = file_get_contents($imageUrl);
                $base64Image = base64_encode($imageData);
                $imageSrc = 'data:image/png;base64,' . $base64Image;
            } else {
                $imageSrc = '';
            }

            $typePrestation = TblTypePrestation::where('libelle', $prestation->prestationlibelle)->first();
            $qrcode = base64_encode(QrCode::format('svg')->size(80)->generate(url('prestation/getInfoPrestation/' . $prestation->id)));
            if ($typePrestation->impact == 'Autre') {
                $pdf = Pdf::loadView('prestations.fiches.courrier', compact('prestation', 'imageSrc'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions([
                        'isHtml5ParserEnabled' => true,
                        'isRemoteEnabled' => true, // Permet le chargement des ressources distantes si nécessaire
                        'margin-left' => 0,
                        'margin-right' => 0,
                        'margin-top' => 0,
                        'margin-bottom' => 0,
                    ]);
            } else if ($typePrestation->impact == 0) {
                $pdf = Pdf::loadView('prestations.fiches.prestation', compact('qrcode', 'prestation', 'imageSrc'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions([
                        'isHtml5ParserEnabled' => true,
                        'isRemoteEnabled' => true,
                        'margin-left' => 0,
                        'margin-right' => 0,
                        'margin-top' => 0,
                        'margin-bottom' => 0,
                    ]);
            }else{
                $pdf = Pdf::loadView('prestations.fiches.prestationout', compact('qrcode', 'prestation', 'imageSrc'))
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'margin-left' => 0,
                    'margin-right' => 0,
                    'margin-top' => 0,
                    'margin-bottom' => 0,
                ]);
            }
            // Dossier pour enregistrer l'état de la prestation
            $etatPrestationDir = $externalUploadDir . 'etatPrestations/';
            if (!is_dir($etatPrestationDir)) {
                mkdir($etatPrestationDir, 0777, true);
            }

            $fileName = 'Prestation_' . $prestation->code . '.pdf';
            $filePath = $etatPrestationDir . $fileName;
            $pdf->save($filePath);

            // Enregistrer le fichier dans la base de données
            TblDocPrestation::create([
                'idPrestation' => $prestation->id,
                'filename' => "Fiche de demande de prestation",
                'libelle' => $fileName,
                'path' => 'storage/prestations/etatPrestations/' . $fileName,
                'type' => 'etatPrestation',
            ]);

            DB::commit();

            // Retourner l'URL complète du fichier PDF
            $pdfUrl = url('storage/prestations/etatPrestations/' . $fileName);
            return [
                'success' => true,
                'file_url' => $pdfUrl,
                'redirect_url' => route('prestation.show', $prestation->code),
            ];
        } catch (\Exception $e) {
            Log::error("Erreur lors de la génération du bulletin : ", ['error' => $e]);
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }


    public function storePrestAutre(Request $request)
    {
        DB::beginTransaction();
        try {
            $saisiepar = auth()->user()->idmembre;
            $otp = $request->otp_1 . $request->otp_2 . $request->otp_3 . $request->otp_4 . $request->otp_5 . $request->otp_6;
            // $idOtp = Tblotp::select('id')->where('codeOTP', $otp)->first();
            $otpVerif = Tblotp::where('codeOTP', $otp)->first();

            // if ($otpVerif) {
            $idOtp = $otpVerif->id ?? null;
            // Vérifier si une prestation similaire existe déjà

            $Operateur = ($otp == null || $otp == '') ? null : $request->Operateur;
            $TelPaiement = ($otp == null || $otp == '') ? null : $request->TelPaiement;
            $IBAN = ($otp == null || $otp == '') ? $request->IBAN : null;

            $PrestationEnCours = TblPrestation::where([
                ['idcontrat', '=', $request->idcontrat],
                ['typeprestation', '=', $request->typeprestation],
                ['idclient', '=', $request->idclient],
                ['etape', '=', 1]
            ])->first();
            if ($PrestationEnCours) {
                return response()->json([
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Une prestation N° $PrestationEnCours->code de type $PrestationEnCours->typeprestation pour le contrat $PrestationEnCours->idcontrat est en cours de traitement. Veuillez patienter.",
                    'code' => 500,
                ]);
            } else {
                $prestation = TblPrestation::create([
                    'code'              => RefgenerateCodePrest(TblPrestation::class, 'PREST-', 'code'),
                    'idOtp'             => $idOtp,
                    'idcontrat'         => $request->idcontrat,
                    'typeprestation'    => $request->typeprestation,
                    'prestationlibelle' => $request->prestationlibelle,
                    'idclient'          => $request->idclient,
                    'nom'               => $request->nom,
                    'prenom'            => $request->prenom,
                    'datenaissance'     => $request->datenaissance,
                    'lieunaissance'     => $request->lieunaissance,
                    'sexe'              => $request->sexe,
                    'cel'               => $request->cel,
                    'tel'               => $request->tel,
                    'email'             => $request->email,
                    'msgClient'         => $request->msgClient,
                    'lieuresidence'     => $request->lieuresidence,
                    'montantSouhaite'   => $request->montantSouhaite,
                    'moyenPaiement'     => $request->moyenPaiement,
                    'Operateur'         => $Operateur,
                    'telPaiement'       => $TelPaiement,
                    'IBAN'              => $IBAN,
                    'saisiepar'         => $saisiepar,
                ]);
                // Vérification si la prestation a été créée
                if (!$prestation) {
                    return response()->json([
                        'type' => 'error',
                        'urlback' => '',
                        'message' => "Une erreur est survenue lors de l'enregistrement de la prestation.",
                        'code' => 500,
                    ]);
                }

                // Chemin externe pour stocker les fichiers
                $externalUploadDir = base_path(env('UPLOAD_PRESTATION_FILE'));
                if (!is_dir($externalUploadDir)) {
                    mkdir($externalUploadDir, 0777, true);
                }

                // Gestion des fichiers uploadés
                if ($request->hasFile('libelle')) {
                    $contrat = $request->idcontrat;
                    $rectoFile = null;
                    $versoFile = null;
                    $rectoFileBeneficiaire = null;
                    $versoFileBeneficiaire = null;
                    $rectoFilePayeurPrime = null;
                    $versoFilePayeurPrime = null;
                    $rectoFileAssure = null;
                    $versoFileAssure = null;
                    $rectoFileSouscripteur = null;
                    $versoFileSouscripteur = null;
                    $prestationFiles = [];

                    foreach ($request->file('libelle') as $index => $file) {
                        // ⚠️ Si pas de fichier, on ignore (évite de récupérer type[] et filename[])
                        if (!$file) {
                            continue;
                        }
                    
                        $fileType = $request->type[$index];
                        $filename = $request->filename[$index];
                    
                        if ($fileType === 'CNIrecto') {
                            $rectoFile = $file;
                        } elseif ($fileType === 'CNIverso') {
                            $versoFile = $file;
                        } elseif ($fileType === 'CNIrectoBeneficiaire') {
                            $rectoFileBeneficiaire = $file;
                        } elseif ($fileType === 'CNIversoBeneficiaire') {
                            $versoFileBeneficiaire = $file;
                        } elseif ($fileType === 'CNIrectoPayeurPrime') {
                            $rectoFilePayeurPrime = $file;
                        } elseif ($fileType === 'CNIversoPayeurPrime') {
                            $versoFilePayeurPrime = $file;
                        } elseif ($fileType === 'CNIrectoAssure') {
                            $rectoFileAssure = $file;
                        } elseif ($fileType === 'CNIversoAssure') {
                            $versoFileAssure = $file;
                        } elseif ($fileType === 'CNIrectoSouscripteur') {
                            $rectoFileSouscripteur = $file;
                        } elseif ($fileType === 'CNIversoSouscripteur') {
                            $versoFileSouscripteur = $file;
                        } else {
                            // Cas général
                            $libelle = Carbon::now()->format('Ymd_His') . '_' . $contrat . '_' . $fileType . '.' . $file->extension();
                            $file->move($externalUploadDir . 'docsPrestation/', $libelle);
                    
                            $prestationFiles[] = [
                                'idPrestation' => $prestation->id,
                                'filename'     => $filename,
                                'libelle'      => $libelle,
                                'path'         => 'storage/prestations/docsPrestation/' . $libelle,
                                'type'         => $fileType,
                            ];
                        }
                    }
                    
                    // Si les fichiers recto et verso sont présents, fusionner en un fichier PDF
                    if ($rectoFile && $versoFile) {
                        $mergedFileName = Carbon::now()->format('Ymd_His') . '_CNI_' . $contrat . '.pdf';
                        $mergedFilePath = $externalUploadDir . 'docsPrestation/' . $mergedFileName;

                        // Charger les fichiers recto et verso
                        $rectoContent = file_get_contents($rectoFile->getPathname());
                        $versoContent = file_get_contents($versoFile->getPathname());

                        // Créer une vue HTML pour le PDF
                        $html = view('prestations.fiches.cni', [
                            'rectoContent' => base64_encode($rectoContent),
                            'versoContent' => base64_encode($versoContent)
                        ])->render();

                        // Générer le PDF
                        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
                        $pdf->save($mergedFilePath);

                        // Enregistrer dans la base de données
                        $prestationFiles[] = [
                            'idPrestation' => $prestation->id,
                            'filename' => "CNI de la personne concernée",
                            'libelle' => $mergedFileName,
                            'path' => 'storage/prestations/docsPrestation/' . $mergedFileName,
                            'type' => 'CNI',
                        ];
                    }elseif ($rectoFileBeneficiaire && $versoFileBeneficiaire) {
                        $mergedFileName = Carbon::now()->format('Ymd_His') . '_CNI_Beneficiaire_' . $contrat . '.pdf';
                        $mergedFilePath = $externalUploadDir . 'docsPrestation/' . $mergedFileName;

                        // Charger les fichiers recto et verso
                        $rectoContent = file_get_contents($rectoFileBeneficiaire->getPathname());
                        $versoContent = file_get_contents($versoFileBeneficiaire->getPathname());

                        // Créer une vue HTML pour le PDF
                        $html = view('prestations.fiches.cni', [
                            'rectoContent' => base64_encode($rectoContent),
                            'versoContent' => base64_encode($versoContent)
                        ])->render();

                        // Générer le PDF
                        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
                        $pdf->save($mergedFilePath);

                        // Enregistrer dans la base de données
                        $prestationFiles[] = [
                            'idPrestation' => $prestation->id,
                            'filename' => "CNI du bénéficiaire",
                            'libelle' => $mergedFileName,
                            'path' => 'storage/prestations/docsPrestation/' . $mergedFileName,
                            'type' => 'CNI',
                        ];
                    }elseif ($rectoFilePayeurPrime && $versoFilePayeurPrime) {
                        $mergedFileName = Carbon::now()->format('Ymd_His') . '_CNI_PayeurPrime_' . $contrat . '.pdf';
                        $mergedFilePath = $externalUploadDir . 'docsPrestation/' . $mergedFileName;

                        // Charger les fichiers recto et verso
                        $rectoContent = file_get_contents($rectoFilePayeurPrime->getPathname());
                        $versoContent = file_get_contents($versoFilePayeurPrime->getPathname());

                        // Créer une vue HTML pour le PDF
                        $html = view('prestations.fiches.cni', [
                            'rectoContent' => base64_encode($rectoContent),
                            'versoContent' => base64_encode($versoContent)
                        ])->render();

                        // Générer le PDF
                        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
                        $pdf->save($mergedFilePath);

                        // Enregistrer dans la base de données
                        $prestationFiles[] = [
                            'idPrestation' => $prestation->id,
                            'filename' => "CNI du payeur prime",
                            'libelle' => $mergedFileName,
                            'path' => 'storage/prestations/docsPrestation/' . $mergedFileName,
                            'type' => 'CNI',
                        ];
                    }elseif ($rectoFileAssure && $versoFileAssure) {
                        $mergedFileName = Carbon::now()->format('Ymd_His') . '_CNI_Assure_' . $contrat . '.pdf';
                        $mergedFilePath = $externalUploadDir . 'docsPrestation/' . $mergedFileName;

                        // Charger les fichiers recto et verso
                        $rectoContent = file_get_contents($rectoFileAssure->getPathname());
                        $versoContent = file_get_contents($versoFileAssure->getPathname());

                        // Créer une vue HTML pour le PDF
                        $html = view('prestations.fiches.cni', [
                            'rectoContent' => base64_encode($rectoContent),
                            'versoContent' => base64_encode($versoContent)
                        ])->render();

                        // Générer le PDF
                        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
                        $pdf->save($mergedFilePath);

                        // Enregistrer dans la base de données
                        $prestationFiles[] = [
                            'idPrestation' => $prestation->id,
                            'filename' => "CNI de l'assuré",
                            'libelle' => $mergedFileName,
                            'path' => 'storage/prestations/docsPrestation/' . $mergedFileName,
                            'type' => 'CNI',
                        ];
                    }elseif ($rectoFileSouscripteur && $versoFileSouscripteur) {
                        $mergedFileName = Carbon::now()->format('Ymd_His') . '_CNI_Souscripteur_' . $contrat . '.pdf';
                        $mergedFilePath = $externalUploadDir . 'docsPrestation/' . $mergedFileName;

                        // Charger les fichiers recto et verso
                        $rectoContent = file_get_contents($rectoFileSouscripteur->getPathname());
                        $versoContent = file_get_contents($versoFileSouscripteur->getPathname());

                        // Créer une vue HTML pour le PDF
                        $html = view('prestations.fiches.cni', [
                            'rectoContent' => base64_encode($rectoContent),
                            'versoContent' => base64_encode($versoContent)
                        ])->render();

                        // Générer le PDF
                        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
                        $pdf->save($mergedFilePath);

                        // Enregistrer dans la base de données
                        $prestationFiles[] = [
                            'idPrestation' => $prestation->id,
                            'filename' => "CNI du souscripteur",
                            'libelle' => $mergedFileName,
                            'path' => 'storage/prestations/docsPrestation/' . $mergedFileName,
                            'type' => 'CNI',
                        ];
                    }

                    // Enregistrer tous les fichiers
                    foreach ($prestationFiles as $fileData) {
                        TblDocPrestation::create($fileData);
                    }
                }

                $sign = Signature::where('key_uuid', $request->tokGenerate)->first();
                $sign->update([
                    'reference_key' => $prestation->code
                ]);
                // DB::commit();
                $prestationPdfUrl = $this->generatePrestationPdf($prestation);
                DB::commit();
                if ($prestationPdfUrl['success'] == false) {
                    return response()->json([
                        'type' => 'error',
                        'urlback' => '',
                        'message' => "Une erreur est survenue lors de la génération de la fiche de prestation! " . $prestationPdfUrl['message'],
                        'code' => 500,
                    ]);
                }else{
                    return response()->json([
                        'type' => 'success',
                        'urlback' =>  $prestationPdfUrl['redirect_url'],
                        'url' => $prestationPdfUrl['file_url'],
                        'message' => "Enregistré avec succès!",
                    ]);
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }

    public function mesPrestations()
    {
        $user = auth()->user();
        $prestations = TblPrestation::where(['saisiepar' => $user->membre->idmembre])->where('moyenPaiement', '!=', null, 'and', 'montantSouhaite', '!=', null, 'and', 'telPaiement', '!=', null, 'and', 'Operateur', '!=', null, 'and', 'IBAN', '!=', null)->with('docPrestation', 'motifrejet')->orderBy('created_at', 'desc')->get();

        $AutrePrestations = TblPrestation::where(['saisiepar' => $user->membre->idmembre])->where('moyenPaiement', '=', null, 'and', 'montantSouhaite', '=', null, 'and', 'telPaiement', '=', null, 'and', 'Operateur', '=', null, 'and', 'IBAN', '=', null)->with('docPrestation', 'motifrejet')->orderBy('created_at', 'desc')->get();
        return view('prestations.mesPrestations', compact('prestations', 'AutrePrestations'));
    }

    // Récupère les prestations en fonction du contrat sélectionné
    public function getPrestations(Request $request)
    {
        $idcontrat = $request->input('idcontratPrest');

        try {
            $prestations = TblPrestation::where('idcontrat', $idcontrat)->with('docPrestation')->get();
            if ($prestations->isEmpty()) {
                return response()->json(['status' => 'success', 'data' => []]);
            }
            return response()->json([
                'status' => 'success',
                'data' => $prestations,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue : ' . $th->getMessage(),
            ], 500);
        }
    }
    

    public function show(string $code)
    {
        $prestation = TblPrestation::where('code', $code)->first();
        return view('prestations.show', compact('prestation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $code)
    {
        $prestation = TblPrestation::where('code', $code)->first();
        $documents = TblDocPrestation::where('idPrestation', $prestation->id)->get();

        $types = [
            'Police' => null,
            'bulletin' => null,
            'AttestationPerteContrat' => null,
            'CNI' => null,
            'FicheIDNum' => null,
            'RIB' => null,
            'AttestationClotureCompte' => null,
        ];

        foreach ($documents as $doc) {
            if (array_key_exists($doc->type, $types)) {
                $types[$doc->type] = $doc->type; // Stocke la valeur si elle existe
            }

        }
        // Vérification des conditions obligatoires
        $conditionsInvalides = ( is_null($types['CNI']) || (is_null($types['Police']) && is_null($types['AttestationPerteContrat']) && is_null($types['bulletin'])) || 
            (is_null($types['RIB']) && is_null($types['FicheIDNum']) && is_null($types['AttestationClotureCompte']))
        );
        // dd($types, $conditionsInvalides);
        return view('prestations.edit', compact('prestation', 'types', 'conditionsInvalides'));
    }

    public function editAfterRejet(string $code)
    {
        $prestation = TblPrestation::where('code', $code)->first();
        $documents = TblDocPrestation::where('idPrestation', $prestation->id)->get();

        $types = [
            'Police' => null,
            'bulletin' => null,
            'AttestationPerteContrat' => null,
            'CNI' => null,
            'FicheIDNum' => null,
            'RIB' => null,
            'AttestationClotureCompte' => null,
        ];

        foreach ($documents as $doc) {
            if (array_key_exists($doc->type, $types)) {
                $types[$doc->type] = $doc->type; // Stocke la valeur si elle existe
            }

        }
        // Vérification des conditions obligatoires
        $conditionsInvalides = (
            is_null($types['CNI']) || 
            (is_null($types['Police']) && is_null($types['AttestationPerteContrat']) && is_null($types['bulletin'])) || 
            (is_null($types['RIB']) && is_null($types['FicheIDNum']) && is_null($types['AttestationClotureCompte']))
        );
        // dd($types, $conditionsInvalides);
        return view('prestations.editAfterRejet', compact('prestation', 'types', 'conditionsInvalides'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $code)
    {
        DB::beginTransaction();
        try {
            $otp = $request->otp_1 . $request->otp_2 . $request->otp_3 . $request->otp_4 . $request->otp_5 . $request->otp_6;
            $otpVerif = Tblotp::where('codeOTP', $otp)->first();

            // if ($otpVerif) {
            $isUpdated = TblPrestation::where('code', $code)->first();
            $idOtp = $otpVerif->id ?? $isUpdated->idOtp;
            $moyenPaiement = $request->moyenPaiement;
            $TelPaiement = ($moyenPaiement == 'Virement_Bancaire') ? null : $request->TelPaiement;
            $Operateur = ($moyenPaiement == 'Mobile_Money') ? $request->Operateur : null;
            // 5 caracteres
            $codeBanque = ($moyenPaiement == 'Virement_Bancaire') ? $request->rib_1 . $request->rib_2 . $request->rib_3 .$request->rib_4 . $request->rib_5 : null;

            // 5 caracteres
            $codeGuichet = ($moyenPaiement == 'Virement_Bancaire') ? $request->rib_6 . $request->rib_7 . $request->rib_8 .$request->rib_9 . $request->rib_10 : null;

            // 12 caracteres
            $numCompte = ($moyenPaiement == 'Virement_Bancaire') ? $request->rib_11 . $request->rib_12 . $request->rib_13 . $request->rib_14 . $request->rib_15 . $request->rib_16 . $request->rib_17 . $request->rib_18 . $request->rib_19 . $request->rib_20 . $request->rib_21 . $request->rib_22 : null;

            // 2 caracteres
            $cleRIB = ($moyenPaiement == 'Virement_Bancaire') ? $request->rib_23 . $request->rib_24 : null;
            $IBAN = ($moyenPaiement == 'Virement_Bancaire') ? $codeBanque . $codeGuichet . $numCompte . $cleRIB : null;
            // $isUpdated = TblPrestation::where('code', $code)->first();
            $isUpdated->update([
                'idOtp' => $idOtp,
                'msgClient' => $request->msgClient,
                'cel' => $request->cel,
                'tel' => $request->tel,
                'email' => $request->email,
                'lieuresidence' => $request->lieuresidence,
                'moyenPaiement' => $moyenPaiement,
                'Operateur' => $Operateur,
                'codeBanque' => $codeBanque,
                'codeGuichet' => $codeGuichet,
                'numCompte' => $numCompte,
                'cleRIB' => $cleRIB,
                'telPaiement' => $TelPaiement,
                'IBAN' => $IBAN,
                'etape' => 0
            ]);
            if ($isUpdated) {
                $prestationPdfUrl = $this->updatePrestationPdf($isUpdated);
                $motifsRejet = TblMotifrejetbyprestat::where('codeprestation', $code)->get();
                
                foreach ($motifsRejet as $motif) {
                    $motif->delete();
                }
                if (!$prestationPdfUrl) {
                    Log::info("Erreur lors de la mise à jour du PDF de la prestation");
                }
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => 'back',
                    'message' => "Prestation modifiée avec succès!",
                    'code' => 200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de la transmission!",
                    'code' => 500,
                ];
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur systeme! $th",
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }

    public function addDocPrest(Request $request)
    {
        DB::beginTransaction();
        try {
            $prestation = TblPrestation::where('code', $request->code)->first();
            // Chemin externe pour stocker les fichiers
            $externalUploadDir = base_path(env('UPLOAD_PRESTATION_FILE'));
            if (!is_dir($externalUploadDir)) {
                mkdir($externalUploadDir, 0777, true);
            }

            // Gestion des fichiers uploadés
            if ($request->hasFile('libelle')) {
                $contrat = $request->idcontrat;
                $rectoFile = null;
                $versoFile = null;
                $prestationFiles = [];

                foreach ($request->file('libelle') as $index => $file) {
                    $fileType = $request->type[$index]; // Utilisation de l'index pour obtenir le type
                    $fileLabel = $request->filename[$index];

                    if ($fileType === 'CNIrecto') {
                        $rectoFile = $file;
                    } elseif ($fileType === 'CNIverso') {
                        $versoFile = $file;
                    } else {
                        $fileName = Carbon::now()->format('Ymd_His') . '_' . $contrat . '_' . $fileType . '.' . $file->extension();
                        $file->move($externalUploadDir . 'docsPrestation/', $fileName);
                        $prestationFiles[] = [
                            'idPrestation' => $prestation->id,
                            'libelle' => $fileName,
                            'fileName' => $fileLabel,
                            'path' => 'storage/prestations/docsPrestation/' . $fileName,
                            'type' => $fileType,
                        ];
                    }
                }
                


                // Si les fichiers recto et verso sont présents, fusionner en un fichier PDF
                if ($rectoFile && $versoFile) {
                    $mergedFileName = Carbon::now()->format('Ymd_His') . '_CNI_' . $contrat . '.pdf';
                    $mergedFilePath = $externalUploadDir . 'docsPrestation/' . $mergedFileName;

                    // Charger les fichiers recto et verso
                    $rectoContent = file_get_contents($rectoFile->getPathname());
                    $versoContent = file_get_contents($versoFile->getPathname());

                    // Créer une vue HTML pour le PDF
                    $html = view('prestations.fiches.cni', [
                        'rectoContent' => base64_encode($rectoContent),
                        'versoContent' => base64_encode($versoContent)
                    ])->render();

                    // Générer le PDF
                    $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
                    $pdf->save($mergedFilePath);

                    // Enregistrer dans la base de données
                    $prestationFiles[] = [
                        'idPrestation' => $prestation->id,
                        'libelle' => $mergedFileName,
                        'fileName' => 'CNI complète',
                        'path' => 'storage/prestations/docsPrestation/' . $mergedFileName,
                        'type' => 'CNI',
                    ];
                }
                // dd($prestationFiles);
                // Enregistrer tous les fichiers
                foreach ($prestationFiles as $fileData) {
                    TblDocPrestation::create($fileData);
                }
            }
            $this->updatePrestationPdf($prestation);
            DB::commit();
            $dataResponse = [
                'type' => 'success',
                'urlback' => 'back',
                'message' => "Document ajouté avec succès!",
                'code' => 200,
            ];
            
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur systeme! $th",
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }
    

    public function transmettrePrest(string $code)
    {
        DB::beginTransaction();
        try {
            $isTransmitted = TblPrestation::where('code', $code)->first();
            $documents = TblDocPrestation::where('idPrestation', $isTransmitted->id)->get();

            $types = [
                'Police' => null,
                'bulletin' => null,
                'AttestationPerteContrat' => null,
                'CNI' => null,
                'FicheIDNum' => null,
                'RIB' => null,
                'AttestationClotureCompte' => null,
            ];

            foreach ($documents as $doc) {
                if (array_key_exists($doc->type, $types)) {
                    $types[$doc->type] = $doc->type; // Stocke la valeur si elle existe
                }
            }
            // Vérification des conditions obligatoires
            $conditionsInvalides = (
                is_null($types['CNI']) || 
                (is_null($types['Police']) && is_null($types['AttestationPerteContrat']) && is_null($types['bulletin'])) || 
                (is_null($types['RIB']) && is_null($types['FicheIDNum']) && is_null($types['AttestationClotureCompte']))
            );
            if ($conditionsInvalides) {
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Veuillez fournir tous les documents!",
                    'code' => 500,
                ];
                return response()->json($dataResponse);
            }else {
                $isTransmitted->update([
                    'etape' => 1
                ]);
            }
            if ($isTransmitted) {

                $dataResponse = [
                    'type' => 'success',
                    'urlback' => route('prestation.mesPrestations'),
                    'message' => "Prestation transmise avec succès!",
                    'code' => 200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de la transmission!",
                    'code' => 500,
                ];
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur systeme! $th",
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $code)
    {
        DB::beginTransaction();
        try {
            $isDeleted = TblPrestation::where('code', $code)->first();
            $isDeletedDocs = TblDocPrestation::where('idPrestation', $isDeleted->id)->get();
            if ($isDeleted) {
                foreach ($isDeletedDocs as $doc) {
                    $this->destroyDoc($doc->id);
                }
                $motifsRejet = TblMotifrejetbyprestat::where('codeprestation', $code)->get();
                foreach ($motifsRejet as $motif) {
                    $motif->delete();
                }
                $isDeleted->delete();
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Prestation supprimée avec succès!",
                    'code' => 200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de la suppression!",
                    'code' => 500,
                ];
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur systeme! $th",
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }

    public function destroyDoc(string $id)
    {
        DB::beginTransaction();
        try {
            $doc = TblDocPrestation::where('id', $id)->first();
            if ($doc) {
                $prestation = TblPrestation::where('id', $doc->idPrestation)->first();
                // Chemin du fichier stocké
                $filePath = base_path(env('UPLOAD_PRESTATION_FILE')) . 'docsPrestation/' . $doc->libelle;
                $filePathe = base_path(env('UPLOAD_PRESTATION_FILE')) . 'etatPrestations/' . $doc->libelle;

                // Vérifie si le fichier existe avant de le supprimer
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                // Vérifie si le fichier existe avant de le supprimer
                if (file_exists($filePathe)) {
                    unlink($filePathe);
                }

                // Supprime l'entrée de la base de données
                $doc->delete();

                $ok = $this->updatePrestationPdf($prestation);
                if (!$ok) {
                    Log::info("Erreur lors de la mise à jour du PDF de la prestation");
                }
            }
            DB::commit();
            $dataResponse = [
                'type' => 'success',
                'urlback' => 'back',
                'message' => "Document supprimé avec succès!",
                'code' => 200,
            ];
            
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $th",
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }

    
    // private function updatePrestationPdf($prestation)
    // {
    //     try {
    //         $externalUploadDir = base_path(env('UPLOAD_PRESTATION_FILE'));
    //         if (!is_dir($externalUploadDir)) {
    //             mkdir($externalUploadDir, 0777, true);
    //         }
    //         $imageUrl = env('SIGN_API') . "api/get-signature/".$prestation->code."/E-PRESTATION";
    //         // if ($imageUrl != null || $imageUrl != '') {
    //         //     $imageData = file_get_contents($imageUrl);
    //         //     $base64Image = base64_encode($imageData);
    //         //     $imageSrc = 'data:image/png;base64,'.$base64Image;
    //         // } else {
    //         //     $imageSrc = '';
    //         // }

    //         $imageSrc = '';
    //         try {
    //             $response = Http::timeout(5)->get($imageUrl);

    //             if ($response->successful()) {
    //                 $data = $response->json();

    //                 // Vérifie si 'error' existe et est à true
    //                 if (isset($data['error']) && $data['error'] === true) {
    //                     Log::info('Signature non trouvée pour la prestation N°: ' . $prestation->code);
    //                 } else {
                    
    //                     $imageData = $response->body(); 
    //                     $base64Image = base64_encode($imageData);
    //                     $imageSrc = 'data:image/png;base64,' . $base64Image;
    //                 }
    //             } else {
    //                 Log::error('Erreur HTTP lors de l\'appel de l\'API signature. Code de retour : ' , $response->json());
    //             }
    //         } catch (\Exception $e) {
    //             Log::error('Exception lors de la récupération de la signature : ' . $e->getMessage());
    //         }
    //         // Génération du QR code et du fichier PDF pour la prestation
    //         $qrcode = base64_encode(QrCode::format('svg')->size(80)->generate(url('prestation/getInfoPrestation/' . $prestation->id)));
    //         $pdf = Pdf::loadView('prestations.fiches.prestation', compact('qrcode', 'prestation', 'imageSrc'))
    //             ->setPaper('a4', 'portrait')
    //             ->setOptions([
    //                 'isHtml5ParserEnabled' => true,
    //                 'isRemoteEnabled' => true,
    //                 'margin-left' => 0,
    //                 'margin-right' => 0,
    //                 'margin-top' => 0,
    //                 'margin-bottom' => 0,
    //             ]);

    //         // Dossier pour enregistrer l'état de la prestation
    //         $etatPrestationDir = $externalUploadDir . 'etatPrestations/';
    //         if (!is_dir($etatPrestationDir)) {
    //             mkdir($etatPrestationDir, 0777, true);
    //         }

    //         $fileName = 'Prestation_' . $prestation->code . '.pdf';
    //         $filePath = $etatPrestationDir . $fileName;
    //         $pdf->save($filePath);

    //         $docName = TblDocPrestation::where(['idPrestation' => $prestation->id, 'type' => 'etatPrestation'])->first();
    //         if ($docName) {
    //             $docName->delete();
    //         }
    //         // Enregistrer le fichier dans la base de données
    //         TblDocPrestation::create([
    //             'idPrestation' => $prestation->id,
    //             'libelle' => $fileName,
    //             'path' => 'storage/prestations/etatPrestations/' . $fileName,
    //             'type' => 'etatPrestation',
    //         ]);

    //         DB::commit();

    //         // Retourner l'URL complète du fichier PDF
    //         // $pdfUrl = url('storage/prestations/etatPrestations/' . $fileName);
    //         return [
    //             'success' => true,
    //             // 'redirect_url' => route('prestation.show', $prestation->code),
    //         ];
    //     } catch (\Exception $e) {
    //         Log::error("Erreur lors de la génération du bulletin : ", ['error' => $e]);
    //         return [
    //             'success' => false,
    //             'message' => $e->getMessage(),
    //         ];
    //     }
    // }

    private function updatePrestationPdf($prestation)
    {
        try {
            $externalUploadDir = base_path(env('UPLOAD_PRESTATION_FILE'));
            if (!is_dir($externalUploadDir)) {
                mkdir($externalUploadDir, 0777, true);
            }
            $imageUrl = env('SIGN_API') . "api/get-signature/" . $prestation->code . "/E-PRESTATION";
            // if ($imageUrl != null || $imageUrl != '') {
            //     $imageData = file_get_contents($imageUrl);
            //     $base64Image = base64_encode($imageData);
            //     $imageSrc = 'data:image/png;base64,'.$base64Image;
            // } else {
            //     $imageSrc = '';
            // }
            $imageSrc = '';
            try {
                $response = Http::timeout(5)->get($imageUrl);

                if ($response->successful()) {
                    $data = $response->json();

                    // Vérifie si 'error' existe et est à true
                    if (isset($data['error']) && $data['error'] === true) {
                        Log::info('Signature non trouvée pour la prestation N°: ' . $prestation->code);
                    } else {

                        $imageData = $response->body();
                        $base64Image = base64_encode($imageData);
                        $imageSrc = 'data:image/png;base64,' . $base64Image;
                    }
                } else {
                    Log::error('Erreur HTTP lors de l\'appel de l\'API signature. Code de retour : ', $response->json());
                }
            } catch (\Exception $e) {
                Log::error('Exception lors de la récupération de la signature : ' . $e->getMessage());
            }
            

            $typePrestation = TblTypePrestation::where('libelle', $prestation->prestationlibelle)->first();
            $qrcode = base64_encode(QrCode::format('svg')->size(80)->generate(url('prestation/getInfoPrestation/' . $prestation->id)));
            if ($typePrestation->impact == 'Autre') {
                $pdf = Pdf::loadView('prestations.fiches.courrier', compact('prestation', 'imageSrc'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions([
                        'isHtml5ParserEnabled' => true,
                        'isRemoteEnabled' => true, // Permet le chargement des ressources distantes si nécessaire
                        'margin-left' => 0,
                        'margin-right' => 0,
                        'margin-top' => 0,
                        'margin-bottom' => 0,
                    ]);
            } else if ($typePrestation->impact == 0) {
                $pdf = Pdf::loadView('prestations.fiches.prestation', compact('qrcode', 'prestation', 'imageSrc'))
                    ->setPaper('a4', 'portrait')
                    ->setOptions([
                        'isHtml5ParserEnabled' => true,
                        'isRemoteEnabled' => true,
                        'margin-left' => 0,
                        'margin-right' => 0,
                        'margin-top' => 0,
                        'margin-bottom' => 0,
                    ]);
            }else{
                $pdf = Pdf::loadView('prestations.fiches.prestationout', compact('qrcode', 'prestation', 'imageSrc'))
                ->setPaper('a4', 'portrait')
                ->setOptions([
                    'isHtml5ParserEnabled' => true,
                    'isRemoteEnabled' => true,
                    'margin-left' => 0,
                    'margin-right' => 0,
                    'margin-top' => 0,
                    'margin-bottom' => 0,
                ]);
            }

            // Dossier pour enregistrer l'état de la prestation
            $etatPrestationDir = $externalUploadDir . 'etatPrestations/';
            if (!is_dir($etatPrestationDir)) {
                mkdir($etatPrestationDir, 0777, true);
            }

            $fileName = 'Prestation_' . $prestation->code . '.pdf';
            $filePath = $etatPrestationDir . $fileName;
            $pdf->save($filePath);

            $docName = TblDocPrestation::where(['idPrestation' => $prestation->id, 'type' => 'etatPrestation'])->first();
            if ($docName) {
                $docName->delete();
            }
            // Enregistrer le fichier dans la base de données
            TblDocPrestation::create([
                'idPrestation' => $prestation->id,
                'libelle' => $fileName,
                'fileName' => 'Fiche de demande de prestation',
                'path' => 'storage/prestations/etatPrestations/' . $fileName,
                'type' => 'etatPrestation',
            ]);

            DB::commit();

            // Retourner l'URL complète du fichier PDF
            // $pdfUrl = url('storage/prestations/etatPrestations/' . $fileName);
            return [
                'success' => true,
                // 'redirect_url' => route('prestation.show', $prestation->code),
            ];
        } catch (\Exception $e) {
            Log::error("Erreur lors de la génération du bulletin : ", ['error' => $e]);
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
