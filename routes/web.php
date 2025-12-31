<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\FacturesController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Acceuil');
});

#__________________Ressources_____________________

Route::resource('clients', ClientsController::class);
Route::resource('commandes', CommandesController::class);
Route::resource('factures', FacturesController::class);
