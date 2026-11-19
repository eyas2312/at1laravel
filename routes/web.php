<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthController;

Route::resource('categories', CategoryController::class)
    ->except(['show'])
    ->middleware('can:gerer-categories');
    
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/tableau-de-bord', [AdminController::class, 'index'])
            ->name('dashboard');

    });

Route::get('/', [PageController::class, 'accueil'])
    ->name('accueil');
Route::get('/a-propos', [PageController::class, 'aPropos'])
    ->name('a-propos');

Route::resource('contenus', ContenuController::class)
    ->except(['index', 'show'])
    ->middleware('auth');

Route::resource('contenus', ContenuController::class)
    ->only(['index', 'show']);
    
Route::get('/liste-contenus', [ContenuController::class, 'index'])
    ->name('liste-contenus');
    // Authentification
Route::middleware('guest')->group(function () {

    Route::get('/inscription', [AuthController::class, 'inscription'])
        ->name('inscription');

    Route::post('/inscription', [AuthController::class, 'enregistrer'])
        ->name('inscription.enregistrer');

    Route::get('/connexion', [AuthController::class, 'connexion'])
        ->name('connexion');

    Route::post('/connexion', [AuthController::class, 'authentifier'])
        ->name('connexion.authentifier');

});

Route::post('/deconnexion', [AuthController::class, 'deconnexion'])
    ->middleware('auth')
    ->name('deconnexion');