<?php

namespace App\Http\Controllers\Sites;

use Carbon\Carbon;
use Dompdf\Options;
use App\Models\User;
use App\Models\Membre;
use App\Models\Assurer;
use App\Models\Contrat;
use App\Models\Product;
use BaconQrCode\Writer;
use setasign\Fpdi\Fpdi;
use App\Models\Adherent;
use App\Models\TblVille;
use App\Models\Signature;
use App\Mail\CustomerMail;
use App\Models\Filliation;
use App\Models\TblSociete;
use App\Models\TblDocument;
use Illuminate\Support\Str;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use App\Models\ReseauProduct;
use App\Models\TblProfession;
use App\Models\AgenceByParter;
use App\Models\AssureGarantie;
use App\Models\ProduitGarantie;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TblSecteurActivite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use BaconQrCode\Renderer\ImageRenderer;
use Illuminate\Support\Facades\Session;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;

class SitePropositionController extends Controller
{
    public function stepProduct($codeMembre)
    {
        $user = User::where('idmembre', $codeMembre)->first();

        $productByReseau = ReseauProduct::select('CodeProduit')
            ->where('codereseau', $user->membre->codereseau)->get();


        $codeProduits = $productByReseau->pluck('CodeProduit')->toArray();

        $products = Product::whereIn('CodeProduit', $codeProduits)->get();

        return view('sites.pages.steps.stepProduit', compact('products', 'user'));
    }

    public function simulateurPrimeDirectE($codeProduit, $userId)
    {

        $user = User::where('idmembre', $userId)->with('membre')->first();

        $product = Product::where('CodeProduit', $codeProduit)->first();
        return view('sites.pages.steps.directEnt.stepDirectSimulateur', compact('product', 'user', 'codeProduit'));
    }
    public function simulateurPrimeDia($codeProduit, $userId)
    {

        $user = User::where('idmembre', $userId)->with('membre')->first();

        $product = Product::where('CodeProduit', $codeProduit)->first();
        return view('sites.pages.steps.stepSimulateur', compact('product', 'user'));
    }

