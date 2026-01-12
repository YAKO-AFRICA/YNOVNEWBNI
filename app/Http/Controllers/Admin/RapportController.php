<?php

namespace App\Http\Controllers\Admin;

use PDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
use App\Models\Pret;
use App\Models\Membre;
use App\Models\Contrat;
use App\Models\Product;
use App\Models\Prospect;
use App\Models\TblVille;
use App\Models\MotifRejet;
use App\Models\Profession;
use Illuminate\Http\Request;
use App\Models\TblSecteurActivite;
use App\Http\Controllers\Controller;
use App\Models\TblPrestation;
use Illuminate\Support\Facades\Auth;

class RapportController extends Controller
{
    public function eSouscription(Request $request)
    {
        $userPartner = Auth::user()->codepartenaire;

        $agents = Membre::where('codepartenaire', $userPartner)->get();

        $query = Contrat::where('partenaire', $userPartner);

        // Filtrer par date (de et à)
        if ($request->filled('dateFrom') && $request->filled('dateTo')) {
            $query->whereBetween('saisiele', [$request->dateFrom, $request->dateTo]);
        }

        // Filtrer par agent
        if ($request->filled('agent')) {
            $query->where('saisiepar', $request->agent);
        }

        // Filtrer par étape
        if ($request->filled('etape')) {
            $query->where('etape', $request->etape);
        }

        // Exécuter la requête
        $contrats = $query->get();


        $defaultColumns = ['#', 'Produit', 'Date Effet', 'Prime', 'Capital', 'Saisir Par', 'Status'];

        $additionalColumns = [
            'Mode de Paiement' => 'modepaiement',
            'Organisme' => 'organisme',
            'Prime' => 'prime',
            'Prime Principale' => 'primepricipale',
            'Capital' => 'capital',
            'Surprime' => 'surprime',
            'Date Effet' => 'dateeffet',
            'N° Compte' => 'numerocompte',
            'Agence' => 'agence',
            'Saisie Le' => 'saisiele',
            'Code Conseiller' => 'codeConseiller',
            'Nom Agent' => 'nomagent',
            'Duree' => 'duree',
            'Periodicite' => 'periodicite',
            'Code Adherent' => 'codeadherent',
            'Est Migre' => 'estMigre',
            'Transmis Le' => 'transmisle',
            'Annuler Le' => 'annulerle',
            'Accepter Le' => 'accepterle',
            'Modifier Le' => 'modifierle',
            'Modifier Par' => 'modifierpar',
            'Libelle Produit' => 'libelleproduit',
            'Personne Ressourource' => 'personneressource',
            'Contact Ressourource' => 'contactpersonneressource',
            'Beneficiaire Auterme' => 'beneficiaireauterme',
            'Beneficiaire Audeces' => 'beneficiaireaudeces',
            'Accepter Par' => 'accepterpar',
            'Rejeter Par' => 'rejeterpar',
            'Transmis Par' => 'transmispar',
            'Personne Ressource 2' => 'personneressource2',
            'Contact Ressource 2' => 'contactpersonneressource2',
            'Code Banque' => 'codebanque',
            'Code Guichet' => 'codeguichet',
            'Rib' => 'rib',
            'Id Proposition' => 'idproposition',
            'Code Proposition' => 'codeproposition',
            'Branche' => 'branche',
            'Partenaire' => 'partenaire',
            'Nom Accepter Par' => 'nomaccepterpar',
            'Ref Contrat Source' => 'refcontratsource',
            'Cle Integration' => 'cleintegration',
            'Code Operation' => 'codeoperation',
            'N° Police' => 'numeropolice',
            'Frais Adhesion' => 'fraisadhesion',
            'Est Paye' => 'estpaye',
            'Pret Connexe' => 'pretconnexe',
            'Details' => 'details',
        ];
        $activeColumns = session('activeColumns', []);

        $selectedStatus = $request->input('etape');

        // Retourner la vue avec les données
        return view('rapport.eSouscription', compact('contrats', 'agents', 'activeColumns', 'defaultColumns', 'additionalColumns'));
    }

