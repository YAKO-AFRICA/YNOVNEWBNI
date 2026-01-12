<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Utilisateur non connecté'], 401);
        }

            // All Contrat by user
            $user = Auth::user();
            $myAllContrats = Contrat::where('saisiepar', $user->idmembre)->get();

            // mes saisie de la journée
            $myDayContrats = Contrat::where('saisiepar', $user->idmembre)
            ->whereBetween('saisiele', [
                now()->startOfDay(),
                now()->endOfDay(),
            ])->get();

            $myContratsMonth = Contrat::where('saisiepar', $user->idmembre)
            ->whereBetween('saisiele', [
                now()->startOfMonth(),
                now()->endOfMonth(), 
            ])->get();

            // contrat en saisie par encore transmis etape 1
            $myAllContratEnSaisie = Contrat::where(['saisiepar' => $user->idmembre, 'etape' => 1])->get();

            $myAllContratEnSaisieMonth = Contrat::where(['saisiepar' => $user->idmembre, 'etape' => 1])
            ->whereBetween('saisiele', [
                now()->startOfMonth(),
                now()->endOfMonth(), 
            ])->get();

            // contrat saisie et transmis etape 2
            $myAllContratTransmis = Contrat::where(['saisiepar' => $user->idmembre, 'etape' => 2])->get();
            $myAllContratTransmisMonth = Contrat::where(['saisiepar'=> $user->idmembre, 'etape' => 2])
            ->whereBetween('saisiele', [
                now()->startOfMonth(),
                now()->endOfMonth(), 
            ])->get();

            // contrat migrer etape 3
            $myAllContratMigrer = Contrat::where(['saisiepar' => $user->idmembre, 'etape' => 3])->get();
            $myAllContratMigrerMonth = Contrat::where(['saisiepar'=> $user->idmembre, 'etape' => 3])
            ->whereBetween('saisiele', [
                now()->startOfMonth(),
                now()->endOfMonth(), 
            ])->get();

            // contrat rejetter etape 4
            $myAllContratRejetter = Contrat::where(['saisiepar' => $user->idmembre, 'etape' => 4])->get();
            $myAllContratRejetterMonth = Contrat::where(['saisiepar'=> $user->idmembre, 'etape' => 4])
            ->whereBetween('saisiele', [
                now()->startOfMonth(),
                now()->endOfMonth(), 
            ])->get();


            // etat de souscription annuel

            $year = now()->year;

            // total de production sur une année 

            $contratsAnnuel = Contrat::where('saisiepar', $user->idmembre)
                ->whereYear('saisiele', $year)
                ->get();

            // total de production accepter sur une année
            $contratsAccepterAnnuel = Contrat::where(['saisiepar'=> $user->idmembre, 'etape' => 3])
                ->whereYear('saisiele', $year)
                ->get();

                // Nombre total de contrats
            $totalContrats = $contratsAnnuel->where('etape',2)->count();
            // rejet sur l'année en cours
            $totalRejetPerYears = $contratsAnnuel->where('etape',4)->count();

            // Nombre de contrats acceptés
            $totalAccepter = $contratsAccepterAnnuel->count();


            // Calcul du taux d'acceptation
            $tauxAcceptation = ($totalContrats > 0) ? ($totalAccepter / $totalContrats) * 100 : 0;

            // Groupement par mois pour les contrats transmis (étape 2)
            $contratsTransmisParMois = Contrat::where('saisiepar', $user->idmembre)
                ->where('etape', 2)
                ->whereYear('saisiele', $year)
                ->selectRaw('MONTH(saisiele) as mois, COUNT(*) as total')
                ->groupBy('mois')
                ->pluck('total', 'mois');

            // Groupement par mois pour les contrats migrés (étape 3)
            $contratsMigrerParMois = Contrat::where('saisiepar', $user->idmembre)
                ->where('etape', 3)
                ->whereYear('saisiele', $year)
                ->selectRaw('MONTH(saisiele) as mois, COUNT(*) as total')
                ->groupBy('mois')
                ->pluck('total', 'mois');

            // Générer un tableau de 12 mois avec des valeurs par défaut à 0
            $dataTransmis = array_fill(1, 12, 0);
            $dataMigrer = array_fill(1, 12, 0);

            // Remplir les données réelles
            foreach ($contratsTransmisParMois as $mois => $total) {
                $dataTransmis[$mois] = $total;
            }

            foreach ($contratsMigrerParMois as $mois => $total) {
                $dataMigrer[$mois] = $total;
            }

            $allContratsDistinct = Contrat::where('partenaire', $user->codepartenaire)->select('libelleproduit', DB::raw('COUNT(*) as nombre'), DB::raw('SUM(prime) as total_prime'))
            ->groupBy('codeproduit', 'libelleproduit')
            ->get();

            $productData = [];
            $productLabels = [];

            
            foreach ($allContratsDistinct as $item) {
                if ($item->libelleproduit && $item->total_prime !== null) {
                    $productLabels[] = $item->libelleproduit;
                    $productData[] = $item->total_prime;
                }
            }


            $userData = collect([

                // All contrat
                'user' => $user,
                'myAllContrats' => $myAllContrats,
                'myContratsMonth' => $myContratsMonth,
                // mes saisie du jours
                'myDayContrats' => $myDayContrats,
                // my contrat annule
                'contratsAnnuel' => $contratsAnnuel,
                // en saisie
                'myAllContratEnSaisie' => $myAllContratEnSaisie,
                'myAllContratEnSaisieMonth' => $myAllContratEnSaisieMonth,
                // transmis
                'myAllContratTransmis' => $myAllContratTransmis,
                'myAllContratTransmisMonth' => $myAllContratTransmisMonth,
                //migrer
                'myAllContratMigrer' => $myAllContratMigrer,
                'myAllContratMigrerMonth' => $myAllContratMigrerMonth,
                // rejetter
                'myAllContratRejetter' => $myAllContratRejetter,
                'myAllContratRejetterMonth' => $myAllContratRejetterMonth,
                // taux acceptation
                'tauxAcceptation' => $tauxAcceptation,
                // total rejet per year count
                'totalRejetPerYears' => $totalRejetPerYears,
                // all contrat distinct
            ]);

            


        return view('home', 
        ['userData' => $userData, 
        'dataTransmis' => $dataTransmis, 
        'dataMigrer' => $dataMigrer, 
        'productData' => $productData, 
        'productLabels' => $productLabels]);
    }
}

