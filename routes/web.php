<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\DashboardController;

// Page d'accueil publique
Route::get('/', function () {
    return view('welcome');
});

// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Gestion des contacts
    Route::resource('contacts', ContactController::class);
    
    // Gestion des groupes
    Route::resource('groups', GroupController::class);
});

// Routes d'authentification Laravel Breeze/UI (à installer)
require __DIR__.'/auth.php';
