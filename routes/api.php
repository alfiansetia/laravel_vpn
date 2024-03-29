<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Mikapi\Hotspot\ActiveController;
use App\Http\Controllers\Api\Mikapi\Hotspot\BindingController;
use App\Http\Controllers\Api\Mikapi\Hotspot\HostController;
use App\Http\Controllers\Api\Mikapi\Hotspot\ProfileController;
use App\Http\Controllers\Api\Mikapi\Hotspot\ServerController;
use App\Http\Controllers\Api\Mikapi\Hotspot\ServerProfileController;
use App\Http\Controllers\Api\Mikapi\Hotspot\UserController as HotspotUserController;
use App\Http\Controllers\Api\Mikapi\InterfaceController;
use App\Http\Controllers\Api\Mikapi\LogController;
use App\Http\Controllers\Api\Mikapi\QueueController;
use App\Http\Controllers\Api\Mikapi\System\PackageController;
use App\Http\Controllers\Api\Mikapi\System\ResourceController;
use App\Http\Controllers\Api\Mikapi\System\RouterboardController;
use App\Http\Controllers\Api\Mikapi\System\UserController as SystemUserController;
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
    Route::put('profile', [UserController::class, 'profileUpdate']);
    Route::put('password', [UserController::class, 'passwordUpdate']);

    Route::group(['middleware' => ['verified']], function () {

        Route::apiResource('routers', RouterController::class);
        Route::get('routers/{routers}/ping', [RouterController::class, 'ping']);

        Route::apiResource('vpns', VpnController::class)->only(['index', 'show']);

        Route::apiResource('ports', PortController::class)->only(['show']);

        Route::apiResource('mikapi/hotspot/profiles', ProfileController::class)
            ->only(['index', 'show', 'store', 'update', 'destroy'])
            ->names('api.mikapi.hotspot.profiles');

        Route::apiResource('mikapi/hotspot/users', HotspotUserController::class)
            ->only(['index', 'show', 'store', 'update', 'destroy'])
            ->names('api.mikapi.hotspot.users');

        Route::apiResource('mikapi/hotspot/actives', ActiveController::class)
            ->only(['index', 'show', 'destroy'])
            ->names('api.mikapi.hotspot.actives');

        Route::apiResource('mikapi/hotspot/hosts', HostController::class)
            ->only(['index', 'show', 'destroy'])
            ->names('api.mikapi.hotspot.hosts');

        Route::apiResource('mikapi/hotspot/bindings', BindingController::class)
            ->only(['index', 'show', 'store', 'update', 'destroy'])
            ->names('api.mikapi.hotspot.bindings');

        Route::apiResource('mikapi/hotspot/servers', ServerController::class)
            ->only(['index', 'show', 'update'])
            ->names('api.mikapi.hotspot.servers');

        Route::apiResource('mikapi/hotspot/serverprofiles', ServerProfileController::class)
            ->only(['index', 'show', 'update'])
            ->names('api.mikapi.hotspot.serverprofiles');

        Route::apiResource('api/mikapi/queues', QueueController::class)
            ->only(['index', 'show', 'store', 'update', 'destroy'])
            ->names('api.mikapi.queues');

        Route::apiResource('mikapi/interfaces', InterfaceController::class)->only(['index', 'show', 'update']);

        Route::apiResource('mikapi/system/packages', PackageController::class)->only(['index', 'show']);
        Route::apiResource('mikapi/system/resources', ResourceController::class)->only(['index']);
        Route::apiResource('mikapi/system/routerboards', RouterboardController::class)->only(['index']);
        Route::apiResource('mikapi/system/users', SystemUserController::class)->only(['index']);

        Route::delete('mikapi/logs', [LogController::class, 'destroy'])->name('api.mikapi.logs.destroy');
        Route::apiResource('mikapi/logs', LogController::class)->only(['index', 'show'])->names('api.mikapi.logs');
    });
});
