<?php

use App\Http\Controllers\ProfileController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use App\Models\Mariage;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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

//route pour agent 
Route::middleware('auth', 'role:agent,superAdmin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'agent'])->name('dashboard');
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
    
});

Route::get('/mariages/{mariage}/certificat', [App\Http\Controllers\MariageController::class, 'certificat'])
    ->name('mariages.certificat');

Route::get('/mariages/{mariage}/certificat/pdf', [App\Http\Controllers\MariageController::class, 'certificatPdf'])
    ->name('mariages.certificat.pdf');

Route::get('/mariages/{mariage}/verify', [App\Http\Controllers\MariageController::class, 'verify'])
    ->name('mariages.verify'); 


require __DIR__.'/auth.php';
