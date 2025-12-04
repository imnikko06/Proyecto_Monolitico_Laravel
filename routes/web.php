<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Aqui he metido las rutas anteriores

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PetitionController;

Route::get('/', [PagesController::class, 'home']);
Route::get('/', [\App\Http\Controllers\PagesController::class, 'home'])->name('home');

Route::controller(\App\Http\Controllers\PetitionController::class)->group(function () {
    Route::get('petitions/index', 'index')->name('petitions.index');
    Route::get('petitions/{id}', 'show')->name('petitions.show');
    Route::get('mypetitions', [PetitionController::class, 'listMine'])
        ->name('petitions.mine')
        ->middleware('auth');
    Route::post('petitions/sign/{id}', 'sign')->name('petitions.sign')->middleware('auth');
    Route::get('petition/add', [PetitionController::class, 'create'])->name('petitions.create')->middleware('auth');
    Route::post('petition', [PetitionController::class, 'store'])->name('petitions.store')->middleware('auth');
    Route::get('signedPetitions',  [PetitionController::class, 'signedPetitions'])->name('petitions.signedPetitions')->middleware('auth');

    Route::delete('peticiones/{id}', 'delete')->name('petitions.delete');
    Route::put('peticiones/{id}', 'update')->name('petitions.update');
    Route::get('peticiones/edit/{id}', 'update')->name('petitions.edit');
});

Route::middleware('admin')->controller(\App\Http\Controllers\Admin\AdminPetitionsController::class)->group(function () {
    Route::get('admin', 'index')->name('admin.home');
    Route::get('admin/petitions/index', 'index')->name('admin.petitions.index');
    Route::get('admin/petitions/{id}', 'show')->name('admin.petitions.show');
    Route::get('admin/petition/add', 'create')->name('admin.petitions.create');
    Route::get('admin/petitions/edit/{id}', 'edit')->name('admin.petitions.edit');
    Route::post('admin/petitions', 'store')->name('admin.petitions.store');
    Route::delete('admin/petitions/{id}', 'delete')->name('admin.petitions.delete');
    Route::put('admin/petitions/{id}', 'update')->name('admin.petitions.update');
    Route::put('admin/petitions/estado/{id}', 'cambiarEstado')->name('admin.petitions.estado');
});


