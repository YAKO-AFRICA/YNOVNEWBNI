<?php

use Carbon\Carbon;
use App\Models\FileManager;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use BaconQrCode\Encoder\QrCode;
use App\Models\AdherentProspert;
use App\Models\TblTypePrestation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\Admin\RdvController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\Admin\EpretController;
use App\Http\Controllers\Setting\RoleController;
use App\Http\Controllers\Setting\UserController;
use App\Http\Controllers\Setting\ZoneController;
use App\Http\Controllers\Admin\AssurerController;
use App\Http\Controllers\Admin\RapportController;
use App\Http\Controllers\Setting\MotifController;
use App\Http\Controllers\Admin\AdherentController;
use App\Http\Controllers\Admin\BulletinController;
use App\Http\Controllers\Admin\CotationController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\PaiementController;
use App\Http\Controllers\Admin\ProspectController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Setting\EquipCcontroller;
use App\Http\Controllers\Setting\EquipeController;
use App\Http\Controllers\Setting\PartnerController;
use App\Http\Controllers\Setting\ReseauxController;
use App\Http\Controllers\Admin\FileManageController;
use App\Http\Controllers\Admin\PrestationController;
use App\Http\Controllers\Admin\ProductionController;
use App\Http\Controllers\Admin\ValidationController;
use App\Http\Controllers\Admin\BeneficiairesController;
use App\Http\Controllers\Sites\SitePropositionController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

Auth::routes();


Route::middleware('guest','PreventBackHistory')->group(function(){

    Route::get('/', function () {
        return view('auth.login');
    });

});


Route::prefix('shared')->name('shared.')->group(function(){
    Route::middleware('guest')->group(function(){
    });

    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        Route::post('/update/assuree/{id}', [AssurerController::class, 'updateAssur'])->name('assuree.update');

    });
});
Route::prefix('file')->name('file.')->group(function(){
    Route::middleware('guest')->group(function(){
    });

    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('/manager', [FileManageController::class, 'index'])->name('manager');
        Route::post('/store/folder', [FileManageController::class, 'storeFolder'])->name('storeFolder');
        Route::post('/store/files', [FileManageController::class, 'storeFile'])->name('storeFile');
        Route::get('/file-manager/files/{folder_id}', [FileManageController::class, 'getFilesByFolder']);

       

    });
});




Route::prefix('tickets')->name('ticket.')->group(function(){
    Route::middleware('guest')->group(function(){

        
    });

    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('tickets/index', [TicketController::class, 'index'])->name('tickets.index');
        Route::post('tickets/store', [TicketController::class, 'store'])->name('ticket.store');

        Route::get('tickets/show/{ticket}', [TicketController::class, 'show'])->name('ticket.show');
        Route::get('attachments/{attachment}/download', [AttachmentController::class,'download'])->name('attachments.download');
        Route::get('attachments/{attachment}/destroy', [AttachmentController::class,'destroy'])->name('attachments.destroy');

        Route::post('/{ticket}/messages',[MessageController::class, 'store'])->name('messages.store');


        // Route::get('tickets', [TicketController::class, 'index'])->name('tickets.index');
        // Route::post('tickets/{ticket}/messages',[MessageController::class, 'store'])->name('messages.store');
        // Route::post('tickets/{ticket}/close', [TicketController::class, 'close'])->name('tickets.close');
        // Route::post('tickets/{ticket}/reopen', [TicketController::class, 'reopen'])->name('tickets.reopen');
        // Route::get('attachments/{attachment}/download', [TicketController::class,'download'])->name('attachments.download');

    });

});

