<?php

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AdherentProspert;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OTPController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\PaiementController;
use App\Http\Controllers\Setting\SiteWebController;
use App\Http\Controllers\Admin\PrestationController;
use App\Http\Controllers\Sites\SitePropositionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::post('/login', [PlatformController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->group(function () {
    
// });

Route::post('/rechercher-prospert', function (Request $request) {
    $prospert = AdherentProspert::where('code', $request->codeProspert)->first();

    Log::info($prospert);

    if (!$prospert) {
        return response()->json(['message' => 'Prospert non trouvé'], 404);
    }

    return response()->json(
        [
        'success' => true,
        'message' => 'Prospert trouvé',
        'prospert' => $prospert
        ]);
});


Route::post('/fetch-contract-details', [PrestationController::class, 'fetchContractDetails']);

Route::post('/getPrestations', [PrestationController::class, 'getPrestations'])->name('getPrestations');
Route::post('/send-otpByOrangeAPI', [OTPController::class, 'sendOtpByOrangeAPI']);
Route::post('/send-otpByInfobipAPI', [OTPController::class, 'sendOtpByInfobipAPI']);
Route::post('/verify-otp', [OTPController::class, 'verifyOtp']);


Route::get('/sitewebs/list', [SiteWebController::class, 'index'])->name('sitewebs.list');
Route::get('/sitewebs/update', [SiteWebController::class, 'update'])->name('sitewebs.update');
Route::apiResource('sitewebs', SiteWebController::class);
    
    // Route supplémentaire pour changer l'état
Route::patch('sitewebs/{siteWeb}/toggle-status', [SiteWebController::class, 'toggleStatus']);


// Liste tous les sites web
Route::get('/sitewebs/list', [SiteWebController::class, 'index'])->name('sitewebs.list');

// Enregistre un nouveau site web
Route::post('/sitewebs', [SiteWebController::class, 'store'])->name('sitewebs.store');

// Affiche un site web spécifique
Route::get('/sitewebs/{siteweb}', [SiteWebController::class, 'show'])->name('sitewebs.show');

// Met à jour un site web spécifique
Route::put('/sitewebs/update/{id}', [SiteWebController::class, 'update'])->name('sitewebs.update');
// Route::patch('/sitewebs/{siteweb}', [SiteWebController::class, 'update']);

// Supprime un site web spécifique
Route::delete('/sitewebs/delete/{id}', [SiteWebController::class, 'destroy'])->name('sitewebs.destroy');

// Route supplémentaire pour changer l'état
Route::patch('/sitewebs/{siteweb}/toggle-status', [SiteWebController::class, 'toggleStatus'])->name('sitewebs.toggle-status');


// avoir tout les user collaborateurs de yako africa
Route::get('/collaborateurs/users', function(Request $request) {

    $requiredToken = "azertyuiopqsddfghjklmwxcvbn";
    
    $providedToken = $request->header('Authorization');
    
    if (!$providedToken || $providedToken !== $requiredToken) {
        return response()->json([
            'success' => false,
            'message' => 'Accès non autorisé. Token requis.'
        ], 401);
    }

    try {
        $users = User::where('codepartenaire', 'LLV')->orderby('created_at', 'desc')->get();

        return response()->json([
            'users' => $users,
            'success' => true,
            'message' => 'liste des collaborateurs'
        ]);

    } catch(\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
});


Route::post('/save-site-simulateur-data', [SitePropositionController::class, 'saveSiteSimulateurData']);








