<?php

namespace App\Http\Controllers\Admin;

use App\Models\Membre;
use App\Models\Contrat;
use App\Models\Adherent;
use App\Models\Cotation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CotationController extends Controller
{
    public function index()
    {

        $cotations = Cotation::where('etat', 'actif')->get();
        
        return view('cotations.index', compact('cotations'));
    }

    public function store(Request $request, $uuid)
    {

        try{
            $cotation = Cotation::where('uuid', $uuid)->first();
            $idAdherent = Adherent::max('id') + 1;
            $idContrat = Contrat::max('id') + 1;

            $conseiller = Membre::where('idmembre', $cotation->autheur)->first();

            $adherent = Adherent::create([
                'id' => $idAdherent,
                'nom' => $cotation->nomCompletSouscripteur,
                'prenom' => $cotation->nomCompletSouscripteur,
                'mobile1' => $cotation->telephoneSouscripteur,
                
            ])->save;

            $contrat = Contrat::create([
                'id' => $idContrat,
                'codeConseiller' => $conseiller->codeagent,
                'nomagent' => $conseiller->nom . ' ' . $conseiller->prenom,
                'codeadherent' => $idAdherent,
                'codeproduit' => 'loyemp',
                'libelleproduit' => 'loyale emprunteur DIFIN',
            ])->save;

            return response()->json(
                [
                    'type' => 'success',
                    'urlback' => \route('cotation.create',$idContrat),
                    'message' => 'Cotation traitée avec succès'
                ]
            );

        }catch(Exception $e){
            return response()->json(
                [
                    'type' => 'error',
                    'message' => 'Une erreur est survenue lors du traitement de la cotation',
                    'error' => $e->getMessage(),
                ]
            );
        }   

    }

    public function create($id)
    {

        $contrat = Contrat::where('id', $id)->first();
        
        return view('cotations.create' , compact('contrat'));
    }
}