Route::prefix('production')->name('prod.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){
        Route::get('/showQrCode/{id}', [ProductionController::class, 'showQrCode'])->name('showQrCode');
    });
    Route::middleware(['auth'])->group(function () {
        Route::get('/index', [ProductionController::class, 'index'])->name('index');
        Route::get('/show/{id}', [ProductionController::class, 'show'])->name('show');
        Route::post('/transmettreContrat/{id}', [ProductionController::class, 'transmettreContrat'])->name('transmettreContrat');
        Route::get('/edit/{id}', [ProductionController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProductionController::class, 'update'])->name('contrat.update');
        Route::post('/destroy/{id}', [ProductionController::class, 'destroy'])->name('destroy');
        Route::get('/create/stepProduct', [ProductionController::class, 'stepProduct'])->name('stepProduct');
        Route::post('search-adherent', [ProductionController::class, 'searchAdherant'])->name('search.adherent');
        Route::get('/create/add/{codeproduit}', [ProductionController::class, 'create'])->name('create');
        Route::get('/createYke/add/{codeproduit}', [ProductionController::class, 'createYke'])->name('createYke');
        Route::get('/createKds/add/{codeproduit}', [ProductionController::class, 'createKds'])->name('createKds');
        Route::get('/createdoihoo/add/{codeproduit}', [ProductionController::class, 'createdoihoo'])->name('createdoihoo');
        Route::get('/createCAD/add/{codeproduit}', [ProductionController::class, 'createCAD'])->name('createCAD');
        Route::post('/store', [ProductionController::class, 'store'])->name('store');
        Route::get('/gestionEquip/index', [ProductionController::class, 'gestionEquip'])->name('gestionEquip');
        Route::post('/upload-documents', [ProductionController::class, 'upload'])->name('upload.documents');

        Route::get('production/assureadd/get', [ProductionController::class, 'addassurgetForm'])->name('production.get.assureadd');
        Route::post('/add-assure-session', [ProductionController::class, 'addAssureToSession'])->name('addAssureToSession');
        Route::get('/get-assures-session', [ProductionController::class, 'getAssuresFromSession'])->name('getAssuresFromSession');


        Route::post('/update/adherent/{id}', [AdherentController::class, 'update'])->name('adherent.update');

        Route::post('/store/assure', [AssurerController::class, 'store'])->name('store.assurer');
        Route::post('/assures/update/{id}', [AssurerController::class, 'update'])->name('assures.update');
        Route::post('/deleteassure/{id}', [AssurerController::class, 'deleteAssure'])->name('delete.assure');

        Route::post('/store/benef', [BeneficiairesController::class, 'store'])->name('store.beneficiaires');
        Route::post('/update/benef/{id}', [BeneficiairesController::class, 'update'])->name('update.beneficiaires');
        
        Route::post('/beneficiaires/addBenefType{id}', [BeneficiairesController::class, 'addBenefType'])->name('addBenefType');

        Route::post('/update/benefire/{id}', [BeneficiairesController::class, 'updateBeneficiaire'])->name('benef.update');
        Route::post('/update/benefDeces/{id}', [BeneficiairesController::class, 'updateBenefDeces'])->name('benef.deces.update');

        Route::post('/delete/beneficiaire/{id}', [BeneficiairesController::class, 'destroy'])->name('delete.beneficiaire');
        
        Route::post('/store/document', [DocumentController::class, 'store'])->name('store.document');
        Route::post('/store/document/pret', [DocumentController::class, 'storeDocPret'])->name('storeDocPret');
        Route::post('/destroy/document/{id}', [DocumentController::class, 'destroy'])->name('destroy.document');


        // bulletin

        Route::get('/show/bullettin/{id}', [BulletinController::class, 'show'])->name('bullettin.show');
        Route::get('/generate-bulletin/{id}', [BulletinController::class, 'generate'])->name('generate.bulletin');

        // Validation route

        Route::get('/validation/index', [ValidationController::class, 'index'])->name('validation.index');
        Route::get('/traitement/prodByPartner/{code}', [ValidationController::class, 'prodByPartner'])->name('validation.prodByPartner');
        Route::get('/traitement/proposition/show/{id}', [ValidationController::class, 'show'])->name('validation.show');
        Route::post('/traitement/proposition/rejet/{id}', [ValidationController::class, 'rejetContrat'])->name('traitement.proposition.rejet');
        Route::get('/proposition/edit{id}', [ValidationController::class, 'edit'])->name('proposition.edit');
        Route::post('/traitement/proposition/valider/{id}', [ValidationController::class, 'acceptContrat'])->name('traitement.proposition.valider');

        


        


    });
});

Route::post('/contacts/session', [AdherentController::class, 'storeSession'])->name('contacts.session.store');


Route::get('/notifications/mark-as-read/{id}',[MailController::class,'markAsRead'])->name('notif.markToRead');


Route::get('/formules/{codeProduit}', [SettingsController::class, 'getFormulesByProduct']);


