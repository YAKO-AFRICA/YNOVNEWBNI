<?php

namespace App\Http\Controllers\Admin;


use Dompdf\Dompdf;
use Dompdf\Options;

use App\Models\Contrat;

use BaconQrCode\Writer;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use BaconQrCode\Encoder\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd; // Alternative SVG
use BaconQrCode\Renderer\Image\ImagickImageBackEnd; // Utilisez Imagick si disponible

class BulletinController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function demoBulletin(request $request)
     {
        try {

            $contrat = Contrat::where('id', 89)->first();

            // Chargement de la vue avec les données
            $pdf = Pdf::loadView('productions.components.bullettin.ykeBulletin', [
                'contrat' => $contrat
            ]);

            // Option 1 : Retourner directement le PDF pour téléchargement
            return $pdf->stream('bulletin_adhesion.pdf');

        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    public function printBulletin()
    {
        // $prestation = TblPrestation::where('id', $id)->first();
        // Génération de QR Code en base64

        // $pdf = Pdf::loadView('productions.components.bullettin.ykeBulletin');
        // $pdf = Pdf::loadView('productions.components.bullettin.basicBulletin');
        // $pdf = Pdf::loadView('productions.components.bullettin.pfaINDbulletin');
        $pdf = Pdf::loadView('productions.components.bullettin.Cadencebulletintest');
        // $pdf = Pdf::loadView('productions.components.bullettin.Doihoobulletintest');
        // $pdf = Pdf::loadView('productions.components.bullettin.CadenceEduPlusbulletintest');

        $fileName = 'cadencebulletin.pdf';
        return $pdf->stream($fileName);
    }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contrat = Contrat::find($id);
        return view('productions.components.bullettin.basicBulletin', compact('contrat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function generate(Request $request, $id)
    // {
    //     DB::beginTransaction();
    //     try {
    //         $contrat = Contrat::find($id);
    //         if($contrat)
    //         {
    //             // Options pour Dompdf
    //             $options = new Options();
    //             $options->set('isRemoteEnabled', true);
            
    //             // Générer le bulletin PDF avec Dompdf
    //             if($contrat->codeproduit == "YKE_2018"){
    //                 $pdf = PDF::loadView('productions.components.bullettin.ykeBulletin', [
    //                     'contrat' => $contrat,
    //                 ]);
    //                 $cguFile = public_path('root/cgu/cg_yke.pdf');

    //             }else if($contrat->codeproduit == "PFA_IND"){
    //                 $pdf = PDF::loadView('productions.components.bullettin.pfaINDbulletin', [
    //                     'contrat' => $contrat,
    //                 ]);
    //                 $cguFile = public_path('root/cgu/cg_yke.pdf');

    //             }else{
    //                 $pdf = PDF::loadView('productions.components.bullettin.basicBulletin', [
    //                     'contrat' => $contrat,
    //                 ]);
    //                 $cguFile = public_path('root/cgu/CGPLanggnant.pdf');
    //             }
            
    //             // Répertoire pour enregistrer les fichiers temporaires
    //             $bulletinDir = public_path('documents/bulletin/');
    //             if (!is_dir($bulletinDir)) {
    //                 mkdir($bulletinDir, 0777, true);
    //             }
            
    //             $bulletinFileName = $bulletinDir . 'temp_bulletin_' . $contrat->id . '.pdf';
    //             $pdf->save($bulletinFileName);
            
    //             // Chemin vers le fichier CGU
    //             // $cguFile = public_path('root/cgu/CGPLanggnant.pdf');
                
            
    //             // Fusionner les PDF avec FPDI
    //             $finalPdf = new Fpdi();
            
    //             // Ajouter les pages du bulletin
    //             $finalPdf->AddPage();
    //             $finalPdf->setSourceFile($bulletinFileName);
    //             $tplIdx = $finalPdf->importPage(1);
    //             $finalPdf->useTemplate($tplIdx);
            
    //             // Ajouter toutes les pages du fichier CGU
    //             $pageCount = $finalPdf->setSourceFile($cguFile);
    //             for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
    //                 $finalPdf->AddPage();
    //                 $tplIdx = $finalPdf->importPage($pageNo);
    //                 $finalPdf->useTemplate($tplIdx);
    //             }
            
    //             // Nom final du fichier
    //             $finalFileName = $bulletinDir . 'assurcompte_' . $contrat->id . '.pdf';
            
    //             // Enregistrer le PDF final
    //             $finalPdf->Output($finalFileName, 'F');
            
    //             // Supprimer le fichier temporaire du bulletin
    //             unlink($bulletinFileName);

    //             DB::commit();
            
    //             // Retourner le PDF final en tant que réponse
    //             return response()->file($finalFileName, [
    //                 'Content-Type' => 'application/pdf',
    //                 'Content-Disposition' => 'inline; filename="' . basename($finalFileName) . '"'
    //             ]);

                
    //         }else{
    //             DB::rollBack();
    //             return response()->json([
    //                 'type' => 'error',
    //                 'urlback' => '',
    //                 'message' => "Erreur lors de la generation du bullettin!",
    //                 'code' => 500,
    //             ]);
    //         }
            
    
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         return response()->json([
    //             'type' => 'error',
    //             'urlback' => '',
    //             'message' => "Erreur système! $th",
    //             'code' => 500,
    //         ]);
    //     }

    // }

    public function generate(Request $request, $id)
{
    DB::beginTransaction();
    try {
        $contrat = Contrat::find($id);

        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );

        // $qrContent = "Signature Electronique\n";
        // $qrContent .= "Date: " . $contrat->saisiele . "\n";
        // $qrContent .= "Réf. Contrat: " . $contrat->id;

        $qrContent = url("production/showQrCode/" . $contrat->id);
        
        $writer = new Writer($renderer);
    
        $qrCodeImage = $writer->writeString($qrContent);
        $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($qrCodeImage);


        $imageUrl = env('SIGN_API') . "api/get-signature/" . $id . "/E-SOUSCRIPTION";
        $imageSrc = null;
         try {
            $response = Http::timeout(5)->get($imageUrl);

            if ($response->successful()) {
                $data = $response->json();

                // Vérifie si 'error' existe et est à true
                if (isset($data['error']) && $data['error'] === true) {
                    Log::info('Signature non trouvée pour le contrat ID: ' . $contrat->id);
                } else {
                
                    $imageData = $response->body(); 
                    $base64Image = base64_encode($imageData);
                    $imageSrc = 'data:image/png;base64,' . $base64Image;
                }
            } else {
                Log::error('Erreur HTTP lors de l\'appel de l\'API signature. Code de retour : ' , $response->json());
            }
        } catch (\Exception $e) {
            Log::error('Exception lors de la récupération de la signature : ' . $e->getMessage());
        }

        


        if($contrat)
        {
            // Options pour Dompdf
            $options = new Options();
            $options->set('isRemoteEnabled', true);
        
            // Générer le bulletin PDF avec Dompdf
            if($contrat->codeproduit == "YKE_2018"){
                $pdf = PDF::loadView('productions.components.bullettin.ykeBulletin', [
                    'contrat' => $contrat,
                    'qrCodeBase64' => $qrCodeBase64,
                    'imageSrc' => $imageSrc
                ]);
                $cguFile = public_path('root/cgu/cg_yke.pdf');

            }else if($contrat->codeproduit == "CADENCE")
            {
                $pdf = PDF::loadView('productions.components.bullettin.Cadencebulletin', [
                    'contrat' => $contrat,
                    'qrCodeBase64' => $qrCodeBase64,
                    'imageSrc' => $imageSrc
                ]);
                $cguFile = public_path('root/cgu/cadenceCgu.pdf');
                
            }else if($contrat->codeproduit == "PFA_IND"){
                $pdf = PDF::loadView('productions.components.bullettin.pfaINDbulletin', [
                    'contrat' => $contrat,
                    'qrCodeBase64' => $qrCodeBase64,
                    'imageSrc' => $imageSrc
                ]);
                $cguFile = public_path('root/cgu/cg_yke.pdf');
            }else if($contrat->codeproduit == "DOIHOO"){
                $pdf = PDF::loadView('productions.components.bullettin.Doihoobulletin', [
                    'contrat' => $contrat,
                    'qrCodeBase64' => $qrCodeBase64,
                     'imageSrc' => $imageSrc
                ]);
                $cguFile = public_path('root/cgu/doihoo_cgu.pdf');
            }else if($contrat->codeproduit == "CAD_EDUCPLUS"){
                $pdf = PDF::loadView('productions.components.bullettin.CadenceEduPlusbulletin', [
                    'contrat' => $contrat,
                    'qrCodeBase64' => $qrCodeBase64,
                    'imageSrc' => $imageSrc,
                ]);
                $cguFile = public_path('root/cgu/CADENCEpLUS.pdf');
                
            }else{

                $pdf = PDF::loadView('productions.components.bullettin.basicBulletin', [
                    'contrat' => $contrat,
                    'qrCodeBase64' => $qrCodeBase64,
                     'imageSrc' => $imageSrc
                ]);
                $cguFile = public_path('root/cgu/CGPLanggnant.pdf');
            }
        
            // Répertoire pour enregistrer les fichiers temporaires
            $bulletinDir = public_path('documents/bulletin/');
            if (!is_dir($bulletinDir)) {
                mkdir($bulletinDir, 0777, true);
            }
        
            $bulletinFileName = $bulletinDir . 'temp_bulletin_' . $contrat->id . '.pdf';
            $pdf->save($bulletinFileName);
        
            // Fusionner les PDF avec FPDI
            $finalPdf = new Fpdi();
        
            // Ajouter toutes les pages du bulletin
            $bulletinPageCount = $finalPdf->setSourceFile($bulletinFileName);
            for ($pageNo = 1; $pageNo <= $bulletinPageCount; $pageNo++) {
                $finalPdf->AddPage();
                $tplIdx = $finalPdf->importPage($pageNo);
                $finalPdf->useTemplate($tplIdx);
            }
        
            // Ajouter toutes les pages du fichier CGU
            $cguPageCount = $finalPdf->setSourceFile($cguFile);
            for ($pageNo = 1; $pageNo <= $cguPageCount; $pageNo++) {
                $finalPdf->AddPage();
                $tplIdx = $finalPdf->importPage($pageNo);
                $finalPdf->useTemplate($tplIdx);
            }
        
            // Nom final du fichier
            $finalFileName = $bulletinDir . 'assurcompte_' . $contrat->id . '.pdf';
        
            // Enregistrer le PDF final
            $finalPdf->Output($finalFileName, 'F');
        
            // Supprimer le fichier temporaire du bulletin
            unlink($bulletinFileName);

            DB::commit();
        
            // Retourner le PDF final en tant que réponse
            return response()->file($finalFileName, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="' . basename($finalFileName) . '"'
            ]);
        } else {
            DB::rollBack();
            return response()->json([
                'type' => 'error',
                'urlback' => '',
                'message' => "Erreur lors de la generation du bullettin!",
                'code' => 500,
            ]);
        }
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
        //
    }
}
