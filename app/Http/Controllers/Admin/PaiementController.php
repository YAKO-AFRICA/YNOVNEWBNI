<?php

namespace App\Http\Controllers\Admin;

use App\Models\Facture;
use App\Models\Paiement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class PaiementController extends Controller
{
    public function cretePaiement(request $request)
    {

        Log::info($request->all());
        $data = $request->all();

        // Log::info($data['order_number']);
        try{

            DB::beginTransaction();

            $paiement = Paiement::create([
                'codePaiement' => $data['order_number'],
                'montant' => $data['amount'],
                'telpaiement' => $data['clientPhone'],
                'etat' => 2,
                'datepaiement' => now(),
                'typePaiement' => 1,
                // 'idproposition' => $data['idContrat'],
                'referenceSource' => $data['idContrat'],
            ]);

            Log::info($paiement);

            $facture = Facture::create([
                // 'idProposition' => $data['idproposition'],
                'codePaiement' => $data['order_number'],
                'prime' => $data['amount'],
                'etat' => 2,
                'dateAjout' => now(),
                'typePaiement' => 1,
                'referenceSource' => $data['idContrat'],
                'idcontrat' => $data['idContrat'],
                'saisiele' => now(),
                
            ]);

            Log::info($facture);

            DB::commit();

            return response()->json(['success' => true, 'message' => 'Paiement créé avec succès']);

        } catch(\Exception $e) {
            DB::rollback();
            Log::error("Erreur lors de la création du paiement: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Erreur lors de la création du paiement']);
        }

        
    }


}


