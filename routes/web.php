<?php

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PuzzleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FournisseurController;
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


Route::get('/', [CategorieController::class, 'home'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('puzzles', PuzzleController::class)->only(['index', 'show']);
Route::resource('categories',CategorieController::class);


Route::post('/panier/add/{id}', [PanierController::class, 'add'])->name('panier.add');
Route::get('/panier', [PanierController::class, 'index'])->name('paniers.index');
Route::post('/panier/remove/{id}', [PanierController::class, 'remove'])->name('panier.remove');
Route::post('/panier/update/{id}', [PanierController::class, 'update'])->name('panier.update');

// Checkout (auth obligatoire)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');              // page payer
    Route::post('/checkout/address/update', [CheckoutController::class, 'updateAddress'])->name('checkout.address.update');
    Route::post('/checkout/pay', [CheckoutController::class, 'pay'])->name('checkout.pay');          // clique sur "Valider la commande"

    // PayPal (exemple de flux)
    Route::get('/paypal/return', [CheckoutController::class, 'paypalReturn'])->name('paypal.return');
    Route::get('/paypal/cancel', [CheckoutController::class, 'paypalCancel'])->name('paypal.cancel');

    #pour fournisseur
    Route::resource('fournisseurs', FournisseurController::class);
});


require __DIR__.'/auth.php';
