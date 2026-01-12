<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Membre;
use App\Models\Product;
use App\Models\Prospect;


use App\Models\TblVille;
use App\Models\Signature;
use App\Models\Profession;
// use BaconQrCode\Encoder\QrCode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\AssuranceInfo;
use App\Models\ReseauProduct;
use App\Models\SuivieProspert;
use App\Models\contactProspert;
use App\Models\PartnerProspert;
use App\Models\ProductProspert;
use App\Models\ProduitGarantie;
use App\Models\ProspectProduct;
use App\Models\AdherentProspert;
use App\Models\DocumentProspert;
use App\Models\ProspectFollowup;
use App\Models\TblSecteurActivite;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index(Request $request)
    {
        $prospects = AdherentProspert::orderBy('created_at', 'desc')->paginate(20);

        $myProspects = AdherentProspert::where('reference_par', Auth::user()->idmembre)->where('etat' , 'Actif')->orderBy('created_at', 'desc')->paginate(20);
      

        return view('prospects.index', compact('prospects','myProspects'));
    }

    public function finish($uuid)
    {

        $prospect = AdherentProspert::where('uuid', $uuid)->firstOrFail();

        return view('prospects.finishStep', compact('prospect'));
    }

    public function signaturePad(Request $request)
    {

        Log::info($request->all());

        try{

            DB::beginTransaction();

            if ($request->has('signature')) {
                $signatureData = $request->input('signature');
                $signatureFileName = 'signature_' . $request->prospect_code . '.png';
                $signaturePath = 'signatures/' . $signatureFileName;
                Storage::disk('public')->put($signaturePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData)));

                AssuranceInfo::where('prospert_uuid', $request->prospect_uuid)->update([
                    'signature' => $signaturePath,
                ]);

                Signature::create([
                    'operation_type' => 'prospect_signature',
                    'reference_key' => $request->prospect_uuid,
                    'key_uuid' => Str::uuid(),
                    'signature_path' => $signaturePath,
                    'status' => 'pending',
                ]);
            }


            DB::commit();

            return $response = [
                'type' => 'success',
                'urlback' => 'back',
                'message' => "Enregistré avec succès!",
                'code' => 200,
            ];

        }catch(\Exception $e){
            DB::rollBack();

            log::info($e->getMessage());

            return $response = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $e->getMessage()",
                'code' => 500,
            ];
        }
            
    }


    private function getAllCountries()
    {
        $baseUrl = 'https://api.thecompaniesapi.com/v2/locations/countries';
        $allCountries = [];

        $page = 1;
        $lastPage = 1;

        do {
            // Appel de l’API avec pagination
            $response = Http::withOptions(['timeout' => 60])->get($baseUrl, [
                'page' => $page,
                'per_page' => 50,
            ]);

            if ($response->successful()) {
                $data = $response->json();

                // Ajouter les pays de cette page
                if (isset($data['countries'])) {
                    $allCountries = array_merge($allCountries, $data['countries']);
                }

                // Pagination : on récupère la dernière page
                $lastPage = $data['meta']['lastPage'] ?? 1;
                $page++;
            } else {
                break; 
            }
        } while ($page <= $lastPage);

        // On récupère uniquement les noms français
        // $paysList = collect($allCountries)->filter()->sort()->values();

        return $allCountries;
    }


    public function create($token)
    {

        $response = Http::withOptions(['timeout' => 60])->get(config('services.base_url_api') . '/enov/villes');

        if ($response->successful()) {
            $villes = $response->json();
        } else {
            $villes = [];
        }

        $commerciale = User::where('idmembre', $token)->firstOrFail();

        $pays = $this->getAllCountries();

        // $productByReseau = ReseauProduct::select('CodeProduit')->where('codereseau', Auth::user()->membre->codereseau)->get();
        $productByReseau = ReseauProduct::select('CodeProduit')->where('codereseau', $commerciale->membre->codereseau)->get();

        $codeProduits = $productByReseau->pluck('CodeProduit')->toArray();

        $products = Product::whereIn('CodeProduit', $codeProduits)->get();

        $professions = Profession::select('MonLibelle')->get();
        $secteurActivites = TblSecteurActivite::orderBy('MonLibelle')->get();
        return view('prospects.create', compact('villes', 'professions', 'products', 'pays', 'commerciale','secteurActivites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function suivies()
    {
        //
    }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {

            Log::info($request->all());
            // 🔹 Générer un UUID et un code
            $uuid = (string) Str::uuid();
            $code = 'PROS-' . strtoupper(Str::random(6));

            // 🔹 Enregistrer l'adhérent principal
            $prospect = AdherentProspert::create([
                'uuid' => $uuid,
                'code' => $code,
                'civilite' => $request->civilite,
                'nom' => $request->nom,
                'prenom' => $request->prenom,
                'genre' => $request->genre,
                'date_naissance' => $request->date_naissance,
                'lieu_naissance' => $request->lieu_naissance,
                'lieu_residence' => $request->lieu_residence,
                'situation_matrimoniale' => $request->situation_matrimoniale,
                'type_piece_identite' => $request->type_piece_identite,
                'numero_piece_identite' => $request->numero_piece_identite,
                'email' => $request->email,
                'adresse' => $request->adresse,
                'pays' => $request->pays,
                'profession' => $request->profession,
                // 'employeur' => $request->employeur,
                'employeur' => $request->employeur,
                'personneRessource' => $request->personneRessource,
                'contactRessource' => $request->contactRessource,
                'personneRessource2' => $request->personneRessource2,
                'contactRessource2' => $request->contactRessource2,
                'notes' => $request->notes,
                'reference_par' => $request->commerciale_code,
            ]);

            // 🔹 Enregistrer le produit sélectionné
            if ($request->has('produits')) {
                foreach ($request->produits as $prod) {
                    ProductProspert::create([
                        'uuid' => (string) Str::uuid(),
                        'code' => 'PP-' . strtoupper(Str::random(6)),
                        'product_uuid' => $prod,
                        'prospert_uuid' => $uuid,
                    ]);
                }
            }

            // 🔹 Enregistrer la signature et informations assurance
            if ($uuid) {
                // $signatureData = $request->input('signature');
                // $signatureFileName = 'signature_' . time() . '.png';
                // $signaturePath = 'signatures/' . $signatureFileName;
                // Storage::disk('public')->put($signaturePath, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData)));
                $rib = $request->codeBanque .'-'. $request->codeGuichet .'-'. $request->numeroCompte .'-'. $request->cleRib;

                AssuranceInfo::create([
                    'uuid' => (string) Str::uuid(),
                    'code' => 'AS-' . strtoupper(Str::random(6)),
                    'produit_uuid' => $request->produits[0] ?? null,
                    // 'signature' => $signaturePath,
                    'datteEffet' => $request->datteEffet,
                    'modePaiement' => $request->modePaiement,
                    'periodicite' => $request->periodicite,
                    'dejaClient' => $request->dejaClient,
                    'assurerAuTerme' => $request->assurerAuTerme,
                    'duree' => $request->duree,
                    'prospert_uuid' => $uuid,
                    'banque' => $request->banque,
                    'rib' => $rib,
                    'codeBanque' => $request->codeBanque,
                    'codeGuichet' => $request->codeGuichet,
                    'numeroCompte' => $request->numeroCompte,
                    'cleRib' => $request->cleRib
                ]);
            }

            // 🔹 Enregistrer les contacts
            $contacts = json_decode($request->contacts, true);
            if (!empty($contacts)) {
                foreach ($contacts as $item) {
                    contactProspert::create([
                        'uuid' => (string) Str::uuid(),
                        'code' => 'CON-' . strtoupper(Str::random(6)),
                        'prospert_uuid' => $uuid,
                        'contactType' => $item['contactType'] ?? '',
                        'contact' => $item['contact'] ?? '',
                        'etat' => 'ACTIF',
                    ]);
                }
            }

            // 🔹 Enregistrer les partenaires
            $partners = json_decode($request->partners, true);

            log::info($partners);
            if (!empty($partners)) {
                foreach ($partners as $item) {
                    PartnerProspert::create([
                        'uuid' => (string) Str::uuid(),
                        'code' => 'PART-' . strtoupper(Str::random(6)),
                        'prospert_uuid' => $uuid,
                        'nom' => $item['nom'] ?? '',
                        'prenom' => $item['prenom'] ?? '',
                        'genre' => $item['genre'] ?? '',
                        'civilite' => $item['civilite'] ?? '',
                        'naturepiece' => $item['naturepiece'] ?? '',
                        'numeropiece' => $item['numeropiece'] ?? '',
                        'email' => $item['email'] ?? '',
                        'situationMatrimoniale' => $item['situationMatrimoniale'] ?? '',
                        'dateNaissance' => $item['dateNaissance'] ?? '',
                        'lieuNaissance' => $item['lieuNaissance'] ?? '',
                        'lieuResidence' => $item['lieuResidence'] ?? '',
                        'adresseComplete' => $item['adresseComplete'] ?? '',
                        'profession' => $item['profession'] ?? '',
                        'employeur' => $item['employeur'] ?? '',
                        'mobile' => $item['mobile'] ?? '',
                        'filliation_code' => $item['filliation_code'] ?? '',
                        'code_partner' => $item['type'] ?? '',
                    ]);
                }
            }

           $documents = $request->file('documents');

            Log::info('documents reçus');
            Log::info($request->file('documents'));

            if ($documents) {
                foreach ($documents as $index => $doc) {

                    if (!isset($doc['file']) || !$doc['file']->isValid()) {
                        continue;
                    }

                    $nature = $request->input("documents.$index.nature");

                    $path = $doc['file']->store('prospects_docs', 'public');

                    DocumentProspert::create([
                        'uuid' => (string) Str::uuid(),
                        'code' => 'DOC-' . strtoupper(Str::random(6)),
                        'prospert_uuid' => $uuid,
                        'filepath' => $path,
                        'fileName' => $doc['file']->getClientOriginalName(),
                        'nature' => $nature,
                        'etat' => 'ACTIF',
                    ]);
                }
            }


            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Prospect enregistré avec succès',
                'code' => $code,
                'uuid' => $uuid
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erreur: ' . $e->getMessage()
            ], 500);
        }
    }


    public function addProduct(request $request)
    {


        DB::beginTransaction();
        try {
            $code = Refgenerate(ProductProspert::class, 'P', 'code');

            // 🔹 Enregistrer les produits
            if (!empty($request->products)) {
                foreach ($request->products as $productId) {
                    ProductProspert::create([
                        'uuid' => (string) Str::uuid(),
                        'code' => $code,
                        'prospert_uuid' => $request->prospect_id,
                        'product_uuid' => $productId,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'type' => 'success',
                'urlback' => 'back',
                'message' => "Enregistré avec succès!",
                'code' => 200,
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error("Erreur lors de l'ajout de produit: " . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'ajout des produits',
                'error' => env('APP_DEBUG') ? $e->getMessage() : 'Une erreur est survenue',
                'urlback' => '' // Vous devriez mettre une URL valide ici
            ], 500);
        }
    }



    public function show($uuid)
    {

        // Dans le contrôleur
        $response = Http::withOptions(['timeout' => 60])->get(config('services.base_url_api') . '/enov/villes');

        if ($response->successful()) {
            $villes = $response->json();
            $villesMap = collect($villes)->keyBy('CodeVille')->map(function($ville) {
                return $ville['MonLibelle'];
            })->toArray();
        } else {
            $villesMap = [];
        }

        $badgeColors = [
            'mobile'   => 'primary',
            'fixe'     => 'danger',
            'whatsapp' => 'success',
            'email'    => 'warning',
            'Wave'     => 'info',
        ];

        $prospect = AdherentProspert::with(['followups.user'])->where('uuid', $uuid)->firstOrFail();
        $assurance = AssuranceInfo::where('code', $prospect->code)->first();
        $contacts = ContactProspert::where('prospert_uuid', $prospect->uuid)->get();
        $partenaires = PartnerProspert::where('prospert_uuid', $prospect->uuid)->get();
        $documents = DocumentProspert::where('prospert_uuid', $prospect->uuid)->get();
        $produits = ProductProspert::where('prospert_uuid', $prospect->uuid)->get();
        // $allProducts = Product::orderBy('MonLibelle')->get();

        $productByReseau = ReseauProduct::select('CodeProduit')
            ->where('codereseau', Auth::user()->membre->codereseau)
            ->get();

        $codeProduits = $productByReseau->pluck('CodeProduit')->toArray();

        $allProducts = Product::whereIn('CodeProduit', $codeProduits)->get();

   


        return view('prospects.show', compact('prospect', 'assurance', 'contacts', 'partenaires', 'documents', 'produits','villesMap','badgeColors','allProducts'));
    }


    public function storeFollowup(Request $request, $uuid)
    {
    
        $prospect = AdherentProspert::where('uuid', $uuid)->firstOrFail();
        
        $followup = SuivieProspert::create([
            'uuid' => Str::uuid(),
            'prospect_uuid' => $prospect->uuid,
            'type' => $request->type,
            'notes' => $request->notes,
            'followup_date' => $request->followup_date,
            'next_followup_date' => $request->next_followup_date,
            'status' => $request->status,
            'user_id' => Auth::user()->idmembre
        ])->save();
        
        // Mettre à jour le statut du prospect si nécessaire
        if ($request->status === 'completed' && $prospect->status === 'nouveau') {
            $prospect->update(['status' => 'en_cours']);
        }
        
        return redirect()->back()->with('success', 'Suivi enregistré avec succès');
    }

    public function convertToClient(Request $request, $uuid)
    {
        $prospect = AdherentProspert::where('uuid', $uuid)->firstOrFail();
        $partner = PartnerProspert::where('prospert_uuid', $uuid)->get();
        $assures = PartnerProspert::where('prospert_uuid', $uuid)->where('code_partner', 'ASS')->get();
        $beneficiaries = PartnerProspert::where('prospert_uuid', $uuid)->where('code_partner', 'BEN')->get();
        $products = ProductProspert::where('prospert_uuid', $uuid)->get();
        $allProducts = ReseauProduct::select('codeproduit', 'libelleproduit')
            ->where('codereseau', Auth::user()->membre->codereseau)->get();

        
        return view('productions.create.createProspert', compact('prospect','assures', 'beneficiaries', 'products','allProducts'));
    }

    public function edit($uuid)
    {
        $prospect = Prospect::where('uuid', $uuid)->firstOrFail();
        $professions = Profession::orderBy('MonLibelle')->get();
        $secteurActivites = TblSecteurActivite::orderBy('MonLibelle')->get();
        $product = Product::orderBy('MonLibelle')->get();
        $villes = TblVille::orderBy('idville')->get();
        
        return view('prospects.edit', compact('prospect', 'professions', 'secteurActivites', 'product', 'villes'));
    }

    public function update(Request $request, $uuid)
    {

        $prospectfirst = Prospect::where('uuid', $uuid)->firstOrFail();


        $prospect = Prospect::where('uuid', $uuid)->update(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'profession_uuid' => $request->profession_uuid,
                'secteurActivity_uuid' => $request->secteurActivity_uuid,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'adress' => $request->adress,
                'city' => $request->city,
                'natureProspect' => $request->natureProspect,
                'produit_id' => $request->produit_id,
                'typeCompagnie' => $request->typeCompagnie,
                'lieuEvenement' => $request->lieuEvenement,
                'status' => $request->status,
                'note' => $request->note,
                'update_by' => auth()->user()->idmembre,
                'updated_at' => now(),
            ]
        );

        if (!empty($request->products)) {
            foreach ($request->products as $productId) {
                ProspectProduct::create([
                    'prospect_id' => $prospectfirst->id,
                    'product_id' => $productId,
                ]);
            }
        }


        return redirect()->route('prospect.show', $prospectfirst->id)
            ->with('success', 'Prospect mis à jour avec succès');
    }

    public function assign(request $request, $uuid)
    {
        try {
            Prospect::where('uuid', $uuid)->update([
                'assign_to' => $request->assignedTo,
                'assigned_by' => auth()->user()->idmembre,
                'assign_date' => now(),
                'note' => $request->note,
            ]);

            DB::commit();

            return response()->json([
                'type' => 'success',
                'urlback' => " ",
                'message' => "Enregistré avec succès !",
                'code' => 200,
            ]);

            
        } catch (\Throwable $th) {
            Log::error("Erreur système: ", ['error' => $th]);
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    /**
     * Update the specified resource in storage.
     */
   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $prospectId, string $productId)
    {
        
        try {
            $deleted = ProspectProduct::where([
                'product_id' => $productId,
                'prospect_id' => $prospectId
            ])->delete();

            if (!$deleted) {
                throw new \Exception('Produit non trouvé');
            }

            return response()->json([
                'success' => true,
                'message' => 'Produit supprimé avec succès'
            ]);

            Log::info("mise a jour reussir");

        } catch (\Exception $e) {

            Log::info("une erreur es survenue");
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    // App\Http\Controllers\ProspectionController.php
    public function showForm($token)
    {
        $commercial = User::where('idmembre', $token)->firstOrFail();

        $professions = Profession::orderBy('MonLibelle')->get();
        $secteurActivites = TblSecteurActivite::orderBy('MonLibelle')->get();
        $product = Product::orderBy('MonLibelle')->get();
        $villes = TblVille::orderBy('idville')->get();
        
        return view('prospects.apiPropect', [
            'commercial' => $commercial,
            'token' => $token,
            'professions' => $professions,
            'secteurActivites' => $secteurActivites,
            'product' => $product,
            'villes' => $villes,
        ]);
    }

    public function storeProspect(Request $request, $token)
    {
        $commercial = User::where('qr_code_token', $token)->firstOrFail();
        
        {
            // Validation des données
            $validated = $request->validate([
                // 'code' => 'required|string|max:191|unique:prospects',
                'first_name' => 'required|string|max:191',
                'last_name' => 'required|string|max:191',
                'email' => 'nullable|email|max:191',
                'mobile' => 'nullable|string|max:191',
                'adress' => 'nullable|string|max:191',
                'city' => 'nullable|string|max:191',
                'profession_uuid' => 'nullable|string|max:191',
                'secteurActivity_uuid' => 'nullable|string|max:191',
                'natureProspect' => 'nullable|string|max:191',
                'produit_id' => 'nullable|string|max:191',
                'montantPrime' => 'nullable|string|max:191',
                'dateEffet' => 'nullable|date',
                'typeCompagnie' => 'nullable|string|max:191',
                'modeDePaiment' => 'nullable|string|max:191',
                'lieuEvenement' => 'nullable|string|max:191',
                'etat' => 'nullable|string|max:191',
                'status' => 'nullable|string|max:191',
                'note' => 'nullable|string',
                'products' => 'nullable|array',
                'products.*' => 'integer|exists:tblproduit,IdProduit', 
            ]);
    
            
    
            try {
                $code = Refgenerate(Prospect::class, 'P', 'code');
                // Création du prospect
                $prospect = new Prospect();
                $prospect->uuid = Str::uuid();
                $prospect->code = $code;
    
                $prospect->first_name = $validated['first_name'];
                $prospect->last_name = $validated['last_name'];
                $prospect->email = $validated['email'] ?? null;
                $prospect->mobile = $validated['mobile'] ?? null;
                $prospect->adress = $validated['adress'] ?? null;
                $prospect->city = $validated['city'] ?? null;
                $prospect->profession_uuid = $validated['profession_uuid'] ?? null;
                $prospect->secteurActivity_uuid = $validated['secteurActivity_uuid'] ?? null;
                $prospect->natureProspect = $validated['natureProspect'] ?? null;
                // $prospect->produit_id = $validated['produit_id'] ?? null;
                $prospect->montantPrime = $validated['montantPrime'] ?? null;
                $prospect->dateEffet = $validated['dateEffet'] ?? null;
                $prospect->typeCompagnie = $validated['typeCompagnie'] ?? null;
                $prospect->modeDePaiment = $validated['modeDePaiment'] ?? null;
                $prospect->lieuEvenement = $validated['lieuEvenement'] ?? null;
                $prospect->etat = $validated['etat'] ?? 'actif';
                $prospect->status = $validated['status'] ?? 'nouveau';
                $prospect->note = $validated['note'] ?? null;
                $prospect->userAdd_uuid = $commercial->id;
                
                $prospect->save();
    
                // Vérifie s'il y a des produits sélectionnés
                if (!empty($request->products)) {
                    foreach ($request->products as $productId) {
                        ProspectProduct::create([
                            'prospect_id' => $prospect->id,
                            'product_id' => $productId,
                        ]);
                    }
                }
    
    
    
                return response()->json([
                    'type' => 'success',
                    'urlback' => url("https://web.yakoafricassur.com/"),
                    'message' => "Enregistré avec succès !",
                    'code' => 200,
                    'data' => $prospect
                ]);
    
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erreur lors de la création du prospect',
                    'error' => $e->getMessage()
                ], 500);
            }
        }
    }

    public function downloadQrCode()
    {
        $user = auth()->user();
        
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
            ->size(500)
            ->generate(route('prospection.form', $user->qr_code_token));
        
        return response($qrCode)
            ->header('Content-Type', 'image/svg')
            ->header('Content-Disposition', 'attachment; filename="qr-code-prospection.svg"');
    }

  
}
