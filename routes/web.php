<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

Route::resource('categories', CategoryController::class)->except(['show']);
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/tableau-de-bord', [AdminController::class, 'index'])
        ->name('dashboard');
});
Route::get('/', [PageController::class, 'accueil'])
    ->name('accueil');
Route::get('/a-propos', [PageController::class, 'aPropos'])
    ->name('a-propos');

Route::resource('contenus', ContenuController::class);
Route::get('/liste-contenus', [ContenuController::class, 'index'])
    ->name('liste-contenus');