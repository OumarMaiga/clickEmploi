<?php

use App\Http\Controllers\AbonneeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\PostuleController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\FormationController;

Route::get('/home', [HomeController::class, 'index'])->middleware(['auth'])->name('home');

Route::get('/accueil', [HomeController::class, 'accueil'])->name('accueil');

Route::get('/emploi/{slug}', [EmploiController::class, 'detail'])->middleware(['auth'])->name('emploi.detail');
Route::get('/emplois', [EmploiController::class, 'list'])->middleware(['auth'])->name('emploi.list');

Route::get('/stage/{slug}', [StageController::class, 'detail'])->middleware(['auth'])->name('stage.detail');
Route::get('/stages', [StageController::class, 'list'])->middleware(['auth'])->name('stage.list');

Route::get('/formation/{slug}', [FormationController::class, 'detail'])->middleware(['auth'])->name('formation.detail');
Route::get('/formations', [FormationController::class, 'list'])->middleware(['auth'])->name('formation.list');

Route::post('/postule/store/{slug}', [PostuleController::class, 'store'])->middleware(['auth'])->name('postule.store');

Route::get('/{email}', [HomeController::class, 'profil'])->middleware(['auth'])->name('profil');
Route::get('/{email}/edit', [HomeController::class, 'edit_profil'])->middleware(['auth'])->name('edit_profil');
Route::put('/{id}/update', [HomeController::class, 'update_profil'])->middleware(['auth'])->name('update_profil'); 