Route::prefix('report')->name('report.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){

    });
    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('eSouscription',[RapportController::class, 'eSouscription'])->name('eSouscription');
        Route::get('ePrestation',[RapportController::class, 'ePrestation'])->name('ePrestation');
        Route::get('ePret',[RapportController::class, 'ePret'])->name('ePret');
        Route::get('eValidation',[RapportController::class, 'eValidation'])->name('eValidation');
        Route::get('eProspection',[RapportController::class, 'eProspection'])->name('eProspection');
    });

});


Route::get('prestation/getInfoPrestation/{id}', [PrestationController::class, 'getInfoPrestation'])->name('getInfoPrestation');
Route::prefix('prestation')->name('prestation.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){

    });
    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        // customer prestation routes
        Route::get('/index',[PrestationController::class, 'index'])->name('index');
        Route::post('/fetch-Customer-details', [PrestationController::class, 'fetchCustomerDetails'])->name('fetchCustomerDetails');
        Route::get('/selectPrestation',[PrestationController::class, 'selectPrestation'])->name('selectPrestation');
        Route::get('/mesPrestations', [PrestationController::class, 'mesPrestations'])->name('mesPrestations');
        Route::get('/print-fiche-prestation', [PrestationController::class, 'printFichePrestation'])->name('printFichePrestation');
        
        // Route::post('prestation/getPrestations', [DemandePrestationController::class, 'getPrestations'])->name('getPrestations');
        // Route::get('prestation/mesPrestations', [PrestationController::class, 'mesPrestations'])->name('mesPrestations');
        Route::get('/create/{id}',[PrestationController::class, 'create'])->name('create');
        Route::get('/autre/{id}',[PrestationController::class, 'createAutre'])->name('autre');
        Route::post('/autre/add',[PrestationController::class, 'storePrestAutre'])->name('storePrestAutre');
        Route::get('show/{code}',[PrestationController::class, 'show'])->name('show');
        Route::post('/add',[PrestationController::class, 'store'])->name('store');
        Route::get('/edit/{code}',[PrestationController::class, 'edit'])->name('edit');
        Route::get('/modifier-apres-rejet/{code}',[PrestationController::class, 'editAfterRejet'])->name('editAfterRejet');
        Route::post('/transmettrePrest/{code}',[PrestationController::class, 'transmettrePrest'])->name('transmettrePrest');
        Route::post('/update/{code}',[PrestationController::class, 'update'])->name('update');
        Route::post('/destroy/{code}',[PrestationController::class, 'destroy'])->name('destroy');
        Route::post('/addDocPrest',[PrestationController::class, 'addDocPrest'])->name('add.docPrest');
        Route::post('/destroyDoc/{id}',[PrestationController::class, 'destroyDoc'])->name('destroyDoc');
        
    });

});


Route::prefix('rdv')->name('rdv.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){

    });
    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('index',[RdvController::class, 'index'])->name('index');
        Route::get('/create/{id}',[RdvController::class, 'create'])->name('create');
        Route::get('/optionDate/{id}', [RdvController::class, 'getOptionRdv'])->name('optionDate');
        // Route::get('rdv/getRdvDate/{id}/{dateRdv}',[RdvController::class, 'getOptionRdv'])->name('rdv.optionDate');
        // Route::get('rdv/getRdvDate/{id}/{dateRdv}',[RdvController::class, 'getOptionRdv'])->name('rdv.optionDate');
        Route::get('/getRdv', [RdvController::class, 'getRdvByDate'])->name('getRdv');
        Route::post('/add',[RdvController::class, 'store'])->name('store');
    });

});



