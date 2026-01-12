<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Reseau;
use App\Models\Product;
use App\Models\NotifGroup;
use Illuminate\Http\Request;
use App\Models\ReseauProduct;
use App\Models\TblPrestation;
use App\Models\ProductFormule;
use App\Models\TblTypePrestation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\TblProductPrestation;

class SettingsController extends Controller
{
    public function productByReseau()
    {

        $reseaux = Reseau::orderBy('id', 'desc')->get();
        $products = Product::orderBy('id', 'desc')->get();
        $formules = ProductFormule::all();
        return view('admin.settings.productByReseau', compact('reseaux', 'products', 'formules'));
    }

    public function indexPrestationProduct()
    {
        $products = Product::with('typePrestations')->get();

        // dd($products);
        $typeprestations = TblTypePrestation::where('etat', 'Actif')->get();
        return view('settings.prestationByProduct.index', compact('products', 'typeprestations'));
    }

    public function PrestationProductform($codeProduit)
    {
        $product = Product::where('CodeProduit', $codeProduit)->first();
        $typeprestations = TblTypePrestation::where('etat', 'Actif')->where('impact', '!=', 'Autre')->get();
        return view('settings.prestationByProduct.addPrestation', compact('codeProduit', 'typeprestations', 'product'));
    }
    public function PrestationProductStore(Request $request)
    {
        DB::beginTransaction();
        try {
            // Enregistrement des prestations pour le produit
            // Récupérer correctement les prestations en tableau
            $prestations = $request->input('prestations', []);

            foreach ($prestations as $prestationId) {
                $ProductPrestation = TblProductPrestation::where('product_id', $request->codeproduit)
                    ->where('prestation_id', $prestationId)
                    ->first();
                if ($ProductPrestation) {
                    $ProductPrestation->delete();
                }
                $saving = TblProductPrestation::create([
                    'product_id' => $request->codeproduit,
                    'product_type' => $request->product_type,
                    'prestation_id' => $prestationId,
                ]);
                if ($saving) {
                    $dataResponse = [
                        'type' => 'success',
                        'urlback' => route('setting.prestation_product.index'),
                        'message' => "Enregistré avec succes !",
                        'code' => 200,
                    ];
                    DB::commit();
                } else {
                    $dataResponse = [
                        'type' => 'error',
                        'urlback' => '',
                        'message' => "Erreur d'enregistrement !",
                        'code' => 500,
                    ];
                    DB::rollBack();
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur systeme! " . $th->getMessage(),
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }

    public function PrestationProductDestroy($id)
    {
        $saving = TblProductPrestation::where(['id' => $id])->delete();
        if ($saving) {
            $dataResponse = [
                'type' => 'success',
                'urlback' => "back",
                'message' => "Supprimé avec succes!",
                'code' => 200,
            ];
        } else {
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur lors de la suppression!",
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }

    public function getFormulesByProduct($codeProduit)
    {
        $formules = ProductFormule::where('CodeProduit', $codeProduit)->get();
        return response()->json($formules);
    }

    public function productByReseauStore(Request $request)
    {
        // \dd($request->all());

        DB::beginTransaction();
        try {

            $libelle = ProductFormule::select('MonLibelle')->where('CodeProduit', $request->codeproduit)->first();
            $equipe = ReseauProduct::create([
                'codereseau' => $request->codereseau,
                'codeproduit' => $request->codeproduit,
                'codeproduitformule' => $request->codeproduitformule,
                'libelleproduit' => $libelle->MonLibelle,
                'estactif' => "1",
            ])->save();

            DB::commit();

            if ($equipe) {
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Enregistré avec succes!",
                    'code' => 200,
                ];
                DB::commit();
            } else {
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur d'enregistrement !",
                    'code' => 500,
                ];
                DB::rollBack();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur systeme! " . $th->getMessage(),
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try {

            $saving = ReseauProduct::where(['id' => $id])->delete();

            if ($saving) {

                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Supprimé avec succes!",
                    'code' => 200,
                ];
                DB::commit();
            } else {
                DB::rollback();
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur lors de la suppression!",
                    'code' => 500,
                ];
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur systeme! $th",
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }

    public function NotifGroupIndex()
    {

        $usersList = User::with(['membre','groupNotif'])->whereHas('membre')->where('email', '!=', '')->paginate(10);


        // dd($users);
        $notifgroups = NotifGroup::where('etat','actif')->get();

        return view('settings.notifgroup.index', compact('usersList', 'notifgroups'));
       
    }

    public function editUserGroup(request $request, $id)
    {
        try{
            Log::info("ID de l'utilisateur : $id - Valeur: $request->group_uuid");
            $saving = User::where(['id'=>$id])->update([
                'group_uuid' => $request->group_uuid,
            ]);
            if ($saving) {
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Enregistré avec succes!",
                    'code' => 200,
                ];
            } else {
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur d'enregistrement !",
                    'code' => 500,
                ];
            }
        }catch(\Exception $e){  
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur systeme! " . $e->getMessage(),
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }
    public function addGroup(request $request)
    {
        try{
            $saving = NotifGroup::create([
                'code_group' => Refgenerate(NotifGroup::class, 'G', 'code'),
                'name' => $request->name,
                'branche' => $request->branche,
                'etat' => "actif",
            ]);
            if ($saving) {
                $dataResponse = [
                    'type' => 'success',
                    'urlback' => "back",
                    'message' => "Enregistré avec succes!",
                    'code' => 200,
                ];
            } else {
                $dataResponse = [
                    'type' => 'error',
                    'urlback' => '',
                    'message' => "Erreur d'enregistrement !",
                    'code' => 500,
                ];
            }
        }catch(\Exception $e){  
            $dataResponse = [
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur systeme! " . $e->getMessage(),
                'code' => 500,
            ];
        }
        return response()->json($dataResponse);
    }
}
