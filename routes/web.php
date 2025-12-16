<?php

use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')
    ->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('admin')
    ->controller(\App\Http\Controllers\Admin\AdminPetitionsController::class)
    ->group(function () {
    //Route::get('admin', 'index')->name('admin.home');
    Route::get('admin/petitions/index', 'index')->name('admin.petitions.index');
    Route::get('admin/petitions/{id}', 'show')->name('admin.petitions.show');
    Route::get('admin/petition/add', 'create')->name('admin.petitions.create');
    Route::get('admin/petitions/edit/{id}', 'edit')->name('admin.petitions.edit');
    Route::post('admin/petitions', 'store')->name('admin.petitions.store');
    Route::delete('admin/petitions/{id}', 'delete')->name('admin.petitions.delete');
    Route::put('admin/petitions/{id}', 'update')->name('admin.petitions.update');
    Route::put('admin/petitions/status/{id}', 'changeStatus')->name('admin.petitions.status');
});
Route::middleware('admin')
    ->controller(\App\Http\Controllers\Admin\AdminCategoriesController::class)
    ->group(function () {
        Route::get('admin/categories/index', 'index')->name('admin.categories.index');
        Route::get('admin/categories/add', 'create')->name('admin.categories.create');
        Route::post('admin/categories', 'store')->name('admin.categories.store');
        Route::get('admin/categories/{id}', 'show')->name('admin.categories.show');
        Route::get('admin/categories/edit/{id}', 'edit')->name('admin.categories.edit');
        Route::put('admin/categories/{id}', 'update')->name('admin.categories.update');
        Route::delete('admin/categories/{id}', 'delete')->name('admin.categories.delete');
    });


Route::middleware('admin')
    ->controller(AdminUsersController::class)
    ->group(function () {
        Route::get('admin/users/index', 'index')->name('admin.users.index');
        Route::get('admin/users/add', 'create')->name('admin.users.create');
        Route::get('admin/users/{id}', 'show')->name('admin.users.show');
        Route::get('admin/users/edit/{id}', 'edit')->name('admin.users.edit');
        Route::post('admin/users', 'store')->name('admin.users.store');
        Route::delete('admin/users/{id}', 'delete')->name('admin.users.delete');
        Route::put('admin/users/{id}', 'update')->name('admin.users.update');
    });


require __DIR__ . '/auth.php';


use App\Http\Controllers\PagesController;
use App\Http\Controllers\PetitionController;

Route::get('/', [PagesController::class, 'home'])->name('home');

Route::controller(\App\Http\Controllers\PetitionController::class)
    ->group(function () {
    Route::get('petitions/index', 'index')->name('petitions.index');
    Route::get('petitions/{id}', 'show')->name('petitions.show');
    Route::get('mypetitions', [PetitionController::class, 'listMine'])
        ->name('petitions.mine')
        ->middleware('auth');
    Route::post('petitions/sign/{id}', 'sign')->name('petitions.sign')->middleware('auth');
    Route::get('petition/add', [PetitionController::class, 'create'])->name('petitions.create')->middleware('auth');
    Route::post('petition', [PetitionController::class, 'store'])->name('petitions.store')->middleware('auth');
    Route::get('signedPetitions', [PetitionController::class, 'signedPetitions'])->name('petitions.signedPetitions')->middleware('auth');
    Route::delete('petitions/{id}', 'delete')->name('petitions.delete');
    Route::get('petitions/edit/{id}', 'EDIT')->name('petitions.edit');
    Route::put('petitions/{id}', 'update')->name('petitions.update');
});



