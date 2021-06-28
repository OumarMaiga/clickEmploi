<?php

use App\Http\Controllers\AbonneeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\PostuleController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\OpportuniteController;

Route::get('/', [HomeController::class, 'accueil'])->name('accueil');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/accueil', [HomeController::class, 'accueil'])->name('accueil');
Route::get('/filtre', [HomeController::class, 'filtre'])->name('filtre');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/opportunite/adresse/{adresse}', [OpportuniteController::class, 'adresse'])->name('opportunite.adresse');

Route::get('/emploi/{slug}', [EmploiController::class, 'detail'])->name('emploi.detail');
Route::get('/emplois', [EmploiController::class, 'list'])->name('emploi.list');

Route::get('/stage/{slug}', [StageController::class, 'detail'])->name('stage.detail');
Route::get('/stages', [StageController::class, 'list'])->name('stage.list');

Route::get('/formation/{slug}', [FormationController::class, 'detail'])->name('formation.detail');
Route::get('/formations', [FormationController::class, 'list'])->name('formation.list');

Route::post('/postule/store/{slug}', [PostuleController::class, 'store'])->middleware(['auth'])->name('postule.store');

Route::get('/{email}', [HomeController::class, 'profil'])->middleware(['auth'])->name('profil');
Route::get('/{email}/edit', [HomeController::class, 'edit_profil'])->middleware(['auth'])->name('edit_profil');
Route::put('/{id}/update', [HomeController::class, 'update_profil'])->middleware(['auth'])->name('update_profil'); 

Route::get('/entreprise/{slug}', [EntrepriseController::class, 'detail'])->middleware(['auth'])->name('entreprise.detail');

