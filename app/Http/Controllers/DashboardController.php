<?php

namespace App\Http\Controllers;

use App\Models\Contrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     if (!Auth::check()) {
    //         return response()->json(['error' => 'Utilisateur non connecté'], 401);
    //     }

    //     $user = Auth::user();

    //     $myContrats = Contrat::where('saisiepar', $user->idmembre)->get();
    //     $contrats = Contrat::all();


    //     // mes contrats du week end en cours 
    //     $myContratsWeek = Contrat::where('saisiepar', $user->idmembre)
    //     ->whereBetween('saisiele', [
    //         now()->startOfWeek()->format('Y-m-d'),
    //         now()->endOfWeek()->format('Y-m-d')
    //     ])->get();


    //     $data = [
    //         'myContrats' => $myContrats,
    //         'contrats' => $contrats
    //     ];

    //     return response()->json($data);
    // }


    public function index()
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Utilisateur non connecté'], 401);
        }

        $user = Auth::user();

        $totalContrats = Contrat::count();
        $myAllContrats = Contrat::where('saisiepar', $user->idmembre)->count();

        $myContratsWeek = Contrat::where('saisiepar', $user->idmembre)
            ->whereBetween('saisiele', [
                now()->startOfWeek(),
                now()->endOfWeek(),
            ])->count();

        $contratsEtape2 = Contrat::where('etape', 2)->count();
        $contratsEtape2Week = Contrat::where('etape', 2)
            ->whereBetween('saisiele', [
                now()->startOfWeek(),
                now()->endOfWeek(),
            ])->count();

        $contratsMigrer = Contrat::where('etape', 3)->count();
        $contratsRejetter = Contrat::where('etape', 4)->count();

        $data = collect([
            'myAllContrats' => $myAllContrats,
            'totalContrats' => $totalContrats,
            'myContratsWeek' => $myContratsWeek,
            'contratsEtape2' => $contratsEtape2,
            'contratsEtape2Week' => $contratsEtape2Week,
            'contratsMigrer' => $contratsMigrer,
            'contratsRejetter' => $contratsRejetter,
        ]);

        return view('home', ['data' => $data]);
    }

}