    public function saveSiteSimulateurData(Request $request)
    {
        Log::info("requesttttttt", $request->all());

        $user = User::where('idmembre', $request->userId)->first();
        $productCode = $request->productCode;

        Log::info("user". $user);

        
        DB::beginTransaction();
        try {

            $baseNum = '67104860101001170';
            $increment = Contrat::where('numBullettin', 'like', $baseNum . '%')
                ->where('codeproduit', $productCode)
                ->count() + 1;

            do {
                $numBullettin = $baseNum . $increment;
                $numExist = Contrat::where('numBullettin', $numBullettin)->exists();
                $increment++;
            } while ($numExist);
            
            $product = Product::where('CodeProduit', $productCode)->first();
            // creation id 
            $idAdherent = Adherent::max('id') + 1;
            $idContrat = Contrat::max('id') + 1;

            $prime = is_numeric($request->primeSimulateur) ? (float)$request->primeSimulateur : 0.00;

            $membre = Membre::where('codeagent', $user->membre->codeagent)->first();
            $datenaissance = Carbon::parse($request->birthDateSimulateur)->format('Y-m-d H:i:s');
            $Adherent = Adherent::create([
                'id' => $idAdherent,
                'datenaissance' => $datenaissance,
                'estmigre' => 0,
                'codemembre' => 0,
                'saisieLe' => now(),
                'saisiepar' => $membre->idmembre,
                
            ]);
            if($Adherent)
            {
                $contratData = Contrat::create([
                    'id' => $idContrat,
                    'codeConseiller' => $membre->codeagent,
                    'nomagent' => $membre->nom.' '.$membre->prenom,
                    'primepricipale' => $prime,
                    'prime' => $prime,
                    'fraisadhesion' => 0,
                    'surprime' => 0,
                    'capital' => $request->capitalSimulateur,
                    'etape' => 0,
                    'saisiele' => now(),
                    'saisiepar' => $membre->idmembre,
                    'codeadherent' => $idAdherent,
                    'estMigre' => 0,
                    'codeproduit' => $productCode,
                    'libelleproduit' => $product->MonLibelle,
                    'branche' => $membre->branche,
                    'partenaire' => $membre->codepartenaire,
                    'estpaye' => 0,
                    'typesouscipteur' => $membre->branche,
                    'numBullettin' => $numBullettin,
                    'Formule' => $request->typeSimulateur
                ]);
                DB::commit();
                if($contratData)
                {
                    return response()->json([
                        'type' => 'success',
                        'message' => 'Veuillez patienter...',
                        'urlback' => route('site.create', $idContrat),
                        'code' => 200
                    ]);
                }
            }else{
                DB::rollBack();
                return response()->json(
                    [
                        'type' => 'error',
                        'message' => 'Une erreur est survenue',
                        'code' => 400
                    ],
                    400
                );
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(
                [
                    'type' => 'error',
                    'message' => 'Une erreur est survenue lors de l\'enregistrement de la proposition',
                    'code' => 500,
                    'error' => $e->getMessage()
                ],
                500
            );
        }
    }

    public function create($codeProduit, $codePartner)
    {


        $productGarantie = ProduitGarantie::where('CodeProduit',$codeProduit)->get(); 
        $product = Product::where('CodeProduit',$codeProduit)->first(); 
        $villes =  TblVille::get();
        $professions =  TblProfession::select('MonLibelle')->get();
        $secteurActivites =  TblSecteurActivite::select('MonLibelle')->orderBy('MonLibelle')->get();
        $societes =  TblSociete::select('MonLibelle')->get();
        $agences =  AgenceByParter::where('codePartner',$codePartner )->get();


        $filliations =  Filliation::select('MonLibelle')->get();

        $tok = Str::random(80);
        $token = [
            'token' => $tok,
            'operation_type' => "E-SOUSCRIPTION",
            'key_uuid' => $tok
        ];
        $keyUuid = $token['key_uuid'];
        $operationType = $token['operation_type'];


        try {

            $response = Http::withOptions(['timeout' => 60])->get(env('API_GET_COUNTRIES'));

            if ($response->successful()) {
                $data = $response->json();

                // Vérifie si la clé "countries" existe
                if (isset($data['countries'])) {
                    $detailCountries = $data['countries'];
                } else {
                    Log::info('La clé "countries" est absente de la réponse API.');
                }
            } else {
                Log::error('Échec de la récupération des pays depuis l\'API.');
            }
        } catch (\Exception $e) {
            Log::error('Exception lors de l\'appel à l\'API des pays : ' . $e->getMessage());
        }
        

        return view('sites.pages.create', compact('product', 'villes', 'secteurActivites', 'professions','productGarantie','societes','agences','detailCountries','keyUuid','operationType','token','tok','codePartner','filliations'));
    }

    public function storeSessionContratData(Request $request)
    {
        Session::put('allSessionData', $request->all());

        return response()->json([
            'type' => 'success',
            'success' => true, 
            'message' => 'Proposition enregistrée avec succès',
            'code' => 200,
            'data' => $request->all()
        ]);
    }


    public function storeContrat(Request $request)
    {
        try{  

            DB::beginTransaction();


            $prefix = '67104860101001170';

            // On récupère le nombre de contrats existants avec ce préfixe et ce produit
            $increment = Contrat::where('numBullettin', 'like', $prefix . '%')
                ->where('codeproduit', 'LFFUN')
                ->count() + 1;

            do {
                $numBullettin = $prefix . $increment;
                $numExist = Contrat::where('numBullettin', $numBullettin)->exists();
                $increment++;
            } while ($numExist);



            log::info($request->all());
            $data = Session::get('allSessionData');

            Log::info("data serialized: ".json_encode($data));

            $adherentData = $data['adherentData'];
            $assureData = $data['assureData'];
            $contratData = $data['contratData'];
            $utilisateur = $data['utilisateur'];
            $simulationData = $data['simulationData'];
            $benefData = $data['benefData'];

            Log::info("ContratData serialized: ".$contratData['periodicite']);

            $datenaissanceAdherent = Carbon::parse($adherentData['datenaissance'])->format('Y-m-d H:i:s');

            Log::info("datenaissanceAdherent: ".$datenaissanceAdherent);

            $sexe = $adherentData['civilite'] === "Monsieur" ? "M" : "F";

            $idAdherent = Adherent::max('id') + 1;
            $idContrat = Contrat::max('id') + 1;

            $Adherent = Adherent::create([
                'id' => $idAdherent,
                'civilite' => $adherentData['civilite'] ?? null,
                'situationMatrimoniale' => $adherentData['situation_matrimoniale'] ?? null,
                'nom' => $adherentData['nom'] ?? null,
                'prenom' => $adherentData['prenom'] ?? null,
                'datenaissance' => $datenaissanceAdherent ?? null,
                'lieunaissance' => $adherentData['lieunaissance'] ?? null,
                'sexe' => $sexe,
                'numeropiece' => $adherentData['numeropiece'] ?? null,
                'naturepiece' => $adherentData['naturepiece'] ?? null,
                'lieuresidence' => $adherentData['lieuresidence'] ?? null,
                'profession' => $adherentData['profession'] ?? null,
                'employeur' => $adherentData['employeur'] ?? null,
                'estmigre' => 0,
                'email' => $adherentData['email'] ?? null,
                'telephone' => $adherentData['telephone'] ?? null,
                'mobile' => $adherentData['mobile'] ?? null,
                'codemembre' => 0,
                'mobile1' => $adherentData['mobile1'] ?? null,
                'saisieLe' => now(),
                'saisiepar' => $utilisateur['idmembre'] ?? null,
                'cleintegration' => "010203333333",
            ]);

            Log::info("Adherent created: ".json_encode($Adherent));

            if ($assureData) {
                foreach ($assureData as $assure) {
                    Log::info("assureeeeeeeeeeeeee: ".json_encode($assure));
                    $datenaissanceAssur = isset($assure['datenaissance']) ? Carbon::parse($assure['datenaissance'])->format('Y-m-d H:i:s') : null;
                    $idAssureInsert = Assurer::max('id') + 1;

                    $sexeassurAdd = $assure['civilite'] === "Monsieur" ? "M" : "F";
                    Assurer::create([
                        'id' => $idAssureInsert,
                        'civilite' => $assure['civilite'] ?? null,
                        'nom' => $assure['nom'] ?? null,
                        'prenom' => $assure['prenom'] ?? null,
                        'datenaissance' => $datenaissanceAssur ?? null,
                        'codecontrat' => $idContrat,
                        'codeadherent' => $idAdherent,
                        'lieunaissance' => $assure['lieunaissance'] ?? null,
                        'numeropiece' => $assure['numeropiece'] ?? null,
                        'naturepiece' => $assure['naturepiece'] ?? null,
                        'lieuresidence' => $assure['lieuresidence'] ?? null,
                        'filiation' => $assure['filiation'] ?? "MOI-MEME",
                        'mobile' => $assure['mobile'] ?? null,
                        'telephone' => $assure['telephone'] ?? null,
                        'estmigre' => 0,
                        'email' => $assure['email'] ?? null,
                        'sexe' => $sexeassurAdd,
                        'saisieLe' => now(),
                        'saisiepar' => $utilisateur['idmembre'] ?? null,
                        'mobile1' => $assure['mobile1'] ?? $assure['telephone1'] ?? null,
                        'telephone1' => $assure['telephone1'] ?? $assure['mobile1'] ?? null,
                    ]);

                    Log::info("Assurer created: ");

                    $garantie = ProduitGarantie::where('codeproduitgarantie', "ASSFUN_ADH")->first();

                    Log::info("garantie: ".json_encode($garantie));

                    AssureGarantie::create([
                        'codeproduitgarantie' => $garantie->codeproduitgarantie,
                        'idproduitparantie' => $garantie->id ?? null,
                        'monlibelle' => $garantie->libelle,
                        'prime' => $contratData['primepricipale'],
                        'primetotal' => $contratData['primepricipale'],
                        'primeaccesoire' => 0,
                        'type' => "Mixte",
                        'capitalgarantie' => $contratData['capital'],
                        'codeassure' => $idAssureInsert,
                        'codecontrat' => $idContrat,
                        'refcontratsource' => $idContrat,
                        'estmigre' => 0,
                    ])->save();

                    $certifResidence = null;

                    if($request->estAssure === "Oui"){
                        $certifResidence = $request->file('justifResidenceAdh');
                    } else {
                        $certifResidence = $request->file('justifResidence');
                    }

                    Log::info("certifResidence: ".json_encode($certifResidence));

                    if ($certifResidence !== null) {

                        $files = $certifResidence;

                        if ($files) {
                            $imageName = $idContrat . '_' . now()->timestamp . '.' . $files->getClientOriginalExtension();

                            Log::info("imageName". $imageName);

                            $destinationPath = base_path(env('UPLOADS_PATH'));

                            $files->move($destinationPath, $imageName);

                            TblDocument::create([
                                'codecontrat' => $idContrat,
                                'filename' => $imageName,
                                'libelle' => "justif de residence",
                                'saisiele' => now(),
                                'saisiepar' => $utilisateur['idmembre'] ?? null,
                                'source' => "ES",
                            ]);
                        }

                    }
                    // if ($request->file('justifResidence')) {

                    //     $files = $request->file('justifResidence');

                    //     if ($files) {
                    //         $imageName = $idContrat . '_' . now()->timestamp . '.' . $files->getClientOriginalExtension();

                    //         Log::info("imageName". $imageName);

                    //         $destinationPath = base_path(env('UPLOADS_PATH'));

                    //         $files->move($destinationPath, $imageName);

                    //         TblDocument::create([
                    //             'codecontrat' => $idContrat,
                    //             'filename' => $imageName,
                    //             'libelle' => "justif de residence",
                    //             'saisiele' => now(),
                    //             'saisiepar' => $utilisateur['idmembre'] ?? null,
                    //             'source' => "ES",
                    //         ]);
                    //     }

                    // }
                    
                }
            }

            Log::info("Assurer created: ");


            if ($benefData) {

                foreach ($benefData as $beneficiaire) {
                    $datenaissanceBeneficiaire = isset($beneficiaire['datenaissance']) ? Carbon::parse($beneficiaire['datenaissance'])->format('Y-m-d H:i:s') : null;
                    $idBenefInsert = Beneficiaire::max('id') + 1;
                    Beneficiaire::create([
                        'id' => $idBenefInsert,
                        'civilite' => $beneficiaire['civilite'] ?? null,
                        'nom' => $beneficiaire['nom'],
                        'prenom' => $beneficiaire['prenom'],
                        'datenaissance' => $datenaissanceBeneficiaire,
                        'codecontrat' => $idContrat,
                        'codeadherent' => $idAdherent,
                        'lieunaissance' => $beneficiaire['lieunaissance'],
                        'numeropiece' => $beneficiaire['numeropiece'] ?? null,
                        'naturepiece' => $beneficiaire['naturepiece'] ?? null,
                        'lieuresidence' => $beneficiaire['lieuresidence'],
                        'filiation' => $beneficiaire['lien'],
                        'mobile' => $beneficiaire['mobile'],
                        'telephone' => $beneficiaire['mobile'],
                        'email' => $beneficiaire['email'],
                        'saisieLe' => now(),
                        'saisiepar' => $utilisateur['idmembre'],
                    ]);
                }
            }

            Log::info("Beneficiaire created: ");

            if ($contratData['modepaiement'] === "Mobile_money") {
                $numerocompte = $contratData['numMobile'];
            } else {
                $numerocompte = $contratData['numerocompte'];
            }

            Log::info("numerocompte". $numerocompte);

            $product = Product::where('CodeProduit', $simulationData['productCode'])->first();

            Log::info("product". $product);

            $contratCreate = Contrat::create([
                'id' => $idContrat,
                'dateeffet' => $contratData['dateEffet'] ?? null,

                'modepaiement' => $contratData['modepaiement'] ?? null,

                'organisme' => $utilisateur['codepartenaire'] ?? null,
                // 'agence' => $request->agence,
                'numerocompte' => $numerocompte,

                'periodicite' => $contratData['periodicite'] ?? null,

                'codeConseiller' => $utilisateur['membre']['codeagent'] ?? null,
                'nomagent' => $utilisateur['membre']['nom'] . ' ' . $utilisateur['membre']['prenom'],

                'primepricipale' => number_format($contratData['primepricipale'], 2, ".", ""),
                'prime' => $contratData['primepricipale'] ?? null,
                'fraisadhesion' => $contratData['fraisAdhesion'],

                'surprime' => 0,
                'capital' => number_format($contratData['capital'], 2, ".", ""),
                'etape' => 1,

                'saisiele' => now(),
                'saisiepar' => $utilisateur['idmembre'] ?? null,

                'duree' => $contratData['duree'] ?? null,

                'codeadherent' => $idAdherent,
                'estMigre' => 0,
                'codeproduit' => $simulationData['productCode'] ?? null,

                'libelleproduit' => $product->MonLibelle,

                'personneressource' => $adherentData['personneressource'] ?? null,
                'contactpersonneressource' => $adherentData['contactpersonneressource'] ?? null,

                // 'beneficiaireaudeces' => $request->audecesContrat,

                'personneressource2' => $adherentData['personneressource2'] ?? null,
                'contactpersonneressource2' => $adherentData['contactpersonneressource2'] ?? null,

                'codebanque' => $contratData['codebanque'] ?? null,
                'codeguichet' => $contratData['codeguichet'] ?? null,
                'rib' => $contratData['rib'] ?? null,

                'branche' => $utilisateur['branche'] ?? null,

                'partenaire' => $utilisateur['codepartenaire'] ?? null,
                // 'nomaccepterpar' => now(),
                // 'refcontratsource' => now(),
                'cleintegration' => now()->format('Ymd'),

                'numBullettin' => $numBullettin,

                'estpaye' => 0,
                'nomsouscipteur' => $adherentData['nom'] . ' ' . $adherentData['prenom'],
                'Formule' => $simulationData['type'] ?? null,
            ]);

           
                

            

            Log::info("Contrat created: ");

            $sign = Signature::where('key_uuid', $contratData['tokGenerate'])->first();

            if ($sign) {
                $sign->update(['reference_key' => $idContrat]); 
            }

            $bulletinData = $this->generateBulletin($idContrat, $utilisateur);

            // Si la génération du bulletin a échoué, lever une exception
            if (!$bulletinData['success']) {
                throw new \Exception("Erreur lors de la génération du bulletin : " . $bulletinData['message']);
            }

            $mailData = [
                'title' => 'Félicitations et bienvenue chez YAKO AFRICA Assurances Vie ! 🎉',
                'btnLink' => $bulletinData['file_url'],
                'btnText' => 'Télécharger mon bulletin',
                'documents' => $bulletinData['file_url'],
            ];

            $to = $adherentData['email'];

            $emailSubject = 'Félicitations et bienvenue chez YAKO AFRICA Assurances Vie ! 🎉';

            Mail::to($to)->send(new CustomerMail($mailData, $emailSubject));

            $details_log = [
                'url' => route('prod.show', $idContrat),
                'user' => $utilisateur['membre']['nom'] . ' ' . $utilisateur['membre']['prenom'],
                'date' => now(),
                'title' => "Enregistrement de la proposition ID $idContrat",
                'action' => "Voir",
            ];

            DB::commit();

            if ($contratCreate) {

                $dataResponse =[
                    'type'=>'success',
                    // 'urlback'=> route('site.showContratSite', $idContrat),
                    'urlback' => route('site.showContratSite', [$idContrat, 'success' => 1]),
                    'url' => $bulletinData['file_url'],
                    'message'=>"Enregistré avec succès!",
                    'code'=>200,
                ];
                DB::commit();

           } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de l'enregistrement!",
                    'code'=>500,
                ];
           }
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! $th",
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);

    }

    private function generateBulletin($idContrat, $utilisateur)
    {
        try {
            $piece_recto = '';
            $piece_verso = '';
            $allFiles = [];
            // Récupérer les données nécessaires au bulletin
            $contrat = Contrat::findOrFail($idContrat);

            $renderer = new ImageRenderer(
                new RendererStyle(200),
                new SvgImageBackEnd()
            );

            $imageUrl = env('SIGN_API') . "api/get-signature/" . $idContrat . "/E-SOUSCRIPTION";

            Log::info("Image URL: $imageUrl");
            
            $imageData = file_get_contents($imageUrl);
            $base64Image = base64_encode($imageData);
            $imageSrc = 'data:image/png;base64,'.$base64Image;


            // $qrContent = "Contrat bien enregistré\n";
            // $qrContent .= "Date: " . $contrat->saisiele . "\n";
            // $qrContent .= "Réf. Contrat: " . $contrat->id;
            $qrContent = url("site/showContratSite/" . $contrat->id);

            
            $writer = new Writer($renderer);
        
            // Génération en base64 (sans fichier temporaire)
            $qrCodeImage = $writer->writeString($qrContent);
            $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($qrCodeImage);
            
            // Passez $qrCodeBase64 à votre vue


            // Options pour DomPDF
            $options = new Options();
            $options->set('isRemoteEnabled', true);

            // Génération du bulletin PDF temporaire

            $pdf = PDF::loadView('productions.components.bullettin.llfunBull', [
                    'contrat' => $contrat,
                    'qrCodeBase64' => $qrCodeBase64,
                    'imageSrc' => $imageSrc,
                ]);
                $cguFile = public_path('root/cgu/CGPLanggnant.pdf');
            

            $bulletinDir = public_path('documents/bulletin/');
            if (!is_dir($bulletinDir)) {
                mkdir($bulletinDir, 0777, true);
            }

            $tempBulletinPath = $bulletinDir . 'temp_bulletin_' . $contrat->id . '.pdf';
            $pdf->save($tempBulletinPath);

            // Chemin vers le fichier CGU
            $cguFilePath = public_path('root/cgu/cg_yke.pdf');

       

            // Initialiser FPDI pour fusionner les fichiers
            $finalPdf = new Fpdi();

            // Ajouter toutes les pages du bulletin
            $bulletinPageCount = $finalPdf->setSourceFile($tempBulletinPath);
            for ($pageNo = 1; $pageNo <= $bulletinPageCount; $pageNo++) {
                $finalPdf->AddPage();
                $tplIdx = $finalPdf->importPage($pageNo);
                $finalPdf->useTemplate($tplIdx);
            }
        
            // Ajouter toutes les pages du fichier CGU
            $cguPageCount = $finalPdf->setSourceFile($cguFile);
            for ($pageNo = 1; $pageNo <= $cguPageCount; $pageNo++) {
                $finalPdf->AddPage();
                $tplIdx = $finalPdf->importPage($pageNo);
                $finalPdf->useTemplate($tplIdx);
            }

            // Nom final du fichier fusionné
            $finalBulletinPath = $bulletinDir . 'bulletin_' . $contrat->id . '.pdf';
            $finalPdf->Output($finalBulletinPath, 'F');

            // new code 
            $destinationPath = base_path(env('UPLOADS_PATH'));
            $fileName = $idContrat . '-' . now()->timestamp.'-' .'Bulletin_de_souscription' . '.pdf';
            $finalPdf->Output($destinationPath . $fileName, 'F');

            $allFiles[] = [
                'codecontrat' => $contrat->id,
                'filename' => $fileName,
                'libelle' => "Bulletin de souscription",
                'saisiele' => now(),
                'saisiepar' => $utilisateur['idmembre'],
                'source' => "ES",
            ];

            $imageUrl = env('SIGN_API') . "api/get-piece/" . $contrat->id . "/E-SOUSCRIPTION";
            try {
                $response = Http::timeout(5)->get($imageUrl);

                if ($response->successful()) {
                    $data = $response->json();

                    if (!empty($data['error']) && $data['error'] === true) {
                        Log::info('Pièce non trouvée pour le contrat N°: ' . $contrat->id);
                    } else {
                        $piece_recto = $data['recto_path'] ?? '';
                        $piece_verso = $data['verso_path'] ?? '';
                    }
                } else {
                    Log::error('Erreur HTTP lors de l\'appel de l\'API signature. Réponse : ', $response->json());
                }
            } catch (\Exception $e) {
                Log::error('Exception lors de la récupération de la signature : ' . $e->getMessage());
            }

            // Vérifier qu'on a bien les deux images
            if ($piece_recto && $piece_verso) {

                // Télécharger le contenu recto/verso
                $rectoContent = Http::get($piece_recto)->body();
                $versoContent = Http::get($piece_verso)->body();

                // Encoder en base64 pour les afficher dans un PDF
                $rectoBase64 = base64_encode($rectoContent);
                $versoBase64 = base64_encode($versoContent);

                // Créer la vue PDF avec les deux images
                $html = view('productions.cni', [
                    'rectoContent' => $rectoBase64,
                    'versoContent' => $versoBase64
                ])->render();

                // Nom du fichier PDF
                $newFileName = $idContrat . '-' . now()->timestamp . '-piece_justificative.pdf';
                // $mergedFilePath = base_path(env('UPLOADS_PATH'));

                // Générer le PDF
                $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');
                $pdf->save($destinationPath . $newFileName);

                // Sauvegarder les infos du fichier
                $allFiles[] = [
                    'codecontrat' => $contrat->id,
                    'filename' => $newFileName,
                    'libelle' => "Pièce justificative d'identité",
                    'saisiele' => now(),
                    'saisiepar' => $utilisateur['idmembre'],
                    'source' => "ES",
                ];
            } else {
                Log::warning("Recto/Verso manquants pour le contrat {$contrat->id}");
            }

            

            // enregistrer le bulletin dans la base de données
            foreach ($allFiles as $file) {
                TblDocument::create($file);
            }

            // Supprimer le fichier temporaire du bulletin
            unlink($tempBulletinPath);

           // Définir l'URL publique pour le fichier final
            $fileUrl = url("storage/documents/{$fileName}");
            // $fileUrl = asset("documents/bulletin/lffun_bulletin_{$contrat->id}.pdf");

            return [
                'success' => true,
                'file_url' => $fileUrl,
                'redirect_url' => route('prod.edit', ['id' => $idContrat]),
                'qrCodeBase64' => $qrCodeBase64
            ];
        } catch (\Exception $e) {
            Log::error("Erreur lors de la génération du bulletin : ", ['error' => $e]);
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function showContratSite($idContrat)
    {

        $contrat = Contrat::where('id', $idContrat)->first();
        return view('sites.pages.show.showContrat', compact('contrat'));
    }


    public function updateBenefDeces(Request $request)
    {

        $contrat = Contrat::where('id', $request->contrat_id)->update([
            'beneficiaireaudeces' => $request->beneficiaireaudeces,
        ]);
            
        return response()->json(['success' => true, 'message' => 'Bénéficiaire mis à jour avec succès']);
    }

    public function updateBeneficiaireTerme(Request $request)
    {

        $contrat = Contrat::where('id', $request->contrat_id)->update([
            'beneficiaireauterme' => $request->beneficiaireauterme,
        ]);
            
        return response()->json(['success' => true, 'message' => 'Bénéficiaire mis à jour avec succès']);
    }

    public function storeBeneficiaire(Request $request)
    {
        $membre = Membre::where('codeagent', 'AG-DIA-007')->first();
        $contrat = Contrat::where('id', $request->contrat)->first();

        DB::beginTransaction();
        try {
                
            $idBenef = Beneficiaire::max('id') + 1;

            Beneficiaire::create([
                'id' => $idBenef,
                'civilite' => $request->civilite,
                'nom' => $request->nomBenef,
                'prenom' => $request->prenomBenef,
                'datenaissance' => $request->datenaissanceBenef,
                'codecontrat' => $request->contrat,
                'codeadherent' => $contrat->codeadherent,
                'lieunaissance' => $request->lieunaissanceBenef,
                'numeropiece' => $request->numeropiece,
                'naturepiece' => $request->naturepiece,
                'lieuresidence' => $request->lieuresidenceBenef,
                'filiation' => $request->lienParente,
                'mobile' => $request->mobileBenef,
                'email' => $request->emailBenef,
                'part' => $request->partBenef,
                'saisieLe' => now(),
                'saisiepar' => $membre->idmembre,
            ])->save();

            DB::commit();
        
            return response()->json([
                'type' => 'success',
                'urlback' => "back",
                'message' => "Beneficiaire ajouté avec succès!",
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

    public function storeDocuments(Request $request)
    {
        try {
        DB::beginTransaction();
        $idContrat = $request->contrat;
        $membre = Membre::where('codeagent', 'AG-DIA-007')->first();
        $libelles = $request->input('libelles');
        $files = $request->file('files');
         
        foreach ($files as $key => $file) {
            $imageName = $idContrat . '-' . now()->timestamp . '.' . $libelles[$key] . '.' . $file->getClientOriginalExtension();

            $destinationPath = base_path(env('UPLOADS_PATH'));
            $file->move($destinationPath, $imageName);
            $filePath = env('UPLOADS_PATH') . $imageName;

            TblDocument::create([
                'codecontrat' => $idContrat,
                'filename' => $imageName,
                'libelle' => $libelles[$key],
                'saisiele' => now(),
                'saisiepar' => $membre->idmembre,
                'source' => "ES",
            ]);
        }

        DB::commit();
    
        return response()->json([
            'type' => 'success',
            'urlback' => 'back',
            'message' => "Document(s) ajouté(s) avec succès!",
            'code' => 200,
        ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'urlback' => 'back',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }

    public function destroyDocument(string $id)
    {
        try {
        DB::beginTransaction();
        $document = TblDocument::where('id', $id)->first();
        $destinationPath = base_path(env('UPLOADS_PATH')).$document->filename;

        // Vérifie si le fichier existe avant de le supprimer
        if (file_exists($destinationPath)) {
            unlink($destinationPath);
        }

        $document->delete();
        DB::commit();
    
        return response()->json([
            'type' => 'success',
            'urlback' => 'back',
            'message' => "Document supprimé avec succès!",
            'code' => 200,
        ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'urlback' => 'back',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }
    
}