Route::prefix('settings')->name('setting.')->group(function(){

    Route::middleware('guest','PreventBackHistory')->group(function(){

    });

    
    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('/index-reseaux', [ReseauxController::class, 'index'])->name('reseau.index');
        Route::post('/store-reseaux', [ReseauxController::class, 'store'])->name('reseau.store');
        Route::post('/update-reseaux/{id}', [ReseauxController::class, 'update'])->name('reseau.update');
        Route::post('/destroy-reseaux/{id}', [ReseauxController::class, 'destroy'])->name('destroy.reseau');

        // Zone 
        Route::get('/index-zones', [ZoneController::class, 'index'])->name('zone.index');
        Route::post('/store-zones', [ZoneController::class, 'store'])->name('zone.store');
        Route::post('/update-zones/{id}', [ZoneController::class, 'update'])->name('zone.update');
        Route::post('/destroy-zones/{id}', [ZoneController::class, 'destroy'])->name('destroy.zone');

        // equipe 
        Route::get('/index-equipe', [EquipeController::class, 'index'])->name('equipe.index');
        Route::post('/store-equipe', [EquipeController::class, 'store'])->name('equipe.store');
        Route::post('/update-equipe/{id}', [EquipeController::class, 'update'])->name('equipe.update');
        Route::post('/destroy-equipe/{id}', [EquipeController::class, 'destroy'])->name('destroy.equipe');

        // utilisateur
        Route::get('/index-users', [UserController::class, 'index'])->name('user.index'); // regroupe par partenaire
        Route::get('/index-users-by-partenaire/{id}', [UserController::class, 'indexByPartenaire'])->name('user.indexByPartenaire'); // affichage des users par partenaire
        Route::post('/store-users', [UserController::class, 'store'])->name('user.store');
        Route::post('/update-users/{id}', [UserController::class, 'update'])->name('user.update');
        Route::post('/destroy-users/{id}', [UserController::class, 'destroy'])->name('destroy.user');

        Route::post('/update-columns', [UserController::class, 'updateColumns'])->name('updateColumns');

        Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile');
        Route::post('/user/profile/update/{idmembre}', [UserController::class, 'updateProfile'])->name('user.profile.update');
        Route::post('/user/profile/updatePwd/', [UserController::class, 'updateMp'])->name('user.profile.updatePwd');
        Route::get('/indexCollaborateur', [UserController::class, 'indexCollaborateur'])->name('indexCollaborateur');

        // partenaires
        Route::get('/index-partners', [PartnerController::class, 'index'])->name('partner.index');
        Route::post('/store-partners', [PartnerController::class, 'store'])->name('partner.store');
        Route::post('/destroy-partners/{id}', [PartnerController::class, 'destroy'])->name('destroy.partner');
        Route::post('/update-partners/{id}', [PartnerController::class, 'update'])->name('partner.update');
        Route::post('/update-columns-partners', [PartnerController::class, 'updateColumnsPart'])->name('updateColumnsPart');

        //store reseau by product
        Route::post('/store-product-by-reseau', [SettingsController::class, 'productByReseauStore'])->name('store.product.by.reseau');
        Route::post('/destroy-product-by-reseau/{id}', [SettingsController::class, 'destroy'])->name('destroy.productReseau');

        //store prestation by product
        Route::get('/index-prestation-by-product', [SettingsController::class, 'indexPrestationProduct'])->name('prestation_product.index');
        Route::get('/add-prestation-by-product-form/{codeProduit}', [SettingsController::class, 'PrestationProductform'])->name('prestation_product.form');
        Route::post('/add-prestation-by-product', [SettingsController::class, 'PrestationProductStore'])->name('prestation_product.store');
        Route::post('/destroy-prestation-by-product/{id}', [SettingsController::class, 'PrestationProductDestroy'])->name('prestation_product.destroy');
        // Role Permission
        Route::get('/role', [RoleController::class, 'index'])->name('role');
        Route::post('/role-create', [RoleController::class, 'store'])->name('role.store');
        Route::post('/role-edit/{id}', [RoleController::class, 'update'])->name('role.edit');
        Route::post('/role-destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
        Route::get('/permission/{id}', [RoleController::class, 'permission'])->name('permission');
        Route::post('/permission-create', [RoleController::class, 'permissionStore'])->name('permission.store');
        Route::post('/group-create', [RoleController::class, 'groupStore'])->name('group.store');

        Route::post('/role-permission/{id}', [RoleController::class, 'rolePermissionSave'])->name('permission.save');


        Route::get('/index-motif-rejet', [MotifController::class, 'index'])->name('motifRejet.index');
        Route::get('/index-motif-rejet-proposition', [MotifController::class, 'indexMotifProposition'])->name('motifRejetProposition.index');
        Route::post('/store-motif-rejet-proposition', [MotifController::class, 'storeMotifProposition'])->name('motifRejetProposition.store');
        Route::post('/update-motif-rejet-proposition/{id}', [MotifController::class, 'updateMotifProposition'])->name('motifRejetProposition.update');
        Route::post('/destroy-motif-rejet-proposition/{id}', [MotifController::class, 'destroyMotifProposition'])->name('destroy.motifRejetProposition');

        Route::get('/index-motif-rejet-prestation', [MotifController::class, 'indexMotifPrestation'])->name('motifRejetPrestation.index');
        Route::post('/store-motif-rejet-prestation', [MotifController::class, 'storeMotifPrestation'])->name('motifRejetPrestation.store');
        Route::post('/update-motif-rejet-prestation/{id}', [MotifController::class, 'updateMotifPrestation'])->name('motifRejetPrestation.update');
        Route::post('/destroy-motif-rejet-prestation/{id}', [MotifController::class, 'destroyMotifPrestation'])->name('destroy.motifRejetPrestation');

        // reglage de notification group
        Route::get('/index-notif-group', [SettingsController::class, 'NotifGroupIndex'])->name('notifGroup.index');
        Route::post('/addGroup-notif-group', [SettingsController::class, 'addGroup'])->name('addGroup');
        Route::post('/editUserGroup-notif/{id}', [SettingsController::class, 'editUserGroup'])->name('editUserGroup');



    });

});