    public function ePrestation(Request $request)
    {
        $user = Auth::user()->idmembre;

        $agents = Membre::where('idmembre', $user)->get();

        // $query = TblPrestation::where('saisiepar', $user);

        $query = TblPrestation::where('etape', '!=', '-1');
        

        // Filtrer par date (de et à)
        if ($request->filled('dateFrom') && $request->filled('dateTo')) {
            $query->whereBetween('created_at', [$request->dateFrom, $request->dateTo]);
        }

        // Filtrer par agent
        if ($request->filled('agent')) {
            $query->where('saisiepar', $request->agent);
        }

        // Filtrer par étape
        if ($request->filled('etape')) {
            $query->where('etape', $request->etape);
        }

        // Exécuter la requête
        $prestations = $query->get();
        // dd($prestations);


        $defaultColumns = ['#', 'code', 'ID contrat', 'type prestation', 'Montant souhaité', 'Mode de Paiement', 'Saisir Par', 'Status', 'Date création'];

        $additionalColumns = [
            'Nom ' => 'nom',
            'Prenom' => 'prenom',
            'Date Naissance' => 'datenaissance',
            'Lieu Naissance' => 'lieunaissance',
            'Telephone 1' => 'cel',
            'Telephone 2' => 'tel',
            'Email' => 'email',
            'Lieu Residence' => 'lieuresidence',
            'Operateur Paiement' => 'Operateur',
            'Tel Paiement' => 'telPaiement',
            'Code Banque' => 'codeBanque',
            'Code Guichet' => 'codeGuichet',
            'N° Compte' => 'numCompte',
            'Clé RIB' => 'cleRIB',
            'IBAN' => 'IBAN',
            'Traiter par' => 'traiterpar',
            'Traiter le' => 'traiterle',
            'Migree le' => 'migreele',
        ];
        $activeColumns = session('activeColumns', []);

        $selectedStatus = $request->input('etape');

        // Retourner la vue avec les données
        return view('rapport.ePrestation', compact('prestations', 'agents', 'activeColumns', 'defaultColumns', 'additionalColumns'));
    }
    public function ePret(Request $request)
    {
        $userPartner = Auth::user()->codepartenaire;

        $agents = Membre::where('codepartenaire', $userPartner)->get();

        $query = Pret::where('partenaire', $userPartner);


        // Filtrer par date (de et à)
        if ($request->filled('dateFrom') && $request->filled('dateTo')) {
            $query->whereBetween('saisiele', [$request->dateFrom, $request->dateTo]);
        }

        // Filtrer par agent
        if ($request->filled('agent')) {
            $query->where('saisiepar', $request->agent);
        }

        // Filtrer par étape
        if ($request->filled('etape')) {
            $query->where('etat', $request->etape);
        }

        // Exécuter la requête
        $prets = $query->get();



        $defaultColumns = ['#', 'Type', 'Date Effet', 'Prime Total', 'Montant', 'Saisir Par', 'Status'];

        $additionalColumns = [
            'Mode de Paiement' => 'modepaiement',
            'Organisme' => 'organisme',
            'Prime' => 'prime',
            'Prime Principale' => 'primepricipale',
            'Capital' => 'capital',
            'Surprime' => 'surprime',
            'Date Effet' => 'dateeffet',
            'N° Compte' => 'numerocompte',
            'Agence' => 'agence',
            'Saisie Le' => 'saisiele',
            'Code Conseiller' => 'codeConseiller',
            'Nom Agent' => 'nomagent',
            'Duree' => 'duree',
            'Periodicite' => 'periodicite',
            'Code Adherent' => 'codeadherent',
            'Est Migre' => 'estMigre',
            'Transmis Le' => 'transmisle',
            'Annuler Le' => 'annulerle',
            'Accepter Le' => 'accepterle',
            'Modifier Le' => 'modifierle',
            'Modifier Par' => 'modifierpar',
            'Libelle Produit' => 'libelleproduit',
            'Personne Ressourource' => 'personneressource',
            'Contact Ressourource' => 'contactpersonneressource',
            'Accepter Par' => 'accepterpar',
            'Rejeter Par' => 'rejeterpar',
            'Transmis Par' => 'transmispar',
            'Personne Ressource 2' => 'personneressource2',
            'Contact Ressource 2' => 'contactpersonneressource2',
            'Code Banque' => 'codebanque',
            'Code Guichet' => 'codeguichet',
            'Rib' => 'rib',
            'Id Proposition' => 'idproposition',
            'Code Proposition' => 'codeproposition',
            'N° Police' => 'numeropolice',
            'Frais Adhesion' => 'fraisadhesion',
            'Details' => 'details',
        ];
        $activeColumns = session('activeColumns', []);

        // Retourner la vue avec les données
        return view('rapport.ePret', compact('prets', 'agents', 'activeColumns', 'defaultColumns', 'additionalColumns'));
    }

