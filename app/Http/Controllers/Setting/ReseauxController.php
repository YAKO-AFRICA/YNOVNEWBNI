<?php

namespace App\Http\Controllers\Setting;

use App\Models\Reseau;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductFormule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReseauxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $reseaux = Reseau::orderBy('id', 'desc')->get();
        $products = Product::all();
        $formules = ProductFormule::all();
        return view('settings.reseaux.index', compact('reseaux', 'products', 'formules'));
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
            $reseau = Reseau::create([
                'codereseau' => Refgenerate(Reseau::class, 'RS', 'codereseau'),
                'libelle' => $request->libelle,
                'coderesponsable' => $request->coderesponsable,
                'codebranche' => $request->codebranche,
                'nomresponsable' => $request->nomresponsable,
                'codepartenaire' => $request->codepartenaire,
            ])->save();

            if($reseau){
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
            

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! ".$th->getMessage(),
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
            $reseau = Reseau::where('id', $id)->update([
                'libelle' => $request->libelle,
                'coderesponsable' => $request->coderesponsable,
                'codebranche' => $request->codebranche,
                'nomresponsable' => $request->nomresponsable,
                'codepartenaire' => $request->codepartenaire,
            ]);

            if($reseau){
                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Modifié avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            }else{
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur de modification !",
                    'code'=>500,
                ];
                DB::rollBack();
            }
            

        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur systeme! ".$th->getMessage(),
                'code'=>500,
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

            $saving= Reseau::where(['id'=>$id])->delete();

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