Route::prefix('epret')->name('epret.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){

        // formule by product reseau 

    });
    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('/demoSimulateur', [EpretController::class, 'demoSimulateur'])->name('demoSimulateur');
        Route::get('/index', [EpretController::class, 'index'])->name('index');
        Route::get('/simulateur', [EpretController::class, 'simulateur'])->name('simulateur');

        Route::post('/store-simulation', [EpretController::class, 'storeSimulation'])->name('storeSimulation');
        
        Route::get('/create', [EpretController::class, 'create'])->name('create');
        Route::post('/store', [EpretController::class, 'store'])->name('store');
        Route::get('/show/{id}', [EpretController::class, 'show'])->name('show');
        Route::post('/addDocDefaud', [EpretController::class, 'addDocDefaud'])->name('addDocDefaud');
        Route::get('/generateBu/{id}', [EpretController::class, 'generateBu'])->name('generateBu');
        Route::get('/edit/{id}', [EpretController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [EpretController::class, 'update'])->name('update');
        Route::post('/trans-pret/{id}', [EpretController::class, 'transmettrePret'])->name('transmettrePret');
        Route::post('/destroy/{id}', [EpretController::class, 'destroy'])->name('destroy');

        Route::post('/update/adherent/{id}', [AdherentController::class, 'update'])->name('adherent.update');
        Route::post('/store/benef', [BeneficiairesController::class, 'addBenefPret'])->name('addBenefPret');
        
    });

});
Route::get('/show/bullettin/test', [BulletinController::class, 'printBulletin'])->name('bullettin.test');

Route::prefix('cotation')->name('cotation.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){

    });
    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('/index', [CotationController::class, 'index'])->name('index');
        Route::post('/store/{uuid}', [CotationController::class, 'store'])->name('store');
        Route::get('/create/{id}', [CotationController::class, 'create'])->name('create');
    });
    
});



Route::prefix('prospect')->name('prospect.')->group(function(){
    Route::middleware('guest','PreventBackHistory')->group(function(){
        
        Route::get('/create/{tokken}', [ProspectController::class, 'create'])->name('create');
        Route::post('/store', [ProspectController::class, 'store']);
        // formule by product reseau 
        Route::get('/finish/{uuid}', [ProspectController::class, 'finish'])->name('finish');
        Route::post('/signaturePad', [ProspectController::class, 'signaturePad'])->name('signaturePad');

    });
    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::get('/index', [ProspectController::class, 'index'])->name('index');
        Route::get('/suivies', [ProspectController::class, 'suivies'])->name('suivies');
        Route::get('/show/{id}', [ProspectController::class, 'show'])->name('show');

        Route::post('/followups/store/{uuid}', [ProspectController::class, 'storeFollowup'])->name('followup.store');

        // Route::get('/edit/{uuid}', [ProspectController::class, 'edit'])->name('edit');
        Route::put('/update/{uuid}', [ProspectController::class, 'update'])->name('update');
        Route::post('/prospects/{uuid}/convert', [ProspectController::class, 'convertToClient'])->name('convert');
        

        Route::delete('/{prospectId}/products/{productId}', [ProspectController::class, 'destroy'])->name('delete');
        Route::post('/assign/{uuid}', [ProspectController::class, 'assign'])->name('assign');
        Route::post('/addProduct', [ProspectController::class, 'addProduct'])->name('addProduct');

        Route::get('/download', [ProspectController::class, 'downloadQrCode'])->name('download');


        // convert prospert to Client

        Route::get('/convert/form/{uuid}', [ProspectController::class, 'convertToClient'])->name('convert.form');

        

    });

});



