<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LetraController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\TurnoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'logIn']);
Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('logout', [AuthController::class, 'logOut']);
});

Route::get('usuarios', [UserController::class, 'index']);
Route::get('user/id', [UserController::class, 'getUserIdFromToken']);

Route::get('sectores', [SectorController::class, 'index']);

Route::post('turnos', [TurnoController::class, 'store']);
Route::get('turnos', [TurnoController::class, 'index']);

Route::get('letras', [LetraController::class, 'index']);



