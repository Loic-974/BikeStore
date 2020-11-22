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
// -------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------- Deconnexion ---------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------
Route::any('/SignOut', [App\Http\Controllers\SignOut::class,'SignOut']);

Auth::routes();

// -------------------------------------------------------------------------------------------------------------------------
// --------------------------------------------------- Production ---------------------------------------------------------
// -------------------------------------------------------------------------------------------------------------------------

Route::get('/production',function(){
    return view('production');
})->name('production');

Route::get('/production/getBrand',[App\Http\Controllers\brandController::class,'listBrand']);
Route::get('/production/getCat',[App\Http\Controllers\CategoryProdController::class,'getListCategories']);
Route::get('/production/getProduct',[App\Http\Controllers\ProductProdController::class,'getListProduct']);
Route::get('/production/getStock',[App\Http\Controllers\StockProdController::class,'getListStock']);
// ------------- Brand -------------- //
Route::post('/production/postBrand',[App\Http\Controllers\brandController::class,'addBrand']);
Route::post('/production/updateBrand',[App\Http\Controllers\brandController::class,'updateBrand']);
Route::post('/production/deleteBrand',[App\Http\Controllers\brandController::class,'deleteBrand']);

// ------------- Categorie ---------------//

Route::post('/production/postCategory',[App\Http\Controllers\CategoryProdController::class,'addCategoryProduction']);