// routes/web.php

Route::get('/prospection/{token}', [ProspectController::class, 'showForm'])->name('prospection.form');

Route::post('/prospection/{token}', [ProspectController::class, 'storeProspect']);


Route::get('storage/documents/{file}', function ($file) {
    $path = base_path(env('UPLOADS_PATH') . $file);

    if (!file_exists($path)) {
        abort(404);
    }

    $fileContents = file_get_contents($path);
    $mimeType = mime_content_type($path);

    return Response::make($fileContents, 200, ['Content-Type' => $mimeType]);
    
})->where('file', '.*');

Route::get('show/signature/{file}', function ($file) {
    $path = storage_path('app/public/' . $file);
    
    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
})->where('file', '.*');


Route::get('storage/prestations/{file}', function ($file) {
    // $path = base_path('../public_html/upload/prestations/' . $file);
    $path = base_path(env('UPLOAD_PRESTATION_FILE') . $file);
    if (!file_exists($path)) {
        abort(404);
    }

    $fileContents = file_get_contents($path);
    $mimeType = mime_content_type($path);

    return Response::make($fileContents, 200, ['Content-Type' => $mimeType]);
    
})->where('file', '.*');

Route::post('/save-beneficiary-session', [EpretController::class, 'saveBeneficiarySession']);
// web.php

Route::get('/generate-demoBulletin', [BulletinController::class, 'demoBulletin'])->name('demoBulletin');


// donnée de calcule des prime yke 
Route::post('/storeSimulationPrime', [ProductionController::class, 'storeSimulationPrime'])->name('storeSimulationPrime');


Route::get('/test-api-local', [TestController::class, 'testApi'])->name('testApi');

Route::get('/welcome', function () {
    return view('welcome');
});

route::get('/generate-bulletin-demo', [EpretController::class, 'generateBu'])->name('generateBul');

Route::get('/generate-qr', [ProductionController::class, 'getQrCode'])->name('generate-qr-code');

Route::post('/cretePaiement', [PaiementController::class, 'cretePaiement']);










// Téléchargement de fichier
Route::get('/file-manager/download/{uuid}', function ($uuid) {
    $file = FileManager::where('uuid', $uuid)->firstOrFail();
    
    $disk = Storage::disk('external');
    $filePath = $file->path;
    
    if (!$disk->exists($filePath)) {
        abort(404, 'Fichier non trouvé');
    }
    
    return $disk->download(
        $filePath,
        $file->name . '.' . $file->extension,
        [
            'Content-Type' => $file->mime_type,
            'Content-Disposition' => 'attachment; filename="' . $file->name . '.' . $file->extension . '"'
        ]
    );
})->name('file.download');

