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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::resource('projets', ProjetController::class);
Route::resource('certificats', CertificatController::class);
Route::resource('technologies', TechnologieController::class);

Route::resource('blogs', BlogController::class); 