    public function eValidation(Request $request)
    {

        $motifs = MotifRejet::where('etat', 'actif')->get();
        $userPartner = Auth::user()->codepartenaire;

        $agents = Membre::where('codepartenaire', $userPartner)->get();

        $query = Contrat::whereYear('saisiele', date('Y'));

        // Filtrer par date (de et à)
        if ($request->filled('dateFrom') && $request->filled('dateTo')) {
            $query->whereBetween('transmisle', [$request->dateFrom, $request->dateTo]);
        }
        if ($request->filled('dateFromValid') && $request->filled('dateToValid')) {
            $query->whereBetween('accepterle', [$request->dateFromValid, $request->dateToValid]);
        }
        
        // Filtrer par agent
        if ($request->filled('agent')) {
            $query->where('saisiepar', $request->agent);
        }

        // Filtrer par étape
        if ($request->filled('etape')) {
            $query->where('etape', $request->etape);
        }
        if ($request->filled('motifrejet')) {
            $query->where('motifrejet', $request->motifrejet);
        }

        // Exécuter la requête
        $contrats = $query->get();


        $defaultColumns = ['#', 'Produit', 'Date Effet', 'Prime', 'Capital', 'Saisir Par', 'Status'];

        $additionalColumns = [
            'Mode de Paiement' => 'modepaiement',
            'Organisme' => 'organisme',
            'Prime' => 'prime',
            'Prime Principale' => 'primepricipale',
            'Capital' => 'capital',
            'Surprime' => 'surprime',
            'Date Effet' => 'dateeffet',
            'N° Compte' => 'numerocompte',
            'Agence' => 'agence',
            'Saisie Le' => 'saisiele',
            'Code Conseiller' => 'codeConseiller',
            'Nom Agent' => 'nomagent',
            'Duree' => 'duree',
            'Periodicite' => 'periodicite',
            'Code Adherent' => 'codeadherent',
            'Est Migre' => 'estMigre',
            'Transmis Le' => 'transmisle',
            'Annuler Le' => 'annulerle',
            'Accepter Le' => 'accepterle',
            'Modifier Le' => 'modifierle',
            'Modifier Par' => 'modifierpar',
            'Libelle Produit' => 'libelleproduit',
            'Personne Ressourource' => 'personneressource',
            'Contact Ressourource' => 'contactpersonneressource',
            'Beneficiaire Auterme' => 'beneficiaireauterme',
            'Beneficiaire Audeces' => 'beneficiaireaudeces',
            'Accepter Par' => 'accepterpar',
            'Rejeter Par' => 'rejeterpar',
            'Transmis Par' => 'transmispar',
            'Personne Ressource 2' => 'personneressource2',
            'Contact Ressource 2' => 'contactpersonneressource2',
            'Code Banque' => 'codebanque',
            'Code Guichet' => 'codeguichet',
            'Rib' => 'rib',
            'Id Proposition' => 'idproposition',
            'Code Proposition' => 'codeproposition',
            'Branche' => 'branche',
            'Partenaire' => 'partenaire',
            'Nom Accepter Par' => 'nomaccepterpar',
            'Ref Contrat Source' => 'refcontratsource',
            'Cle Integration' => 'cleintegration',
            'Code Operation' => 'codeoperation',
            'N° Police' => 'numeropolice',
            'Frais Adhesion' => 'fraisadhesion',
            'Est Paye' => 'estpaye',
            'Pret Connexe' => 'pretconnexe',
            'Motif de rejet' => 'motifrejet',
            'Details' => 'details',
        ];
        $activeColumns = session('activeColumns', []);

        $selectedStatus = $request->input('etape');

        // Retourner la vue avec les données
        return view('rapport.validation', compact('contrats', 'agents', 'activeColumns', 'defaultColumns', 'additionalColumns','motifs'));
    }

