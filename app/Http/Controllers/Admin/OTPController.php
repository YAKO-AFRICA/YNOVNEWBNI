<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tblotp;
use App\Services\SMSService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class OTPController extends Controller
{
    protected $SMSService;

    public function __construct(SMSService $SMSService)
    {
        $this->SMSService = $SMSService;
    }

    public function sendOtpByInfobipAPI(Request $request)
    {
        $TelOtp = $request->TelOtp;
        $TelPaiement = $request->TelPaiement;

        $phoneNumber = ($TelPaiement == null || $TelPaiement == '') ? $TelOtp : $TelPaiement;
        $otp = RefgenerateOTP(Tblotp::class, 'codeOTP');

        // Stockez l'OTP temporairement (par exemple, dans le cache)
        Cache::put("otp_{$phoneNumber}", $otp, now()->addMinutes(5));

        $response = $this->SMSService->sendOtpByInfobipAPI($phoneNumber, $otp);

        // Vérifier si une erreur s'est produite
        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']], 500);
        }else{
            
            return response()->json(['message' => 'OTP envoyé avec succès.']);
        }
    }
    public function sendOtpByOrangeAPI(Request $request)
    {
        $TelOtp = $request->TelOtp;
        $TelPaiement = $request->TelPaiement;

        $phoneNumber = ($TelPaiement == null || $TelPaiement == '') ? $TelOtp : $TelPaiement;
        $otp = RefgenerateOTP(Tblotp::class, 'codeOTP');

        // Stockez l'OTP temporairement (par exemple, dans le cache)
        Cache::put("otp_{$phoneNumber}", $otp, now()->addMinutes(5));

        $response = $this->SMSService->sendOtpByOrangeAPI($phoneNumber, $otp);

        // Vérifier si une erreur s'est produite
        if (isset($response['error'])) {
            return response()->json(['error' => $response['error']], 500);
        }else{
            
            return response()->json(['message' => 'OTP envoyé avec succès.']);
        }
    }
    public function verifyOtp(Request $request)
    {
        // $phoneNumber = $request->TelPaiement;
        $TelOtp = $request->TelOtp;
        $TelPaiement = $request->TelPaiement;

        $phoneNumber = ($TelPaiement == null || $TelPaiement == '') ? $TelOtp : $TelPaiement;
        $otp = $request->otp;
    
        // Récupérer l'OTP du cache
        $cachedOtp = Cache::get("otp_{$phoneNumber}");
    
        if ($cachedOtp && $cachedOtp == $otp) {
            try {
                // Démarrer une transaction
                DB::beginTransaction();
    
                // Mettre à jour le statut de l'OTP
                // $otpRecord = Tblotp::where('codeOTP', $otp)->first();
                // if ($otpRecord) {
                //     $otpRecord->used = 1;
                //     $otpRecord->save();
                // }
                DB::beginTransaction();
                try {
                    // Création de la prestation
                    Tblotp::create([
                        'codeOTP' => $otp,
                        'used' => 1,
                        'operation_type' => 'Demande de prestation',
                        'contact_method' => 'SMS',
                        'contact' => $phoneNumber,
                    ])->save();
    
                    // Valider la transaction
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollback();
                    return response()->json(['error' => $th->getMessage()], 500);
                }
    
                // Supprimer l'OTP du cache
                Cache::forget("otp_{$phoneNumber}");
    
                return response()->json(['message' => 'Votre numéro de téléphone a été vérifié avec succès.']);
            } catch (\Exception $e) {
                // Annuler la transaction en cas d'erreur
                DB::rollBack();
                return response()->json(['error' => 'Une erreur est survenue lors de la vérification.'], 500);
            }
        }
    
        return response()->json(['error' => 'OTP invalide ou expiré.'], 400);
    }
}
