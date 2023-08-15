<?php

use App\Http\Controllers\ProjetController;
use App\Http\Controllers\CertificatController;
use App\Http\Controllers\TechnologieController;
use App\Http\Controllers\BlogController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function(){
 

    route::get('/user', function (Request $request) {
        return $request->user();
});

    Route::resource('projets', ProjetController::class);
    Route::resource('certificats', CertificatController::class);
    Route::resource('technologies', TechnologieController::class);

    Route::resource('blogs', BlogController::class); 

    // pour modifier un article dans la bd
    Route::post('projets/{id}', [ProjetController::class, 'update'] );
    Route::post('certificats/{id}', [CertificatController::class, 'update'] );
    Route::post('technologies/{id}', [TechnologieController::class, 'update'] );
    Route::post('blogs/{id}', [BlogController::class, 'update'] );

});
