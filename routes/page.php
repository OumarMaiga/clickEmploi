<?php

use App\Http\Controllers\AbonneeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\PostuleController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\FormationController;

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth'])->name('home');

Route::get('/dashboard/abonnee', [AbonneeController::class, 'index'])->middleware(['auth'])->name('abonnee');

Route::get('/dashboard/{email}/abonnee', [AbonneeController::class, 'show'])->middleware(['auth'])->name('abonnee.show');

Route::delete('/dashboard/destroy/{id}', [AbonneeController::class, 'destroy'])->middleware(['auth'])->name('abonnee.destroy');

Route::get('/emploi/{slug}', [EmploiController::class, 'detail'])->middleware(['auth'])->name('emploi.detail');

Route::get('/stage/{slug}', [StageController::class, 'detail'])->middleware(['auth'])->name('stage.detail');

Route::get('/formation/{slug}', [FormationController::class, 'detail'])->middleware(['auth'])->name('formation.detail');

Route::post('/postule/store/{slug}', [PostuleController::class, 'store'])->middleware(['auth'])->name('postule.store');

Route::get('/{email}', [HomeController::class, 'profil'])->middleware(['auth'])->name('profil');
Route::get('/{email}/edit', [HomeController::class, 'edit_profil'])->middleware(['auth'])->name('edit_profil');
Route::put('/{id}/update', [HomeController::class, 'update_profil'])->middleware(['auth'])->name('update_profil'); 