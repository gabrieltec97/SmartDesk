<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\CondominiosController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PacketController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect(route('login'));
});

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::resource('/usuarios', UserController::class);
Route::get('/verificar-email', [UserController::class, 'checkEmail']);

Route::resource('unidades', UnitController::class);
Route::resource('blocos', BlockController::class);
Route::resource('entregas', PacketController::class);
Route::resource('estoque', EstoqueController::class);
Route::resource('condominios', CondominiosController::class);
Route::resource('funcionarios', CondominiosController::class);
