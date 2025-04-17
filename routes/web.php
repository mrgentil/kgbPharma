<?php

use App\Models\HistoriqueStock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\HistoriqueStockController;

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Routes Users
    Route::resource('users', UserController::class)->except(['show']);
    Route::post('/users/{user}/suspend', [UserController::class, 'suspend'])
        ->name('users.suspend');

    // Routes Medicaments
    Route::resource('medicaments', MedicamentController::class);
    // Routes Historique Stock
    Route::resource('stories', HistoriqueStockController::class);


});
