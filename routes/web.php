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
Route::get('/', function(){
    
    return view('login');

});
// post la data du form de connexion
Route::post('/validlogin', [App\Http\Controllers\validLogin::class,'getLogin']);
// Route::post('/validlogin', function() {

//     $toto = staff::all();
//     return $toto;

// });
// Route::post("/validlogin",[App\Models\staff]);

