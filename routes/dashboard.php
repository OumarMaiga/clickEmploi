<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\SecteurController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

//Partenaire
Route::resource('/dashboard/partenaire', PartenaireController::class)->middleware(['auth']);

//EMPLOI
Route::resource('/dashboard/emploi', EmploiController::class)->middleware(['auth']);

//STAGE
Route::resource('/dashboard/stage', StageController::class)->middleware(['auth']);

//FORMATION
Route::resource('/dashboard/formation', FormationController::class)->middleware(['auth']);

//DIPLOME
Route::resource('/dashboard/diplome', DiplomeController::class)->middleware(['auth']);

//SECTEUR
Route::resource('/dashboard/secteur', SecteurController::class)->middleware(['auth']);
