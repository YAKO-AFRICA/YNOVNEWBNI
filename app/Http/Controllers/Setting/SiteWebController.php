<?php

namespace App\Http\Controllers\Setting;

use App\Models\SiteWeb;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class SiteWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sites = SiteWeb::all();
        return response()->json($sites);
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string',
            'url' => 'required|url',
            'description' => 'nullable|string',
            'username' => 'nullable|string',
            'password' => 'nullable|string',
            'etat' => 'nullable|string|in:actif,inactif'
        ]);

        $site = SiteWeb::create($validated);
        return response()->json($site, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SiteWeb $siteWeb)
    {
        return response()->json($siteWeb);
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
    public function update(Request $request, SiteWeb $id)
    {

        $idFinal = $id->id;

        $siteWeb = SiteWeb::where('id', $idFinal)->update([
            'name' => $request->name,
            'icon' => $request->icon,
            'url' => $request->url,
            'description' => $request->description,
            'username' => $request->username,
            'password' => $request->password,
            'etat' => $request->etat,
        ]);

        return response()->json($siteWeb);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        Log::info("Suppression du site web" . $id);

        $siteWeb = SiteWeb::find($id);
        $siteWeb->delete();
        return response()->json(null, 204);
    }

    /**
     * Toggle the status of the site
     */
    public function toggleStatus(SiteWeb $siteWeb)
    {
        $siteWeb->update([
            'etat' => $siteWeb->etat === 'actif' ? 'inactif' : 'actif'
        ]);
        
        return response()->json(['message' => 'Statut modifié', 'new_status' => $siteWeb->etat]);
    }
}