// Prévisualisation de fichier
Route::get('/file-manager/preview/{uuid}', function ($uuid) {
    $file = FileManager::where('uuid', $uuid)->firstOrFail();
    $disk = Storage::disk('external');

    if (!$disk->exists($file->path)) {
        abort(404);
    }

    // PDF ou Image : stream direct dans l'iframe
    if (str_starts_with($file->mime_type, 'image/') || $file->mime_type === 'application/pdf') {
        $stream = $disk->readStream($file->path);
        return response()->stream(function () use ($stream) {
            fpassthru($stream);
        }, 200, [
            'Content-Type' => $file->mime_type,
            'Content-Disposition' => 'inline; filename="' . $file->name . '.' . $file->extension . '"',
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }

    // Texte brut : afficher dans une vue
    if ($file->mime_type === 'text/plain') {
        $content = $disk->get($file->path);
        return view('file-manager.text-preview', ['content' => nl2br(e($content))]);
    }

    // Word : Google Docs Viewer
    if (in_array($file->mime_type, [
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ])) {
        $url = "https://docs.google.com/gview?url=" . urlencode(route('file-manager.download', $uuid)) . "&embedded=true";
        return view('file-manager.embed', ['url' => $url]);
    }

    // Fichier non pris en charge
    return view('file-manager.preview-not-available', ['file' => $file]);
});

Route::get('/sending', [ProductionController::class, 'sendMail']);
Route::get('/sending/user', [UserController::class, 'sendMail']);




Route::prefix('site')->name('site.')->group(function(){
    Route::get('/souscription/{codeMembre}', [SitePropositionController::class, 'stepProduct'])->name('stepProduct');
    Route::get('/simulateurPrimeDia/{codeProduit}/{userId}', [SitePropositionController::class, 'simulateurPrimeDia'])->name('simulateurPrimeDia');
    Route::get('/simulateurPrimeDirectE/{codeProduit}/{userId}', [SitePropositionController::class, 'simulateurPrimeDirectE'])->name('simulateurPrimeDirectE');
    Route::get('/create/{codeProduit}/{codePartner}', [SitePropositionController::class, 'create'])->name('create');

    Route::post('/update-adherent/{id}', [SitePropositionController::class, 'updateAdherent'])->name('update.adherent');

    // assurer 
    Route::post('/store-assure', [SitePropositionController::class, 'storeAssure'])->name('store.assure');

    // benef
    Route::post('/store-beneficiaire', [SitePropositionController::class, 'storeBeneficiaire'])->name('store.beneficiaire');
    Route::post('/update/benef-terme/{id}', [SitePropositionController::class, 'updateBeneficiaireTerme'])->name('benef-terme.update');
    Route::post('/update/benef-deces/{id}', [SitePropositionController::class, 'updateBenefDeces'])->name('benef-deces.update');

    // Documents
    Route::post('/store-documents', [SitePropositionController::class, 'storeDocuments'])->name('store.document');
    Route::post('/destroy-document/{id}', [SitePropositionController::class, 'destroyDocument'])->name('destroy.document');

    // contrat
    Route::post('/store/contrat', [SitePropositionController::class, 'storeContrat'])->name('store.contrat');
    Route::post('/storeSessionContratData', [SitePropositionController::class, 'storeSessionContratData'])->name('storeSessionContratData');
    Route::get('/showContratSite/{idContrat}', [SitePropositionController::class, 'showContratSite'])->name('showContratSite');

});



Route::get('/payment/success', function () {
    return "Paiement réussi ✅";
})->name('payment.success');

Route::get('/payment/failed', function () {
    return "Paiement échoué ❌";
})->name('payment.failed');




Route::get('/check-af', function () {
    $baseUrl = 'https://api.thecompaniesapi.com/v2/locations/cities';
    $page = 1;
    $africaCities = [];

    do {
        $response = Http::get($baseUrl, ['page' => $page]);

        if (!$response->ok()) {
            break; // On arrête si erreur API
        }

        $data = $response->json();

        // Filtre : uniquement villes Afrique
        $cities = array_filter($data['cities'] ?? [], function ($city) {
            return ($city['country']['code'] ?? null) === 'eu';
        });


        // Fusionne avec la liste globale
        $africaCities = array_merge($africaCities, $cities);

        // Gestion pagination
        $currentPage = $data['meta']['currentPage'] ?? $page;
        $lastPage = $data['meta']['lastPage'] ?? $page;

        $page++;
    } while ($currentPage < $lastPage);

    return array_values($africaCities);
});


Route::get('/notifications/check', function () {
    $user = auth()->user();

    // date limite = il y a 1 minute
    $oneMinuteAgo = Carbon::now()->subMinute();

    // On prend uniquement les non lues créées dans la dernière minute
    $recentUnread = $user->unreadNotifications()
        ->where('created_at', '>=', $oneMinuteAgo)
        ->get();

    return response()->json([
        'count' => $recentUnread->count(),
        'notifications' => $recentUnread,
        'unreadNotificationsCount' => $user->unreadNotifications()->count(),
    ]);
})->name('notifications.check');

Route::get('/email-send', [UserController::class, 'sendMail'])->name('email.send');
