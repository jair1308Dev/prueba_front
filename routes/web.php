<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoctelController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Ruta de home protegida por autenticación
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('auth');

// Rutas de coctel protegidas por autenticación
Route::get('/coctel/detalle/{id}', [CoctelController::class, 'detalle'])
    ->middleware('auth');

Route::post('/coctel/guardar/{id}', [CoctelController::class, 'guardar'])
    ->middleware('auth');

Route::get('/cocteles/favoritos', [CoctelController::class, 'obtenerFavoritos'])
    ->middleware('auth');

Route::put('/cocteles-favoritos/{id}', [CoctelController::class, 'update']);
Route::delete('/cocteles-favoritos/{id}', [CoctelController::class, 'destroy']);
    

Route::get('/favoritos', [CoctelController::class, 'viewFavoritos'])
    ->name('favoritos')
    ->middleware('auth');
