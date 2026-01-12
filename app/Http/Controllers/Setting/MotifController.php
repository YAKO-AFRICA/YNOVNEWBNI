<?php

namespace App\Http\Controllers\Setting;

use App\Models\MotifRejet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\TblMotifrejetprestation;

class MotifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $motifsProposition = MotifRejet::where('etat', 'actif')->get();
        $motifsPrestation = TblMotifrejetprestation::where('etat', 1)->get();

        $MotifRejet = [
            'Proposition' => $motifsProposition,
            'Prestation' => $motifsPrestation
        ];

        return view('settings.motifs.index', compact('MotifRejet'));
    }
    public function indexMotifProposition()
    {
        $motifs = MotifRejet::where('etat', 'actif')->get();

        return view('settings.motifs.proposition.index', compact('motifs'));
    }

    public function indexMotifPrestation()
    {
        $motifs = TblMotifrejetprestation::where('etat', 1)->get();

        return view('settings.motifs.prestation.index', compact('motifs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeMotifProposition(Request $request)
    {

        DB::beginTransaction();
        try {
            $MotifRejet = MotifRejet::create([
                'libelle' => $request->libelle,
                'etat' => 'actif',
                
            ])->save();

            DB::commit();

            if($MotifRejet){
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
    public function storeMotifPrestation(Request $request)
    {

        DB::beginTransaction();
        try {
            $MotifRejet = TblMotifrejetprestation::create([
                'code' => RefgenerateCodeMotifRejet(TblMotifrejetprestation::class, 'MRP', 'code'),
                'libelle' => $request->libelle,
                'keyword' => '',
                'etat' => 1,
                
            ])->save();

            DB::commit();

            if($MotifRejet){
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
     * Update the specified resource in storage.
     */
    public function updateMotifProposition(Request $request, string $id)
    {

        DB::beginTransaction();
        try {
            $MotifRejet = MotifRejet::where(['id'=>$id])->update([
                'libelle' => $request->libelle
            ]);

            DB::commit();

            if($MotifRejet){
                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Modification enregistré avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            }else{
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur Modification !",
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

    public function updateMotifPrestation(Request $request, string $id)
    {

        DB::beginTransaction();
        try {
            $MotifRejet = TblMotifrejetprestation::where(['id'=>$id])->update([
                'libelle' => $request->libelle
            ]);

            DB::commit();

            if($MotifRejet){
                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Modification enregistré avec succes!",
                    'code'=>200,
                ];
                DB::commit();
            }else{
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur Modification !",
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
     * Remove the specified resource from storage.
     */
    public function destroyMotifProposition(string $id)
    {

        DB::beginTransaction();
        try {

            $deleted= MotifRejet::where(['id'=>$id])->update(['etat'=>'inactif']);

            if ($deleted) {

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

    public function destroyMotifPrestation(string $id)
    {

        DB::beginTransaction();
        try {

            $deleted= TblMotifrejetprestation::where(['id'=>$id])->update(['etat'=> 0]);

            if ($deleted) {

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
