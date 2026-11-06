<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContenuController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/tableau-de-bord', [AdminController::class, 'index'])
        ->name('dashboard');
});
Route::get('/', [PageController::class, 'accueil']);

Route::get('/a-propos', [PageController::class, 'aPropos'])
    ->name('a-propos');

Route::resource('contenus', ContenuController::class);
Route::get('/liste-contenus/{tri?}', function ($tri = 'recent') {
    return 'Tri : ' . $tri;
});