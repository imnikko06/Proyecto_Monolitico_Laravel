<?php
//Basicamente el index.js que va a mandar las acciones, en este caso simplemente
//Devuelven las vistas en el PagesController que se encarga de tener funciones
//de retorno de vista
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PetitionController;

Route::get('/', [PagesController::class, 'home']);
Route::get('/', [\App\Http\Controllers\PagesController::class, 'home'])->name('home');
Route::get('/users/firmas', [\App\Http\Controllers\UserController::class, 'peticionesFirmadas'])->middleware('auth');

Route::controller(\App\Http\Controllers\PetitionController::class)->group(function () {
    Route::get('petitions/index', 'index')->name('petitions.index');
    Route::get('petitions/{id}', 'show')->name('petitions.show');

    Route::get('mispeticiones', 'listMine')->name('petitions.mine');
    Route::get('peticionesfirmadas', 'peticionesFirmadas')->name('petitions.peticionesfirmadas');
    Route::get('peticion/add', 'create')->name('petitions.create');
    Route::post('peticion', 'store')->name('petitions.store');
    Route::delete('peticiones/{id}', 'delete')->name('petitions.delete');
    Route::put('peticiones/{id}', 'update')->name('petitions.update');
    Route::post('peticiones/firmar/{id}', 'firmar')->name('petitions.firmar');
    Route::get('peticiones/edit/{id}', 'update')->name('petitions.edit');
});
