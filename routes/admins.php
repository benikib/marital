<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MariageController;
use App\Http\Controllers\TypeRoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\CommuneController;
use App\Http\Controllers\EpouxController;
use App\Models\Epoux;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatuController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\OverviewController;




Route::get('/typeRoles', [TypeRoleController::class, 'index'])->name('typeRoles.index');
Route::get('/type-roles', [TypeRoleController::class, 'index'])->name('type-roles.index');
Route::post('/type-roles', [TypeRoleController::class, 'store'])->name('type-roles.store');
Route::get('/type-roles/{type_role}/edit', [TypeRoleController::class, 'edit'])->name('type-roles.edit');
Route::put('/typeRoles/{type_role}', [TypeRoleController::class, 'update'])->name('type-roles.update');
Route::delete('/typeRoles/{type_role}', [TypeRoleController::class, 'destroy'])->name('type-roles.destroy');

// Routes pour les utilisateurs
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Routes pour les provinces
Route::get('/provinces', [ProvinceController::class, 'index'])->name('provinces.index');
Route::post('/provinces', [ProvinceController::class, 'store'])->name('provinces.store');
Route::get('/provinces/{province}', [ProvinceController::class, 'show'])->name('provinces.show');
Route::get('/provinces/{province}/edit', [ProvinceController::class, 'edit'])->name('provinces.edit');
Route::put('/provinces/{province}', [ProvinceController::class, 'update'])->name('provinces.update');
Route::delete('/provinces/{province}', [ProvinceController::class, 'destroy'])->name('provinces.destroy');


// Routes pour les communes
Route::get('/communes', [CommuneController::class, 'index'])->name('communes.index');
Route::post('/communes', [CommuneController::class, 'store'])->name('communes.store');
Route::get('/communes/{commune}/show', [CommuneController::class, 'show'])->name('communes.show');
Route::get('/communes/{commune}/edit', [CommuneController::class, 'edit'])->name('communes.edit');
Route::put('/communes/{commune}', [CommuneController::class, 'update'])->name('communes.update');
Route::delete('/communes/{commune}', [CommuneController::class, 'destroy'])->name('communes.destroy');

// Routes pour les statuts
Route::prefix('status')->group(function () {
    Route::get('/', [StatuController::class, 'index'])->name('status.index');
    Route::get('/create', [StatuController::class, 'create'])->name('status.create');
    Route::post('/', [StatuController::class, 'store'])->name('status.store');
    Route::get('/{statu}', [StatuController::class, 'show'])->name('status.show');
    Route::get('/{statu}/edit', [StatuController::class, 'edit'])->name('status.edit');
    Route::put('/{statu}', [StatuController::class, 'update'])->name('status.update');
    Route::delete('/{statu}', [StatuController::class, 'destroy'])->name('status.destroy');
});

// Routes pour les contrats
Route::prefix('contrats')->group(function () {
    Route::get('/', [ContratController::class, 'index'])->name('contrats.index');
    Route::post('/', [ContratController::class, 'store'])->name('contrats.store');
    Route::put('/{contrat}', [ContratController::class, 'update'])->name('contrats.update');
    Route::delete('/{contrat}', [ContratController::class, 'destroy'])->name('contrats.destroy');
});

// Routes pour les mariages
Route::prefix('mariages')->group(function () {
    Route::get('/', [MariageController::class, 'index'])->name('mariages.index');
    Route::get('/create', [MariageController::class, 'create'])->name('mariages.create');
    Route::post('/', [MariageController::class, 'store'])->name('mariages.store');
    Route::get('/{mariage}', [MariageController::class, 'show'])->name('mariages.show');
    Route::get('/{mariage}/edit', [MariageController::class, 'edit'])->name('mariages.edit');
    Route::put('/{mariage}', [MariageController::class, 'update'])->name('mariages.update');
    Route::delete('/{mariage}', [MariageController::class, 'destroy'])->name('mariages.destroy');

    // Routes pour la gestion des photos
    Route::post('/{mariage}/upload-photo-epoux', [MariageController::class, 'uploadPhotoEpoux'])->name('mariages.upload.photo.epoux');
    Route::post('/{mariage}/upload-photo-epouse', [MariageController::class, 'uploadPhotoEpouse'])->name('mariages.upload.photo.epouse');
    Route::delete('/{mariage}/delete-photo-epoux', [MariageController::class, 'deletePhotoEpoux'])->name('mariages.delete.photo.epoux');
    Route::delete('/{mariage}/delete-photo-epouse', [MariageController::class, 'deletePhotoEpouse'])->name('mariages.delete.photo.epouse');
});
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Routes pour les rapports
Route::prefix('rapports')->group(function () {
    Route::get('/mensuel', [RapportController::class, 'mensuel'])->name('rapports.mensuel');
    Route::get('/annuel', [RapportController::class, 'annuel'])->name('rapports.annuel');
    Route::get('/mensuel/print/{mois}/{annee}', [RapportController::class, 'printMensuel'])->name('rapports.mensuel.print');
    Route::get('/annuel/print/{annee}', [RapportController::class, 'printAnnuel'])->name('rapports.annuel.print');
});

Route::get('/overviews', [OverviewController::class, 'index'])->name('overviews');
