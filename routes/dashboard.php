<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\EmploiController;
use App\Http\Controllers\StageController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\SecteurController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AbonneeController;

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

//ENTREPRISE
Route::resource('/dashboard/entreprise', EntrepriseController::class)->middleware(['auth']);

//UTILISATEUR
Route::get('dashboard/user/filter', [UserController::class, 'filter'])->middleware(['auth'])->name('user.filter');
Route::resource('/dashboard/user', UserController::class)->middleware(['auth']);
Route::put('/dashboard/user/{email}/changeState', [UserController::class, 'changeState'])->name('user.changeState')->middleware(['auth']);
//Route::get('importExportView', [MyController::class, 'importExportView']);
Route::get('export', [UserController::class, 'export'])->name('export');
//Route::post('import', 'MyController@import')->name('import');

Route::get('/dashboard/abonnee', [AbonneeController::class, 'index'])->middleware(['auth'])->name('abonnee');

Route::get('/dashboard/{email}/abonnee', [AbonneeController::class, 'show'])->middleware(['auth'])->name('abonnee.show');

Route::delete('/dashboard/destroy/{id}', [AbonneeController::class, 'destroy'])->middleware(['auth'])->name('abonnee.destroy');