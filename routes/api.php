<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PublicationController;
use App\Http\Controllers\Api\AuthController;
// Route utilisateur authentifié
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Lecture publique des publications
Route::apiResource('publications', PublicationController::class)
    ->only(['index', 'show']);
Route::post('/connexion', [AuthController::class, 'connexion']);
// Opérations protégées par Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('publications', PublicationController::class)
        ->except(['index', 'show']);
});
