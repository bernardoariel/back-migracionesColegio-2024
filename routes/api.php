<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EscribanoController;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 */

Route::post('auth/register',[AuthController::class, 'create']);
Route::post('auth/login',[AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('auth/regenerate-user', [AuthController::class, 'regenerateUser']);
    Route::get('auth/logout', [AuthController::class, 'logout']);
});
Route::get('/conditions', [ConditionController::class, 'index'])->name('conditions.index');
Route::get('/conditions/{id}', [ConditionController::class, 'show'])->name('conditions.show');

Route::get('/users',[UserController::class, 'index']);
Route::get('/user/{id}',[UserController::class,'show']);

Route::get('/escribanos', [EscribanoController::class, 'index'])->name('escribanos.index');
Route::get('/escribanos/{id}', [EscribanoController::class, 'show'])->name('escribanos.show');
