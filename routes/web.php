<?php

use Illuminate\Support\Facades\Route;
use App\Models\staff;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/login',[App\Http\Controllers\Controller::class,'toto'])->name('toto');

// -------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------- root -------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------

Route::get('/', function(){
    
    return view('login', ['error'=>''],['mail'=>'']);

})->name('/');
// post la data du form de connexion vers le controller
//------------------------------------\nomdelaclasse----, nom de la methode(function)
Route::post('/', [App\Http\Controllers\validLogin::class,'loginCheck']);

// -------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------- Accueil -------------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------
Route::get('/accueil', function() {

        return view('accueil',['firstConnect'=>0]);

    })->name('accueil');

// Route::post('/accueil/updatePwd', [App\Http\Controllers\updatePassword::class,'updatePassword'])->name('updatePwd');
// Route::get('/accueil/updatePwd', [App\Http\Controllers\updatePassword::class,'getOldPassword'])->name('getpwd');
Route::get('/accueil/updatePwd', [App\Http\Controllers\updatePassword::class,'getOldPassword']);
Route::post('/accueil',[App\Http\Controllers\updatePassword::class,'updatePassword']);
Route::get('/session',[App\Http\Controllers\getSessionId::class,'getId']);
// -------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------- Deconnexion ---------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------
Route::any('/SignOut', [App\Http\Controllers\SignOut::class,'SignOut']);

Auth::routes();


// -------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------- Notification ---------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------

Route::get('/notification', [App\Http\Controllers\Notification\Controller_Notification::class,'getNotification']);
Route::post('/notificationUpdate',[App\Http\Controllers\Notification\Controller_Notification::class,'notificationUpdate']);

// -------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------- Production ---------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------

Route::get('/production',function(){
    return view('production');
})->name('production');

Route::get('/production/getBrand',[App\Http\Controllers\Production\brandController::class,'listBrand']);
Route::get('/production/getCat',[App\Http\Controllers\Production\CategoryProdController::class,'getListCategories']);
Route::get('/production/getProduct',[App\Http\Controllers\Production\ProductProdController::class,'getListProduct']);
Route::get('/production/getStock',[App\Http\Controllers\Production\StockProdController::class,'getListStock']);
// ------------- Brand -------------- //
Route::post('/production/postBrand',[App\Http\Controllers\Production\brandController::class,'addBrand']);
Route::post('/production/updateBrand',[App\Http\Controllers\Production\brandController::class,'updateBrand']);
Route::post('/production/deleteBrand',[App\Http\Controllers\Production\brandController::class,'deleteBrand']);
// ------------- Categorie ---------------//
Route::post('/production/postCategory',[App\Http\Controllers\Production\CategoryProdController::class,'addCategoryProduction']);
Route::post('/production/updateCategory',[App\Http\Controllers\Production\CategoryProdController::class,'updateCategoryProduction']);
Route::post('/production/deleteCategory',[App\Http\Controllers\Production\CategoryProdController::class,'deleteCategoryProduction']);
//-------------- Product ---------------- //
Route::post('/production/postProduct',[App\Http\Controllers\Production\ProductProdController::class,'addProductProduction']);
Route::post('/production/updateProduct',[App\Http\Controllers\Production\ProductProdController::class,'updateProductProduction']);
Route::post('/production/deleteProduct',[App\Http\Controllers\Production\ProductProdController::class,'deleteProductProduction']);
//-------------- Stock ---------------- //
Route::post('/production/insertStock', [App\Http\Controllers\Production\StockProdController::class,'insertNewStock']);
Route::post('/production/updateStock', [App\Http\Controllers\Production\StockProdController::class,'updateProductStock']);

// -------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------- Vente ---------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------

Route::get('/vente', function(){
    return view('section');
})->name('vente');

Route::get('/vente/getCustomer',[App\Http\Controllers\Vente\customers_Controller::class,'getCustomers']);
Route::get('/vente/getOrder',[App\Http\Controllers\Vente\orders_Controller::class,'getOrderData']);
Route::get('/vente/getStock',[App\Http\Controllers\Vente\orders_Controller::class,'getStockOrder']);


Route::post('/vente/newOrder',[App\Http\Controllers\Vente\orders_Controller::class,'newOrder']);
Route::post('/vente/updateCustomer',[App\Http\Controllers\Vente\customers_Controller::class,'updateCustomer']);
Route::post('/vente/getFacture', [App\Http\Controllers\Vente\facture_Controller::class,'getFactureData']);
// -------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------- Reporting ---------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------
Route::get('/reporting', function(){
    return view('section');
})->name('reporting');

Route::post('/Reporting/GetReporting', [App\Http\Controllers\Reporting\Controller_Reporting::class,'getReportingData']);