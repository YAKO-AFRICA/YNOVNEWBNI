<?php

namespace App\Http\Controllers\setting;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {

        $roles = Role::all();
        return view('settings.roles.index', compact('roles'));
    }
    public function permission($id)
    {

        $permissions = Permission::all();
        $groups = Group::all();
        $role = Role::find($id);
        return view('settings.roles.permission', compact('permissions', 'groups', 'role'));
    }

    public function permissionStore(Request $request)
    {
        DB::beginTransaction();
            try {
           $validate = Permission::create([
                'name' => $request->name,
                'group' => $request->group,
                'guard_name' => 'web',
            ])->save();

            if ($validate) {

                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Enregistré avec succes!",
                    'code'=>200,
                ];
                DB::commit();
        } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de l'enregistrement!",
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

    public function rolePermissionSave(request $request, $id)
    {

        DB::beginTransaction();
        try {
            // $permis->removeRole($role);

            $role = Role::find($id);
            $permis_all = Permission::all();
            $role->revokePermissionTo($permis_all);
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->givePermissionTo($permissions);


            Log::info($request->permissions);
            Log::info($permis_all);


        if ($role) {

            $dataResponse =[
                'type'=>'success',
                'urlback'=>"back",
                'message'=>"Enregistré avec succes!",
                'code'=>200,
            ];
            DB::commit();
        } else {
            DB::rollback();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur lors de l'enregistrement!",
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

    public function groupStore(Request $request)
    {
        DB::beginTransaction();
            try {
                $validate = Group::create([
                    'name' => $request->name,
                ])->save();

            if ($validate) {

                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Enregistré avec succes!",
                    'code'=>200,
                ];
                DB::commit();
        } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de l'enregistrement!",
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


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        DB::beginTransaction();
        try {
            $roles = Role::create([
                'name' => $request->name,
            ])->save();

        if ($roles) {

            $dataResponse =[
                'type'=>'success',
                'urlback'=>"back",
                'message'=>"Enregistré avec succes!",
                'code'=>200,
            ];
            DB::commit();
    } else {
            DB::rollback();
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur lors de l'enregistrement!",
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

    public function update(Request $request, string $id)
    {
        {
            $request->validate([
                'name' => 'required|unique:roles,name'
            ]);

            DB::beginTransaction();
            try {
                $roles = Role::whereId($id)->update(['name' => $request->name,]);
            if ($roles) {

                $dataResponse =[
                    'type'=>'success',
                    'urlback'=>"back",
                    'message'=>"Enregistré avec succes!",
                    'code'=>200,
                ];
                DB::commit();
        } else {
                DB::rollback();
                $dataResponse =[
                    'type'=>'error',
                    'urlback'=>'',
                    'message'=>"Erreur lors de l'enregistrement!",
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $roles = Role::whereId($id)->delete();
        if ($roles) {
            $dataResponse =[
                'type'=>'success',
                'urlback'=>"back",
                'message'=>"Supprimé avec succes!",
                'code'=>200,
            ];
        } else {
            $dataResponse =[
                'type'=>'error',
                'urlback'=>'',
                'message'=>"Erreur lors de la suppression!",
                'code'=>500,
            ];
        }
        return response()->json($dataResponse);
    }
}
