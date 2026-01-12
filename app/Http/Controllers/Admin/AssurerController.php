<?php

namespace App\Http\Controllers\Admin;

use App\Models\Assurer;
use App\Models\Contrat;
use App\Models\SanteAssur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AssurerController extends Controller
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
        // \dd($request->all());
        DB::beginTransaction();
        try {
            $contrat = Contrat::where('id', $request->contrat)->first();

            $sexe = $request->civiliteAssur === "Monsieur" ? "M" : "F";

            $idAssure = Assurer::max('id') + 1;

            Assurer::create([
                'id' => $idAssure,
                'civilite' => $request->civiliteAssur,
                'nom' => $request->nomAssur,
                'prenom' => $request->prenomAssur,
                'datenaissance' => $request->datenaissanceAssur,
                'lieunaissance' => $request->lieunaissanceAssur,
                'codecontrat' => $contrat->id,
                'codeadherent' => $contrat->codeadherent,
                'sexe' => $sexe,
                'numeropiece' => $request->numeropieceAssur,
                'naturepiece' => $request->naturepieceAssur,
                'lieuresidence' => $request->lieuresidenceAssur,
                'email' => $request->emailAssur,
                'telephone' => $request->telephone,
                'telephone1' => $request->telephone1,
                'mobile' => $request->mobileAssur,
                'codemembre' => 0,
                'mobile1' => $request->mobile1,
                'saisieLe' => now(),
                'saisiepar' => Auth::user()->membre->idmembre,
            ])->save();

            // // Ajouter les pathologies de santé
            // SanteAssur::create([
            //     'EtatSante' => $request->EtatSante,
            //     'diabete' => $request->diabete,
            //     'avc' => $request->avc,
            //     'cancer' => $request->cancer,
            //     'insuffRenal' => $request->insuffRenal,
            //     'hypertension' => $request->hypertension,
            //     'codeAssur' => $idAssure,
            //     'codeContrat' => $contrat->id
            // ])->save();

            // // Calcul de la surprime
            // $surprime = 0;

            // // Chaque pathologie cochée ajoute 5000 à la surprime
            // $pathologies = [
            //     'diabete' => $request->diabete,
            //     'avc' => $request->avc,
            //     'cancer' => $request->cancer,
            //     'insuffRenal' => $request->insuffRenal,
            //     'hypertension' => $request->hypertension,
            // ];

            // foreach ($pathologies as $pathologie => $value) {
            //     if ($value === 'true') {
            //         $surprime += 5000;
            //     }
            // }

            // // Mettre à jour la surprime sur le contrat
            // $contrat->update([
            //     'surprime' => $contrat->surprime + $surprime,
            //     'prime' => $contrat->primepricipale + $surprime,
            // ]);

            DB::commit();

            return response()->json([
                'type' => 'success',
                'urlback' => 'back',
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
            $assure = Assurer::where('id', $id)->first();
            $contrat = Contrat::where('id', $assure->codecontrat)->first();
    
            // Mise à jour des informations de l'assuré
            $sexe = $request->civilite === "Monsieur" ? "M" : "F";
    
            Assurer::where('id', $id)->update([
                'civilite' => $request->civiliteAssur,
                'nom' => $request->nomAssur,
                'prenom' => $request->prenomAssur,
                'datenaissance' => $request->datenaissanceAssur,
                'lieunaissance' => $request->lieunaissanceAssur,
                'sexe' => $sexe,
                'numeropiece' => $request->numeropieceAssur,
                'naturepiece' => $request->naturepieceAssur,
                'lieuresidence' => $request->lieuresidenceAssur,
                'email' => $request->emailAssur,
                'telephone' => $request->telephone,
                'telephone1' => $request->telephone1,
                'mobile' => $request->mobileAssur,
                'mobile1' => $request->mobile1,
            ]);
    
            // Récupérer les anciennes valeurs des pathologies
            $sante = SanteAssur::where('codeAssur', $id)->first();
    
            $pathologies = [
                'diabete' => $request->diabete,
                'avc' => $request->avc,
                'cancer' => $request->cancer,
                'insuffRenal' => $request->insuffRenal,
                'hypertension' => $request->hypertension,
            ];
    
            // Calculer la différence entre les anciennes et les nouvelles valeurs
            $surprime = 0;
            foreach ($pathologies as $pathologie => $value) {
                if ($value === 'true' && $sante->$pathologie !== 'true') {
                    // Si pathologie passe de false à true, ajouter 5000
                    $surprime += 5000;
                } elseif ($value === 'false' && $sante->$pathologie === 'true') {
                    // Si pathologie passe de true à false, soustraire 5000
                    $surprime -= 5000;
                }
            }
    
            // Mettre à jour les pathologies dans la table santé
            SanteAssur::where('codeAssur', $id)->update($pathologies);
    
            // Mettre à jour la surprime et la prime principale sur le contrat
            if ($surprime !== 0) {
                $contrat->update([
                    'surprime' => $contrat->surprime + $surprime,
                    'prime' => $contrat->primepricipale + $contrat->surprime + $surprime,
                ]);
            }
    
            DB::commit();
    
            return response()->json([
                'type' => 'success',
                'urlback' => 'back',
                'message' => "Modification enregistrée avec succès!",
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
    public function updateAssur(Request $request, string $id)
    {
        DB::beginTransaction();
        try {
    
            // Mise à jour des informations de l'assuré
            $sexe = $request->civilite === "Monsieur" ? "M" : "F";
    
            Assurer::where('id', $id)->update([
                'civilite' => $request->civiliteAssur,
                'nom' => $request->nomAssur,
                'prenom' => $request->prenomAssur,
                'datenaissance' => $request->datenaissanceAssur,
                'lieunaissance' => $request->lieunaissanceAssur,
                'sexe' => $sexe,
                'numeropiece' => $request->numeropieceAssur,
                'naturepiece' => $request->naturepieceAssur,
                'lieuresidence' => $request->lieuresidenceAssur,
                'email' => $request->emailAssur,
                'telephone' => $request->telephone,
                'telephone1' => $request->telephone1,
                'mobile' => $request->mobileAssur,
                'mobile1' => $request->mobile1,
            ]);
    
            DB::commit();
    
            return response()->json([
                'type' => 'success',
                'urlback' => 'back',
                'message' => "Modification enregistrée avec succès!",
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

    

    public function deleteAssure(string $id)
    {
        DB::beginTransaction();
        try {
            // Récupérer l'assuré
            $assure = Assurer::where('id', $id)->first();
    
            if (!$assure) {
                return response()->json([
                    'type' => 'success',
                    'urlback' => 'back',
                    'message' => "Assuré introuvable!",
                    'code' => 200,
                ]);
            }
    
            // Récupérer le contrat associé
            $contrat = Contrat::where('id', $assure->codecontrat)->first();
    
            // Récupérer les pathologies associées
            $sante = SanteAssur::where('codeAssur', $id)->first();
    
            if ($sante) {
                // Calculer la surprime à retirer
                $surprime = 0;
    
                $pathologies = [
                    'diabete' => $sante->diabete,
                    'avc' => $sante->avc,
                    'cancer' => $sante->cancer,
                    'insuffRenal' => $sante->insuffRenal,
                    'hypertension' => $sante->hypertension,
                ];
    
                foreach ($pathologies as $pathologie => $value) {
                    if ($value === 'true') {
                        $surprime += 5000;
                    }
                }
    
                // Mettre à jour la surprime sur le contrat
                if ($contrat) {
                    $contrat->update([
                        'surprime' => max(0, $contrat->surprime - $surprime),
                        'prime' => max(0, $contrat->primepricipale + $contrat->surprime - $surprime),
                    ]);
                }
    
                // Supprimer les données de santé
                $sante->delete();
            }
    
            // Supprimer l'assuré
            $assure->delete();
    
            DB::commit();
    
            return response()->json([
                'type' => 'success',
                'urlback' => 'back',
                'message' => "Suppression enregistrée avec succès!",
                'code' => 200,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'urlback' => 'back',
                'message' => "Erreur système ! $th",
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
