<?php

use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\CategorieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Remplace la route actuelle
Route::get('/', [CategorieController::class, 'home'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('puzzles',PuzzleController::class)->middleware('auth');
Route::resource('categories',CategorieController::class);


Route::post('/panier/add/{id}', [PanierController::class, 'add'])->name('panier.add');
Route::get('/panier', [PanierController::class, 'index'])->name('paniers.index');
Route::post('/panier/remove/{id}', [PanierController::class, 'remove'])->name('panier.remove');
Route::post('/panier/update/{id}', [PanierController::class, 'update'])->name('panier.update');

require __DIR__.'/auth.php';
