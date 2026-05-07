<?php

use App\Http\Controllers\ProfileController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Models\Mariage;
use App\Http\Controllers\InhumationController;
use App\Http\Controllers\NationaliteController;
use App\Http\Controllers\PersonneController;
use App\Models\Nationalite;
use App\Models\Personne;
use App\Models\User;
use App\Models\EntiteAdministrative;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::middleware(['auth'])->group(function () {
   
  
});

Route::middleware('auth', 'role:superAdmin')->group(function () {
    Route::get('/dashboard-superadmin', [App\Http\Controllers\DashboardController::class, 'superAdmin'])->name('dashboard.superAdmin');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('users', App\Http\Controllers\UserController::class)->except(['show']);
    Route::resource('entites', App\Http\Controllers\EntiteAdministrativeController::class)->except(['show']);
    Route::resource('roles', App\Http\Controllers\RoleController::class)->except(['show']);
    Route::resource('personnes', App\Http\Controllers\PersonneController::class)->except(['show']);
    Route::resource('contrats', App\Http\Controllers\ContratController::class)->except(['show']);
    Route::resource('regimes', App\Http\Controllers\RegimeMatrimonialController::class)->except(['show']);
    Route::resource('statuts', App\Http\Controllers\StatutMariageController::class)->except(['show']);
    Route::resource('mariages', App\Http\Controllers\MariageController::class)->except(['show']);
    Route::get('mariages/{mariage}/temoins', [App\Http\Controllers\MariageController::class, 'temoins'])->name('mariages.temoins');
    Route::get('mariages/{mariage}/parents', [App\Http\Controllers\MariageController::class, 'parents'])->name('mariages.parents');
    Route::get('mariages/{mariage}', [App\Http\Controllers\MariageController::class, 'show'])->name('mariages.show');
    Route::post('mariages/temoins', [App\Http\Controllers\MariageController::class, 'storeTemoin'])->name('mariages.temoins.store');
    Route::post('mariages/parents', [App\Http\Controllers\MariageController::class, 'storeParent'])->name('mariages.parents.store');
});
// Dans routes/web.php
Route::middleware(['auth', 'role:province_admin,superAdmin'])->prefix('province')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\ProvinceDashboardController::class, 'index'])->name('province.dashboard');
    Route::get('/ville/{villeId}/details', [App\Http\Controllers\ProvinceDashboardController::class, 'villeDetails'])->name('province.ville.details');
    Route::get('/export', [App\Http\Controllers\ProvinceDashboardController::class, 'exportStats'])->name('province.export');
});

//route pour agent
Route::middleware('auth', 'role:agent,superAdmin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'agent'])->name('dashboard');

    Route::get('/rapport/imprimer', [App\Http\Controllers\DashboardController::class, 'imprimerRapport'])->name('rapport.imprimer');
    Route::get('/rapport/exporter', [App\Http\Controllers\DashboardController::class, 'exporterExcel'])->name('rapport.exporter');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('personnes', App\Http\Controllers\PersonneController::class)->except(['show']);

    Route::resource('mariages', App\Http\Controllers\MariageController::class)->except(['show']);
    Route::get('mariages/{mariage}/temoins', [App\Http\Controllers\MariageController::class, 'temoins'])->name('mariages.temoins');
    Route::get('mariages/{mariage}/parents', [App\Http\Controllers\MariageController::class, 'parents'])->name('mariages.parents');
    Route::get('mariages/{mariage}', [App\Http\Controllers\MariageController::class, 'show'])->name('mariages.show');
    Route::post('mariages/temoins', [App\Http\Controllers\MariageController::class, 'storeTemoin'])->name('mariages.temoins.store');
    Route::post('mariages/parents', [App\Http\Controllers\MariageController::class, 'storeParent'])->name('mariages.parents.store');

    Route::resource('nationalites', NationaliteController::class)->except(['show']);
    Route::get('/nationalites/{nationalite}', [App\Http\Controllers\NationaliteController::class, 'show'])->name('nationalites.show');

    Route::resource('bonneviemoeurs', App\Http\Controllers\BonneVieMoeursController::class)->except(['show']);
    Route::get('/bonneviemoeurs/{bonneviemoeur}', [App\Http\Controllers\BonneVieMoeursController::class, 'show'])->name('bonneviemoeurs.show');

    Route::resource('naissances', App\Http\Controllers\NaissanceController::class)->except(['show']);
    Route::get('/naissances/{naissance}', [App\Http\Controllers\NaissanceController::class, 'show'])->name('naissances.show');

    Route::resource('residences', App\Http\Controllers\ResidenceController::class)->except(['show']);
    Route::get('/residences/{residence}', [App\Http\Controllers\ResidenceController::class, 'show'])->name('residences.show');

    Route::resource('veuvages', App\Http\Controllers\VeuvageController::class)->except(['show']);
    Route::get('/veuvages/{veuvage}', [App\Http\Controllers\VeuvageController::class, 'show'])->name('veuvages.show');

    Route::resource('celibats', App\Http\Controllers\CelibatController::class)->except(['show']);
    Route::get('/celibats/{celibat}', [App\Http\Controllers\CelibatController::class, 'show'])->name('celibats.show');

    Route::resource('deces', App\Http\Controllers\DeceController::class)->except(['show']);
    Route::get('/deces/{dece}', [App\Http\Controllers\DeceController::class, 'show'])->name('deces.show');

    Route::resource('inhumations', App\Http\Controllers\InhumationController::class)->except(['show']);
    Route::get('/inhumations/{inhumation}', [App\Http\Controllers\InhumationController::class, 'show'])->name('inhumations.show');
});

