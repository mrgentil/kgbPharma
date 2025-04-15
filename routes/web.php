<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicamentController;

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Routes Users
    Route::resource('users', UserController::class)->except(['show']);
    Route::post('/users/{user}/suspend', [UserController::class, 'suspend'])
        ->name('users.suspend');

        // Routes Medicaments
        Route::resource('medicaments', MedicamentController::class);
});
