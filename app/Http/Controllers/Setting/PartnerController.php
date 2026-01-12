<?php

namespace App\Http\Controllers\Setting;

use Throwable;
use App\Models\Partner;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $partners = Partner::orderBy('id', 'desc')->get();
        return view('settings.partners.index', compact('partners'));
    }

    public function updateColumnsPart(Request $request)
    {
        // Sauvegarde des colonnes dans la session
        $columns = $request->input('columns', []);
        session(['activeColumns' => $columns]);

        return redirect()->back()->with('success', 'Colonnes mises à jour avec succès.');
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

        DB::beginTransaction();
        try {
            $code = $request->code;

            $logo= $request->logo ?? "";
            if($logo == null) {
                $logo= "default_logo.png";
            }else{
                $file = $request->file('logo');
             //    dd($logos);
                $logo = $code . "." . $file->getClientOriginalExtension();
                $file->move('logos/',$logo);
            }

            $partner = Partner::create([
                'code' => $code,
                'logo' => $logo,
                'designation' => $request->designation,
                'activitesprincipales' => $request->activitesprincipales,
                'capital' => $request->capital,
                'nrc' => $request->nrc,
                'formejuridique' => $request->forme_juridique,
                'comptecontribuable' => $request->compte_contribuable,
                'mobile1' => $request->mobile1,
                'mobile2' => $request->mobile2,
                'adresseemail' => $request->adresseemail,
                'telephone' => $request->telephone,
                'siteweb' => $request->siteweb,
                // 'convention' => $request->convention,
                
            ])->save();

            DB::commit();

            if($partner){
                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Enregistré avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            }else{
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur d'enregistrement !",
                    'code'=>500,
                ];
                DB::rollBack();
            }
            

        } catch (Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! .".$th->getMessage(),
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
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
            // Trouver le partenaire existant
            $partner = Partner::findOrFail($id);
    
            // Gestion du logo
            $logo = $partner->logo ?? "default_logo.png";
    
            if ($request->hasFile('logo')) {
                // Si un nouveau logo est téléchargé
                $file = $request->file('logo');
                $logoExtension = $file->getClientOriginalExtension();
                $logo = $partner->code . "." . $logoExtension;
    
                // Supprimer l'ancien logo s'il existe et n'est pas le logo par défaut
                if ($partner->logo && $partner->logo !== "default_logo.png") {
                    $oldLogoPath = public_path('logos/' . $partner->logo);
                    if (file_exists($oldLogoPath)) {
                        unlink($oldLogoPath); // Supprimer l'ancien logo
                    }
                }
    
                // Déplacer le nouveau logo
                $file->move(public_path('logos'), $logo);
            }
    
            // Mettre à jour les autres champs du partenaire
            $partner->update([
                'logo' => $logo,
                'designation' => $request->input('designation'),
                'activitesprincipales' => $request->input('activitesprincipales'),
                'capital' => $request->input('capital'),
                'nrc' => $request->input('nrc'),
                'formejuridique' => $request->input('forme_juridique'),
                'comptecontribuable' => $request->input('compte_contribuable'),
                'mobile1' => $request->input('mobile1'),
                'mobile2' => $request->input('mobile2'),
                'adresseemail' => $request->input('adresseemail'),
                'telephone' => $request->input('telephone'),
                'siteweb' => $request->input('siteweb'),
                // 'convention' => $request->input('convention'),
            ]);
    
            // Si tout s'est bien passé, on commit les changements
            DB::commit();
    
            // Réponse en cas de succès
            $dataResponse = [
                'type' => 'success',
                'urlback' => "back",
                'message' => "Partenaire modifié avec succès!",
                'code' => 200,
            ];
            
        } catch (Throwable $th) {
            // En cas d'erreur, on annule la transaction et on capture l'exception
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur système! " . $th->getMessage(),
                'code' => 500,
            ];
        }
    
        return response()->json($dataResponse);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        DB::beginTransaction();
        try {

            $saving= Partner::where(['id'=>$id])->delete();

            if ($saving) {

                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Supprimé avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de la suppression!",
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
}
