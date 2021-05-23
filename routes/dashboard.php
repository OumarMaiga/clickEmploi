<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\SecteurController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

//Partenaire
Route::get('/dashboard/partenaire', [PartenaireController::class, 'index'])->middleware(['auth'])->name('partenaire');
Route::get('/dashboard/partenaire/show/{email}', [PartenaireController::class, 'show'])->middleware(['auth'])->name('partenaire.show');
Route::get('/dashboard/partenaire/edit/{email}', [PartenaireController::class, 'edit'])->middleware(['auth'])->name('partenaire.edit');
Route::get('/dashboard/partenaire/create', [PartenaireController::class, 'create'])->middleware(['auth'])->name('partenaire.create');
Route::put('/dashboard/partenaire/update/{email}', [PartenaireController::class, 'update'])->middleware(['auth'])->name('partenaire.update');
Route::post('/dashboard/partenaire/store', [PartenaireController::class, 'store'])->middleware(['auth'])->name('partenaire.store');
Route::delete('/dashboard/partenaire/destroy/{id}', [PartenaireController::class, 'destroy'])->middleware(['auth'])->name('partenaire.destroy');

//EMPLOI
Route::get('/dashboard/emploi', [EmploiController::class, 'index'])->middleware(['auth'])->name('emploi');
Route::get('/dashboard/emploi/show/{slug}', [EmploiController::class, 'show'])->middleware(['auth'])->name('emploi.show');
Route::get('/dashboard/emploi/edit/{slug}', [EmploiController::class, 'edit'])->middleware(['auth'])->name('emploi.edit');
Route::get('/dashboard/emploi/create', [EmploiController::class, 'create'])->middleware(['auth'])->name('emploi.create');
Route::put('/dashboard/emploi/update/{slug}', [EmploiController::class, 'update'])->middleware(['auth'])->name('emploi.update');
Route::post('/dashboard/emploi/store', [EmploiController::class, 'store'])->middleware(['auth'])->name('emploi.store');
Route::delete('/dashboard/emploi/destroy/{id}', [EmploiController::class, 'destroy'])->middleware(['auth'])->name('emploi.destroy');

//DIPLOME
Route::get('/dashboard/diplome', [DiplomeController::class, 'index'])->middleware(['auth'])->name('diplome');
Route::get('/dashboard/diplome/show/{slug}', [DiplomeController::class, 'show'])->middleware(['auth'])->name('diplome.show');
Route::get('/dashboard/diplome/edit/{slug}', [DiplomeController::class, 'edit'])->middleware(['auth'])->name('diplome.edit');
Route::get('/dashboard/diplome/create', [DiplomeController::class, 'create'])->middleware(['auth'])->name('diplome.create');
Route::put('/dashboard/diplome/update/{id}', [DiplomeController::class, 'update'])->middleware(['auth'])->name('diplome.update');
Route::post('/dashboard/diplome/store', [DiplomeController::class, 'store'])->middleware(['auth'])->name('diplome.store');
Route::delete('/dashboard/diplome/destroy/{id}', [DiplomeController::class, 'destroy'])->middleware(['auth'])->name('diplome.destroy');

//SECTEUR
Route::get('/dashboard/secteur', [SecteurController::class, 'index'])->middleware(['auth'])->name('secteur');
Route::get('/dashboard/secteur/show/{slug}', [SecteurController::class, 'show'])->middleware(['auth'])->name('secteur.show');
Route::get('/dashboard/secteur/edit/{slug}', [SecteurController::class, 'edit'])->middleware(['auth'])->name('secteur.edit');
Route::get('/dashboard/secteur/create', [SecteurController::class, 'create'])->middleware(['auth'])->name('secteur.create');
Route::put('/dashboard/secteur/update/{id}', [SecteurController::class, 'update'])->middleware(['auth'])->name('secteur.update');
Route::post('/dashboard/secteur/store', [SecteurController::class, 'store'])->middleware(['auth'])->name('secteur.store');
Route::delete('/dashboard/secteur/destroy/{id}', [SecteurController::class, 'destroy'])->middleware(['auth'])->name('secteur.destroy');