    public function eProspection(Request $request)
    {
        $query = Prospect::orderBy('id', 'desc');

        if ($request->has('code') && !empty($request->code)) {
            $query->where('code', 'like', '%' . $request->code . '%');
        }

        if ($request->has('first_name') && !empty($request->first_name)) {
            $query->where('first_name', 'like', '%' . $request->first_name . '%');
        }

        if ($request->has('last_name') && !empty($request->last_name)) {
            $query->where('last_name', 'like', '%' . $request->last_name . '%');
        }

        if ($request->has('date_from') && !empty($request->date_from) && 
            $request->has('date_to') && !empty($request->date_to)) {
            $query->whereBetween('created_at', [
                Carbon::parse($request->date_from)->startOfDay(),
                Carbon::parse($request->date_to)->endOfDay()
            ]);
        }

        $allPropects = $query->get();

        $defaultColumns = ['#', 'Code', 'Nom Complet','Nature', 'Agent', 'Prochaine relance', 'Date', ];

        $additionalColumns = [
            'UUID' => 'uuid',
            'Code' => 'code',
            'Nom' => 'last_name',
            'Prrenom' => 'first_name',
            'Mobile' => 'mobile',
            'Email' => 'email',
            'Adresse' => 'adress',
            'Profession' => 'profession_uuid',
            'Secteur Activite' => 'secteurActivity_uuid',
            'Mode de Paiment' => 'modeDePaiment',
            'Type Compagnie' => 'typeCompagnie',
            'Ville' => 'city',
            'Lieu Evenement' => 'lieuEvenement',
            'Nature Prospect' => 'natureProspect',
            'Note' => 'note',
            'Produit' => 'produit_id',
            'Etat' => 'etat',
            'Status' => 'status',
            'User Add' => 'userAdd_uuid',
            'User Destroy' => 'userDestroy_uuid',
            'Destroy Date' => 'destroy_date',
            'Update By' => 'update_by',
            'Assign To' => 'assign_to',
            'Assigned By' => 'assigned_by',
            'Assign Date' => 'assign_date',
            'Created At' => 'created_at',
            'Updated At' => 'updated_at',
        ];
        $activeColumns = session('activeColumns', []);

        $product = Product::all();
        $villes = TblVille::select('libelleVillle')->get();
        $professions = Profession::select('MonLibelle')->get();
        $secteurActivites = TblSecteurActivite::select('MonLibelle')->get();

        if ($request->has('print')) {
            $pdf = PDF::loadView('prospects.print', compact('allPropects'));
            return $pdf->download('rapport_prospection_'.date('Y-m-d').'.pdf');
        }

        return view('rapport.prospection', compact('allPropects', 'villes', 'professions', 'secteurActivites', 'product', 'activeColumns', 'defaultColumns', 'additionalColumns'));
    }

}
