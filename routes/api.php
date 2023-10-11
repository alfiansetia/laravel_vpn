<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PortController;
use App\Http\Controllers\Api\RouterController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VpnController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::post('/telegram/{token}/webhook', [TelegramController::class, 'handle'])->name('telegram.handle');

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('profile', [UserController::class, 'profile']);
    Route::post('profile', [UserController::class, 'profileUpdate']);

    Route::apiResource('routers', RouterController::class);
    Route::get('routers/{routers}/ping', [RouterController::class, 'ping']);

    Route::apiResource('vpns', VpnController::class)->only(['index', 'show']);

    Route::apiResource('ports', PortController::class)->only(['show']);
});
