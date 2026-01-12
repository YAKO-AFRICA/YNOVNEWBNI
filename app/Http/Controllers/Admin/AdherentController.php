<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contrat;
use App\Models\Adherent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdherentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function storeSession(Request $request)
    {
        $contacts = session('contacts', []);
        $contacts[] = $request->contact;
        session(['contacts' => $contacts]);

        return response()->json([
            'success' => true,
            'contacts' => $contacts
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $contrat = Contrat::where('id', $request->contrat_id)->first();

        DB::beginTransaction();
        try {
            $sexe = $request->civilite === "Monsieur" ? "M" : "F";
                

                $Adherent = Adherent::where('id', $request->id)->update([
                    'civilite' => $request->civilite,
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'datenaissance' => $request->datenaissance,
                    'lieunaissance' => $request->lieunaissance,
                    'sexe' => $sexe,
                    'numeropiece' => $request->numeropiece,
                    'naturepiece' => $request->naturepiece,
                    'lieuresidence' => $request->lieuresidence,
                    'profession' => $request->profession,
                    'employeur' => $request->employeur,
                    'pays' => $request->pays,
                    'email' => $request->email,
                    'telephone' => $request->telephone,
                    'telephone1' => $request->telephone1,
                    'mobile' => $request->mobile,
                    'codemembre' => 0,
                    'mobile1' => $request->mobile1,
                    'saisieLe' => now(),
                    'saisiepar' => Auth::user()->membre->idmembre,
                    'refcontratsource' => $request->refcontratsource,
                    'cleintegration' => $request->cleintegration,
                    'id_maj' => $request->id_maj,
                    'connexe' => $request->connexe,
                    'contratconnexe' => $request->contratconnexe,
                    'capitalconnexe' => $request->capitalconnexe
                ]);

                $contrat::where('id', $request->contrat_id)->update([
                    'personneressource' => $request->personneressource,
                    'contactpersonneressource' => $request->contactpersonneressource,
                    'personneressource2' => $request->personneressource2,
                    'contactpersonneressource2' => $request->contactpersonneressource2,
                ]);

                DB::commit();
            
                return response()->json([
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Enregistré avec succès!",
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