Route::get('/inhumations/{inhumation}/pdf', [App\Http\Controllers\InhumationController::class, 'pdf'])->name('inhumations.attestation.pdf');
Route::get('/inhumations/{inhumation}/attestation', [App\Http\Controllers\InhumationController::class, 'attestation'])->name('inhumations.attestation');
Route::get('/inhumations/{inhumation}/verify', [App\Http\Controllers\InhumationController::class, 'verify'])->name('inhumations.verify');

Route::get('/deces/{dece}/pdf', [App\Http\Controllers\DeceController::class, 'pdf'])->name('deces.attestation.pdf');
Route::get('/deces/{dece}/attestation', [App\Http\Controllers\DeceController::class, 'attestation'])->name('deces.attestation');
Route::get('/deces/{dece}/verify', [App\Http\Controllers\DeceController::class, 'verify'])->name('deces.verify');

Route::get('celibats/{celibat}/pdf', [App\Http\Controllers\CelibatController::class, 'pdf'])->name('celibats.attestation.pdf');
Route::get('celibats/{celibat}/attestation', [App\Http\Controllers\CelibatController::class, 'attestation'])->name('celibats.attestation');
Route::get('celibats/{celibat}/verify', [App\Http\Controllers\CelibatController::class, 'verify'])->name('celibats.verify');

Route::get('veuvages/{veuvage}/pdf', [App\Http\Controllers\VeuvageController::class, 'pdf'])->name('veuvages.attestation.pdf');
Route::get('veuvages/{veuvage}/attestation', [App\Http\Controllers\VeuvageController::class, 'attestation'])->name('veuvages.attestation');
Route::get('veuvages/{veuvage}/verify', [App\Http\Controllers\VeuvageController::class, 'verify'])->name('veuvages.verify');

Route::get('/residences/{residence}/attestation', [App\Http\Controllers\ResidenceController::class, 'attestation'])->name('residences.attestation');
Route::get('/residences/{residence}/pdf', [App\Http\Controllers\ResidenceController::class, 'pdf'])->name('residences.attestation.pdf');
Route::get('/residences/{residence}/verify', [App\Http\Controllers\ResidenceController::class, 'verify'])->name('residences.verify');

Route::get('naissances/{naissance}/pdf', [App\Http\Controllers\NaissanceController::class, 'pdf'])->name('naissances.attestation.pdf');
Route::get('naissances/{naissance}/attestation', [App\Http\Controllers\NaissanceController::class, 'attestation'])->name('naissances.attestation');
Route::get('naissances/{naissance}/verify', [App\Http\Controllers\NaissanceController::class, 'verify'])->name('naissances.verify');

Route::get('bonneviemoeurs/{bonneviemoeur}/pdf', [App\Http\Controllers\BonneVieMoeursController::class, 'pdf'])->name('bonneviemoeurs.attestation.pdf');
Route::get('bonneviemoeurs/{bonneviemoeur}/attestation', [App\Http\Controllers\BonneVieMoeursController::class, 'attestation'])->name('bonneviemoeurs.attestation');
Route::get('bonneviemoeurs/{bonneviemoeur}/verify', [App\Http\Controllers\BonneVieMoeursController::class, 'verify'])->name('bonneviemoeurs.verify');

Route::get('/nationalites/{nationalite}/attestation', [App\Http\Controllers\NationaliteController::class, 'attestation'])->name('nationalites.attestation');
Route::get('/nationalites/{nationalite}/attestation/pdf', [App\Http\Controllers\NationaliteController::class, 'attestationPdf'])->name('nationalites.attestation.pdf');
Route::get('/nationalites/{nationalite}/verify', [App\Http\Controllers\NationaliteController::class, 'verify'])->name('nationalites.verify');

Route::get('/mariages/{mariage}/certificat', [App\Http\Controllers\MariageController::class, 'certificat'])->name('mariages.certificat');

Route::get('/mariages/{mariage}/certificat/pdf', [App\Http\Controllers\MariageController::class, 'certificatPdf'])->name('mariages.certificat.pdf');

Route::get('/mariages/{mariage}/verify', [App\Http\Controllers\MariageController::class, 'verify'])->name('mariages.verify');
use App\Http\Controllers\NationaliteVerificationController;

// Vérification par QR code (GET)
Route::get('/nationalites/verify/{id}', [NationaliteVerificationController::class, 'verify'])->name('nationalites.verify.qr');

// Formulaire de vérification manuelle
Route::get('/verification', [NationaliteVerificationController::class, 'verificationForm'])->name('verification.form');

// Vérification par numéro (POST)
Route::post('/verification', [NationaliteVerificationController::class, 'verifyByNumber'])->name('verification.check');

// API de vérification (pour services externes)
Route::get('/api/nationalites/verify/{id}', [NationaliteVerificationController::class, 'apiVerify']);

require __DIR__ . '/auth.php';
