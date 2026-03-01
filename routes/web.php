<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MariageController;
use App\Models\Mariage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/certification/{mariage}', [MariageController::class, 'certification'])->name('certification');
// Dans routes/web.php
Route::post('/check-person-exists', [MariageController::class, 'checkPersonExists'])->name('check.person.exists');






Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour la gestion des mariages
    Route::resource('mariages', MariageController::class);

    // Drafts API for autosave
    Route::post('/mariage-drafts', [App\Http\Controllers\MariageDraftController::class, 'store'])->name('mariage-drafts.store');
    Route::get('/mariage-drafts/{mariageDraft}', [App\Http\Controllers\MariageDraftController::class, 'show'])->name('mariage-drafts.show');
    Route::delete('/mariage-drafts/{mariageDraft}', [App\Http\Controllers\MariageDraftController::class, 'destroy'])->name('mariage-drafts.destroy');
    
});

// Routes pour les agents communaux
Route::middleware(['auth', 'role:Agent'])->prefix('agent')->name('agent.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Agent\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/overviews', [App\Http\Controllers\Agent\OverviewController::class, 'index'])->name('overviews');

    // Mariages
    Route::get('mariagescommunes', [App\Http\Controllers\Agent\MariageController::class, 'index'])->name('mariagescommunes.index');
    Route::get('mariagescommunes/create', [App\Http\Controllers\Agent\MariageController::class, 'create'])->name('mariagescommunes.create');
    Route::post('mariagescommunes', [App\Http\Controllers\Agent\MariageController::class, 'store'])->name('mariagescommunes.store');
    Route::get('mariagescommunes/{mariage}/show', [App\Http\Controllers\Agent\MariageController::class, 'show'])->name('mariagescommunes.show');
    Route::get('mariagescommunes/{mariage}/edit', [App\Http\Controllers\Agent\MariageController::class, 'edit'])->name('mariagescommunes.edit');
    Route::put('mariagescommunes/{mariage}', [App\Http\Controllers\Agent\MariageController::class, 'update'])->name('mariagescommunes.update');

    Route::get('mariagescommunes/{mariage}/print', [App\Http\Controllers\Agent\MariageController::class, 'print'])->name('mariagescommunes.print');

    // Rapports
    Route::get('/rapports/mensuel', [App\Http\Controllers\Agent\RapportController::class, 'mensuel'])->name('rapports.mensuel');
    Route::get('/rapports/annuel', [App\Http\Controllers\Agent\RapportController::class, 'annuel'])->name('rapports.annuel');
    Route::get('/rapports/mensuel/export', [App\Http\Controllers\Agent\RapportController::class, 'exportMensuel'])->name('rapports.mensuel.export');
    Route::get('/rapports/annuel/export', [App\Http\Controllers\Agent\RapportController::class, 'exportAnnuel'])->name('rapports.annuel.export');

    // Profile
    Route::get('/profile', [App\Http\Controllers\Agent\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\Agent\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\Agent\ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Drafts listing for agents
    Route::get('/drafts', [App\Http\Controllers\Agent\MariageDraftController::class, 'index'])->name('drafts.index');
});

// web.php
Route::group(['prefix' => 'agent/mariagescommunes', 'as' => 'agent.mariagescommunes.'], function () {
    Route::get('/create', [MariageController::class, 'create'])->name('create');
    Route::get('/create/step/{step}', [MariageController::class, 'createStep'])->name('create.step');
    Route::post('/create/step/{step}', [MariageController::class, 'saveStep'])->name('save.step');
    Route::post('/', [MariageController::class, 'store'])->name('mariages.store');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admins.php';
