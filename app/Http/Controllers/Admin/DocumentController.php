<?php

namespace App\Http\Controllers\Admin;

use App\Models\TblDocument;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
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
        try {
            DB::beginTransaction();
            
            $idContrat = $request->contrat;
            $libelles = $request->input('libelles');
            $files = $request->file('files');
            
            if($files != null) {
                foreach ($files as $key => $file) {
                    $imageName = $idContrat . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();

                    // $destinationPath = public_path('documents/files');
                    $destinationPath = base_path(env('UPLOADS_PATH'));

                    $file->move($destinationPath, $imageName);
                    $filePath = '../public_html/testenovapi/public/uploads/' . $imageName;

                    // \dd($libelles[$key]);

                    TblDocument::create([
                        'codecontrat' => $idContrat,
                        'filename' => $imageName,
                        'libelle' => $libelles[$key],
                        'saisiele' => now(),
                        'saisiepar' => Auth::user()->membre->idmembre,
                        'source' => "ES",
                    ]);
                }
            }

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
                'urlback' => 'back',
                'message' => "Erreur système! $th",
                'code' => 500,
            ]);
        }
    }
    public function storeDocPret(Request $request)
    {
        try {
        DB::beginTransaction();
        $idPret = $request->pret;
        $libelles = $request->input('libelles');
        $files = $request->file('files');
         
        foreach ($files as $key => $file) {
            $imageName = $idPret . '-' . now()->timestamp . '.' . $file->getClientOriginalExtension();

            // $destinationPath = public_path('documents/files');
            $destinationPath = base_path(env('UPLOADS_PATH'));
            $file->move($destinationPath, $imageName);
            $filePath = '../public_html/testenovapi/public/uploads/' . $imageName;

            // \dd($libelles[$key]);

            TblDocument::create([
                'codecontrat' => $idPret,
                'filename' => $imageName,
                'libelle' => $libelles[$key],
                'saisiele' => now(),
                'saisiepar' => Auth::user()->membre->idmembre,
                'source' => "ES",
            ]);
        }

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
                'urlback' => 'back',
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        DB::beginTransaction();

        TblDocument::find($id)->delete();

        DB::commit();
    
        return response()->json([
            'type' => 'success',
            'urlback' => 'back',
            'message' => "Supprimé avec succès!",
            'code' => 200,
        ]);
    } catch (\Throwable $th) {
        DB::rollBack();
        return response()->json([
            'type' => 'error',
            'urlback' => 'back',
            'message' => "Erreur système! $th",
            'code' => 500,
        ]);
    }
    }
}
