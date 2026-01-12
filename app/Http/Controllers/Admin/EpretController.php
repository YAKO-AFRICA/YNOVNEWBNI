<?php

namespace App\Http\Controllers\Admin;

use PDF;

use Carbon\Carbon;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Pret;
use App\Models\Membre;
use App\Models\Assurer;
use App\Models\Product;
use setasign\Fpdi\Fpdi;
use App\Models\Adherent;
use App\Models\TblVille;
use App\Models\TblAgence;
use App\Models\Profession;
use App\Models\TblSociete;
use App\Models\TblDocument;
use App\Models\Beneficiaire;
use Illuminate\Http\Request;
use App\Models\TblProfession;
use App\Models\AssureGarantie;
use App\Models\ProduitGarantie;
use App\Models\TblSecteurActivite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\IOFactory;

class EpretController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function demoSimulateur()
    {
        // $user = Auth::user()->idmembre;
        // $membre = Membre::where('idmembre', $user)->with('zone')->first();
        // dd($membre);
        return view('epret.newSimule');
    }
    public function index()
    {
        $user = Auth::user()->idmembre;
        // $membre = Membre::where('idmembre', $user)->with('zone')->first();
        // dd($membre);
        $prets = Pret::where('saisiepar', $user)->orderBy('saisiele', 'desc')->get();

        return view('epret.index', compact('prets'));
    }

    public function simulateur()    
    {

        return view('epret.simulateur');
    }

    public function storeSimulation(Request $request)
    {
        // Stockez les données dans la session
        session(['simulationData' => $request->all()]);

        return response()->json(['message' => 'Simulation data stored successfully']);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = Product::where('CodeProduit', 'loyemp')->first();

        $productGarantie = ProduitGarantie::where('CodeProduit','loyemp')->get();
        $villes =  TblVille::select('libelleVillle')->get();
        $professions =  Profession::select('MonLibelle')->get();
        $secteurActivites =  TblSecteurActivite::select('MonLibelle')->get();
        $societes =  TblSociete::select('MonLibelle')->get();
        $agences =  TblAgence::select('NOM_LONG')->get();

        $simulationData = session('simulationData', []);

        return view('epret.create', compact('product', 'villes', 'secteurActivites', 'professions','productGarantie','societes','agences','simulationData'));
    }


    public function saveBeneficiarySession(Request $request)
    {
        session()->forget('beneficiary');
        $data = $request->only(['nom', 'prenom', 'dateNaissance', 'lieuNaissance', 'capital', 'lieuResidence', 'numPhone', 'emailBenef']);
        session(['beneficiary' => $data]);

        return response()->json(['success' => true, 'message' => 'Bénéficiaire sauvegardé dans la session']);
    }


    /**
     * Store a newly created resource in storage.
     */
        public function store(Request $request)
        {

            DB::beginTransaction();
            try {


                $sexe = $request->civilite === "Monsieur" ? "M" : "F";
                $datenaissance = Carbon::parse($request->datenaissance)->format('Y-m-d H:i:s');

                $idAdherent = Adherent::max('id') + 1;
                $idPret = Pret::max('id') + 1;
                $idBenef = Beneficiaire::max('id') + 1;
                $idGarantie = AssureGarantie::max('id') + 1;
                $idGarantieTwo = $idGarantie + 1;
                $idAssurer = Assurer::max('id') + 1;

                $Adherent = Adherent::create([
                    'id' => $idAdherent,
                    'civilite' => $request->civilite,
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'datenaissance' => $datenaissance,
                    'lieunaissance' => $request->lieunaissance,
                    'sexe' => $sexe,
                    'numeropiece' => $request->numeropiece,
                    'naturepiece' => $request->naturepiece,
                    'lieuresidence' => $request->lieuresidence,
                    'profession' => $request->profession,
                    'employeur' => $request->employeur,
                    'pays' => $request->pays,
                    'estmigre' => 0,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'telephone1' => $request->telephone1,
                    'mobile' => $request->mobile,
                    'codemembre' => 0,
                    'mobile1' => $request->mobile1,
                    'saisieLe' => now(),
                    'saisiepar' => Auth::user()->membre->idmembre,
                    'refcontratsource' => $request->refcontratsource,
                    'cleintegration' => "010203",
                    'id_maj' => $request->id_maj,
                    'connexe' => $request->connexe,
                    'contratconnexe' => $request->contratconnexe,
                    'capitalconnexe' => $request->capitalconnexe
                ])->save();

                Assurer::create([
                    'id' => $idAssurer,
                    'civilite' => $request->civilite,
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'datenaissance' => $datenaissance,
                    'codecontrat' => $idPret,
                    'codeadherent' => $idAdherent,
                    'lieunaissance' => $request->lieunaissance,
                    'numeropiece' => $request->numeropiece,
                    'naturepiece' => $request->naturepiece ?? null,
                    'lieuresidence' => $request->lieuresidence ?? null,
                    // 'filiation' => $assure['lienParente'],
                    'mobile' => $request->mobile ?? null,
                    'estmigre' => 0 ?? null,
                    'email' => $request->email ?? null,
                    'sexe' => $sexe,
                    'saisieLe' => now(),
                    'saisiepar' => auth::user()->membre->idmembre,
                ]);

                Log::info($Adherent);

                if($request->primeObseque != null){
                    $disableYako = 0;
                }else{
                    $disableYako = 1;
                }
                $commonData = [
                    'codeassure' => $idAssurer,
                    'codecontrat' => $idPret,
                    'estmigre' => 0,
                    'refcontratsource' => $idPret,
                    'codeoperation' => 00,
                ];
                
                $garanties = [
                    [
                        'id' => $idGarantie,
                        'codeproduitgarantie' => "DECES",
                        'idproduitparantie' => 59,
                        'monlibelle' => 'DECES',
                        'prime' => 5000,
                        'primeaccesoire' => 0,
                        'primetotal' => 5000,
                        'type' => "Mixte",
                        'capitalgarantie' => "500000",
                    ],
                    [
                        'id' => $idGarantieTwo,
                        'codeproduitgarantie' => "YKEMP",
                        'idproduitparantie' => 153,
                        'monlibelle' => 'Yako Emprunteur',
                        'prime' => 0,
                        'primeaccesoire' => 0,
                        'primetotal' => 0,
                        'type' => "Mixte",
                        'capitalgarantie' => "0",
                    ],
                ];
                
                foreach ($garanties as $garantie) {
                    AssureGarantie::create(array_merge($garantie, $commonData))->save();
                }
                


                    


                $newPret = Pret::create([
                    'id' => $idPret,
                    'typepret' => $request->typPret,
                    'effetgarantie' => $request->loanDateMiseEnPlace,
                    'montantpret' => $request->montant,
                    'dateecheancedebut' => $request->firstDateEcheance,
                    'dateecheancefin' => $request->lasLoanDateRembour,

                    'remboursement' => $request->periodiciterRembou,
                    'numerocompte' => $request->numerocompte,

                    'txprimeunique' => $request->txprimeunique,
                    'txsurprime' => $request->txsurprime,
                    'txprimedef' => $request->txprimedef,

                    'prime' => $request->prime,

                    'primeht' => $request->prime,

                    'montantsurprime' => $request->montantsurprime,
                    'fraisaccessoires' => $request->fraisaccessoires,
                    'fraismedicaux' => $request->fraismedicaux,
                    'duree' => $request->duree,

                    'taille' => $request->taille,
                    'poids' => $request->poids,

                    'partenaire' => Auth::user()->membre->codepartenaire,
                    'periodicite' => $request->periodiciterPrime,
                    'tension' => $request->tensionMin,
                    'fumezvous' => $request->smoking,
                    'nbcigarettejour' => $request->nbcigarettejour,
                    'buvezvous' => $request->alcohol,
                    'distraction' => $request->distractions,
                    'estinfirme' => $request->accident,

                    // 'natureinfirmite' => $request->natureinfirmite,

                    // 'estenarrettravail' => $request->estenarrettravail,
                    // 'datearrettravail' => $request->datearrettravail,
                    // 'motifarret' => $request->motifarret,


                    // 'datereprisetravail' => $request->datereprisetravail,
                    // 'causearrettravail' => $request->causearrettravail,
                    // 'datecausetravail' => $request->datecausetravail,

                    'saisiele' => now(),
                    'saisiepar' => Auth::user()->idmembre,   
                    'codeagent' => Auth::user()->membre->codeagent,
                    'nomagent' => Auth::user()->membre->nom.''.Auth::user()->membre->prenom,

                    'encotation' => 0,

                    'etat' => 2,
                    'codeadherent' => $idAdherent,
                    'estmigre' => 0,

                    // 'examens' => $request->examens,
                    // 'codebanque' => $request->codebanque,
                    // 'codeguichet' => $request->codeguichet,
                    // 'agence' => $request->agence,

                    // 'tarificationmedicale' => $request->tarificationmedicale,
                    // 'datemiseenplace' => $request->datemiseenplace,
                    // 'misenplacepar' => $request->misenplacepar,
                    // 'daterejet' => $request->daterejet,
                    // 'rejeterpar' => $request->rejeterpar,
                    // 'referencepret' => $request->referencepret,
                    // 'moftifrejet' => $request->moftifrejet,
                    // 'modifiele' => $request->modifiele,
                    // 'modifierpar' => $request->modifierpar,


                    'primeobseque' => $request->primeObseque,

                    // 'motifcotation' => $request->motifcotation,

                    'capital' => 500000,

                    // 'beneficiaireaudeces' => $request->beneficiaireaudeces,

                    'personneressource' => $request->personneressource,
                    'contactpersonneressource' => $request->contactpersonneressource,
                    'personneressource2' => $request->personneressource2,
                    'contactpersonneressource2' => $request->contactpersonneressource2,

                    // 'rib' => $request->rib,

                    'estsportif' => $request->sport,
                    'sportpratique' => $request->typeSport,

                    // 'miseenplaceeffective' => $request->miseenplaceeffective,
                    // 'motifrachat' => $request->motifrachat,
                    // 'daterachat' => $request->daterachat,
                    // 'racheterpar' => $request->racheterpar,

                    // 'medecin' => $request->medecin,

                    // 'rapportmedicalok' => $request->rapportmedicalok,
                    // 'daterapportmedical' => $request->daterapportmedical,

                    'primerisque' => $request->prime,
                    'primeemprunteur' => $request->primeEmprunteur,

                    'numeroclient' => $idAdherent,

                    'typeadherent' => 'Individuel',
                    // 'nbadherent' => $request->nbadherent,

                    'unableyako' => $disableYako,

                    // 'rmedicinok' => $request->rmedicinok,
                    // 'datermedecin' => $request->datermedecin,
                    // 'daterapport' => $request->daterapport,
                    // 'dateemis' => $request->dateemis,
                    'naturepret' => $request->naturePret,
                    // 'daterejetmedecin' => $request->daterejetmedecin,
                    // 'etatmedicin' => $request->etatmedicin,
                    
                ])->save();

                
                $benefData = session('beneficiary');


                if ($request->primeObseque != null) {
                    $datenaissanceBenef = Carbon::parse($benefData['dateNaissance'])->format('Y-m-d H:i:s');
                    Beneficiaire::create([
                        'id' => $idBenef,
                        'nom' => $benefData['nom'],
                        'prenom' => $benefData['prenom'],
                        'datenaissance' => $datenaissanceBenef,
                        'codecontrat' => $idPret,
                        'codeadherent' => $idAdherent,
                        'lieunaissance' => $benefData['lieuNaissance'],
                        'lieuresidence' => $benefData['lieuResidence'],
                        'mobile' => $benefData['numPhone'],
                        'email' => $benefData['emailBenef'],
                        'saisieLe' => now(),
                        'saisiepar' => Auth::user()->membre->idmembre,
                    ])->save();
                }

                $bulletinData = $this->generateBulletinPret($idPret);


                Log::info($newPret);


                DB::commit();

                return response()->json([
                    'type' => 'success',
                    'urlback' => '',
                    'url' => $bulletinData['file_url'],
                    'message' => "enregistrer avec success !",
                    'code' => 200,
                ]);
                
            } catch (\Throwable $th) {
                DB::rollBack();

                Log::error("Erreur système: ", ['error' => $th]);
                return response()->json([
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur système! $th",
                    'code' => 500,
                ]);
            }
        }

        private function generateBulletinPret($idPret)
        {
            try {
                // Récupérer le prêt
                $pret = Pret::findOrFail($idPret);

                // Générer le PDF à partir de la vue
                $pdf = PDF::loadView('epret.components.bulletin.adhesion', ['pret' => $pret]);

                // Définir le répertoire pour sauvegarder les bulletins
                $bulletinDir = public_path('documents/bulletin/pret/');
                if (!is_dir($bulletinDir)) {
                    mkdir($bulletinDir, 0777, true);
                }

                // Chemin du fichier final
                $finalBulletinPath = $bulletinDir . 'adhesion_' . $pret->id . '.pdf';

                // Sauvegarder le fichier PDF
                $pdf->save($finalBulletinPath);

                // Générer l'URL du fichier
                $fileUrl = asset("documents/bulletin/pret/adhesion_{$pret->id}.pdf");

                // Log de l'URL générée
                Log::info("Bulletin generated at: " . $fileUrl);

                return [
                    'success' => true,
                    'file_url' => $fileUrl,
                ];
            } catch (\Exception $e) {
                // Enregistrer une erreur dans les logs
                Log::error("Erreur lors de la génération du bulletin : ", ['error' => $e->getMessage()]);

                return [
                    'success' => false,
                    'message' => $e->getMessage(),
                ];
            }
        }


        public function generateBu($id)
        {
            try {

                $pret = Pret::where('id', $id)->first();

                // Chargement de la vue avec les données
                $pdf = PDF::loadView('epret.components.bulletin.adhesion', ['pret' => $pret]);

                // Option 1 : Retourner directement le PDF pour téléchargement
                return $pdf->stream('bulletin_adhesion.pdf');

            } catch (\Exception $e) {
                return [
                    'success' => false,
                    'message' => $e->getMessage(),
                ];
            }
        }

        public function addDocDefaud(Request $request)
        {
            try {
            DB::beginTransaction();
                $lastPret = Pret::where('saisiepar', Auth::user()->idmembre)
                ->latest('id')
                ->first();
                $idPret = $lastPret->id;

                $libelles = $request->input('libelles');
                $files = $request->file('files');
             
                foreach ($files as $key => $file) {
                    $imageName = $idPret . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();
        
                    // $destinationPath = public_path('documents/files');
                    $destinationPath = base_path(env('UPLOADS_PATH'));
                    $file->move($destinationPath, $imageName);
                    // $filePath = '../public_html/testenovapi/public/uploads/' . $imageName;

                    TblDocument::create([
                        'codecontrat' => $idPret,
                        'filename' => $imageName,
                        'libelle' => $libelles[$key],
                        'saisiele' => now(),
                        'saisiepar' => Auth::user()->membre->idmembre,
                        'source' => "ES",
                    ]);
                }
    
                DB::commit();
            
                return response()->json([
                    'type' => 'success',
                    'urlback' => route('epret.show', $idPret),
                    'message' => "Enregistré avec succès!",
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



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        set_time_limit(300);
        $productGarantie = ProduitGarantie::where('CodeProduit','loyemp')->get();

        $pret = Pret::where('id',$id)->firstOrFail();

        // dd($pret);
        
        return view('epret.show', compact('pret', 'productGarantie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {


        $product = Product::where('CodeProduit', 'loyemp')->first();

        $pret = Pret::where('id', $id)->with('adherent', 'assures', 'beneficiaires')->first();
        $productGarantie = ProduitGarantie::where('CodeProduit',$pret->codeproduit)->get(); 
        $villes =  TblVille::get();
        $professions =  TblProfession::select('MonLibelle')->get();
        $secteurActivites =  TblSecteurActivite::select('MonLibelle')->get();
        $societes =  TblSociete::select('MonLibelle')->get();
        $agences =  TblAgence::select('NOM_LONG')->get();
        return view('epret.edit', compact('pret', 'villes', 'secteurActivites', 'professions','productGarantie','societes','agences','product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::beginTransaction();
        try {

            $newPret = Pret::where('id', $id)->update([

                'naturepret' => $request->naturePret,
                'typepret' => $request->typPret,
                'effetgarantie' => $request->loanDateMiseEnPlace,
                'dateecheancefin' => $request->lasLoanDateRembour,
                'periodicite' => $request->periodiciterPrime,
                'remboursement' => $request->periodiciterRembou,
                'dateecheancedebut' => $request->firstDateEcheance,
                // 'surprime' => $request->surprime,
                
            ]);
            

            DB::commit();

            return response()->json([
                'type' => 'success',
                'urlback' => '',
                'message' => "enregistrer avec success !",
                'code' => 200,
            ]);
            
        } catch (\Throwable $th) {
            DB::rollBack();

            Log::error("Erreur système: ", ['error' => $th]);
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }


    public function transmettrePret($id)
    {
        DB::beginTransaction();
        try {
                $pret = Pret::find($id);
    
                if ($pret) {
                    $pret->update(
                        [
                            'etat' => 2,
                        ]
                    );

                    DB::commit();
                
                    return response()->json([
                        'type' => 'success',
                        'urlback' => \route('epret.index'),
                        'message' => "Transmis avec succès!",
                        'code' => 200,
                    ]);
                } else {
                    return response()->json([
                        'type' => 'error',
                        'urlback' => 'back',
                        'message' => "Erreur erreur de transmission !",
                        'code' => 200,
                    ]);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try 
        {
            $pret = Pret::find($id);
            if ($pret) {

                $pret->delete();

                DB::commit();

                return response()->json([
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Suppression effectuée avec succès!",
                    'code' => 200,
                ]);
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
}
