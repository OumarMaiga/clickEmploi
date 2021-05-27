<?php

use App\Http\Controllers\AbonneeController;
use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth'])->name('home');

Route::get('/dashboard/abonnee', [AbonneeController::class, 'index'])->middleware(['auth'])->name('abonnee');

Route::get('/dashboard/{email}/abonnee', [AbonneeController::class, 'show'])->middleware(['auth'])->name('abonnee.show');

Route::delete('/dashboard/destroy/{1}', [AbonneeController::class, 'destroy'])->middleware(['auth'])->name('abonnee.destroy');
