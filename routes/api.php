<?php

use App\Http\Controllers\API\LeadController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\TechnologyController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('projects', [ProjectController::class, 'index']);
Route::get('favourites', [ProjectController::class, 'favourites']);
Route::get('technologies', [TechnologyController::class, 'index']);
Route::get('projects/{slug}', [ProjectController::class, 'show']);

/* rotta in post per i dati ricevuti dal form */
Route::post('contacts', [LeadController::class, 'store']);