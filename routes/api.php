<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BalanceHistoryController;
use App\Http\Controllers\Api\Mikapi\DashboardController;
use App\Http\Controllers\Api\Mikapi\DHCP\LeasesController as DHCPLeasesController;
use App\Http\Controllers\Api\Mikapi\Hotspot\ActiveController as HotspotActiveController;
use App\Http\Controllers\Api\Mikapi\Hotspot\BindingController as HotspotBindingController;
use App\Http\Controllers\Api\Mikapi\Hotspot\CookieController as HotspotCookieController;
use App\Http\Controllers\Api\Mikapi\Hotspot\HostController as HotspotHostController;
use App\Http\Controllers\Api\Mikapi\Hotspot\ProfileController as HotspotProfileController;
use App\Http\Controllers\Api\Mikapi\Hotspot\ServerController as HotspotServerController;
use App\Http\Controllers\Api\Mikapi\Hotspot\ServerProfileController as HotspotServerProfileController;
use App\Http\Controllers\Api\Mikapi\Hotspot\UserController as HotspotUserController;
use App\Http\Controllers\Api\Mikapi\InterfaceController;
use App\Http\Controllers\Api\Mikapi\LogController;
use App\Http\Controllers\Api\Mikapi\PPP\ActiveController as PPPActiveController;
use App\Http\Controllers\Api\Mikapi\PPP\L2tpSecretController as PPPL2tpSecretController;
use App\Http\Controllers\Api\Mikapi\PPP\ProfileController as PPPProfileController;
use App\Http\Controllers\Api\Mikapi\PPP\SecretController as PPPSecretController;
use App\Http\Controllers\Api\Mikapi\QueueController;
use App\Http\Controllers\Api\Mikapi\System\GroupController;
use App\Http\Controllers\Api\Mikapi\System\PackageController;
use App\Http\Controllers\Api\Mikapi\System\ResourceController;
use App\Http\Controllers\Api\Mikapi\System\RouterboardController;
use App\Http\Controllers\Api\Mikapi\System\UserActiveController;
use App\Http\Controllers\Api\Mikapi\System\UserController as SystemUserController;
use App\Http\Controllers\Api\PortController;
use App\Http\Controllers\Api\RouterController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VoucherTemplateController;
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

        Route::get('template', [VoucherTemplateController::class, 'index'])->name('api.template.index');

        Route::get('balance_history', [BalanceHistoryController::class, 'index'])->name('api.balance.index');

        Route::apiResource('routers', RouterController::class);
        Route::get('routers/{routers}/ping', [RouterController::class, 'ping']);

        Route::apiResource('vpns', VpnController::class)->only(['index', 'show'])->names('api.vpn');

        Route::apiResource('ports', PortController::class)->only(['show']);


        Route::get('mikapi/dashboard/get-data', [DashboardController::class, 'get'])->name('api.mikapi.dashboard.get');

        Route::apiResource('mikapi/hotspot/profiles', HotspotProfileController::class)
            ->only(['index', 'show', 'store', 'update', 'destroy'])
            ->names('api.mikapi.hotspot.profiles');
        Route::delete('mikapi/hotspot/profiles', [HotspotProfileController::class, 'destroy_batch'])
            ->name('api.mikapi.hotspot.profiles.destroy.batch');

        Route::apiResource('mikapi/hotspot/users', HotspotUserController::class)
            ->only(['index', 'show', 'store', 'update', 'destroy'])
            ->names('api.mikapi.hotspot.users');
        Route::delete('mikapi/hotspot/users', [HotspotUserController::class, 'destroy_batch'])
            ->name('api.mikapi.hotspot.users.destroy.batch');

        Route::apiResource('mikapi/hotspot/actives', HotspotActiveController::class)
            ->only(['index', 'show', 'destroy'])
            ->names('api.mikapi.hotspot.actives');
        Route::delete('mikapi/hotspot/actives', [HotspotActiveController::class, 'destroy_batch'])
            ->name('api.mikapi.hotspot.actives.destroy.batch');

        Route::apiResource('mikapi/hotspot/hosts', HotspotHostController::class)
            ->only(['index', 'show', 'destroy'])
            ->names('api.mikapi.hotspot.hosts');
        Route::delete('mikapi/hotspot/hosts', [HotspotHostController::class, 'destroy_batch'])
            ->name('api.mikapi.hotspot.hosts.destroy.batch');

        Route::apiResource('mikapi/hotspot/bindings', HotspotBindingController::class)
            ->only(['index', 'show', 'store', 'update', 'destroy'])
            ->names('api.mikapi.hotspot.bindings');
        Route::delete('mikapi/hotspot/bindings', [HotspotBindingController::class, 'destroy_batch'])
            ->name('api.mikapi.hotspot.bindings.destroy.batch');

        Route::apiResource('mikapi/hotspot/cookies', HotspotCookieController::class)
            ->only(['index', 'show', 'destroy'])
            ->names('api.mikapi.hotspot.cookies');
        Route::delete('mikapi/hotspot/cookies', [HotspotCookieController::class, 'destroy_batch'])
            ->name('api.mikapi.hotspot.cookies.destroy.batch');

        Route::apiResource('mikapi/hotspot/servers', HotspotServerController::class)
            ->only(['index', 'show', 'update'])
            ->names('api.mikapi.hotspot.servers');

        Route::apiResource('mikapi/hotspot/serverprofiles', HotspotServerProfileController::class)
            ->only(['index', 'show', 'update'])
            ->names('api.mikapi.hotspot.serverprofiles');

        Route::apiResource('api/mikapi/queues', QueueController::class)
            ->only(['index', 'show', 'store', 'update', 'destroy'])
            ->names('api.mikapi.queues');

        Route::apiResource('mikapi/ppp/profiles', PPPProfileController::class)
            ->only(['index', 'show', 'store', 'update', 'destroy'])
            ->names('api.mikapi.ppp.profiles');
        Route::delete('mikapi/ppp/profiles', [PPPProfileController::class, 'destroy_batch'])
            ->name('api.mikapi.ppp.profiles.destroy.batch');

        Route::apiResource('mikapi/ppp/secrets', PPPSecretController::class)
            ->only(['index', 'show', 'store', 'update', 'destroy'])
            ->names('api.mikapi.ppp.secrets');
        Route::delete('mikapi/ppp/secrets', [PPPSecretController::class, 'destroy_batch'])
            ->name('api.mikapi.ppp.secrets.destroy.batch');

        Route::apiResource('mikapi/ppp/actives', PPPActiveController::class)
            ->only(['index', 'show', 'destroy'])
            ->names('api.mikapi.ppp.actives');
        Route::delete('mikapi/ppp/actives', [PPPActiveController::class, 'destroy_batch'])
            ->name('api.mikapi.ppp.actives.destroy.batch');

        Route::apiResource('mikapi/ppp/l2tp_secrets', PPPL2tpSecretController::class)
            ->only(['index', 'show', 'store', 'update', 'destroy'])
            ->names('api.mikapi.ppp.l2tp_secrets');
        Route::delete('mikapi/ppp/l2tp_secrets', [PPPL2tpSecretController::class, 'destroy_batch'])
            ->name('api.mikapi.ppp.l2tp_secrets.destroy.batch');

        Route::apiResource('mikapi/dhcp/leases', DHCPLeasesController::class)
            ->only(['index', 'show', 'destroy'])
            ->names('api.mikapi.dhcp.leases');
        Route::delete('mikapi/dhcp/leases', [DHCPLeasesController::class, 'destroy_batch'])
            ->name('api.mikapi.dhcp.leases.destroy.batch');

        Route::get('mikapi/system/routerboards', [RouterboardController::class, 'index'])
            ->name('api.mikapi.system.routerboards.index');
        Route::get('mikapi/system/routerboards-settings', [RouterboardController::class, 'settings'])
            ->name('api.mikapi.system.routerboards.settings');

        Route::get('mikapi/system/resources', [ResourceController::class, 'index'])
            ->name('api.mikapi.system.resources.index');

        Route::get('mikapi/interfaces/{id}/monitor', [InterfaceController::class, 'monitor'])
            ->name('api.mikapi.interfaces.monitor');
        Route::apiResource('mikapi/interfaces', InterfaceController::class)
            ->only(['index', 'show'])
            ->names('api.mikapi.interfaces');

        Route::apiResource('mikapi/system/packages', PackageController::class)->only(['index', 'show']);

        Route::apiResource('mikapi/system/users', SystemUserController::class)
            ->only(['index', 'show', 'store', 'update', 'destroy'])->names('api.mikapi.system.users');
        Route::delete('mikapi/system/users', [SystemUserController::class, 'destroy_batch'])
            ->name('api.mikapi.system.users.destroy.batch');

        Route::apiResource('mikapi/system/groups', GroupController::class)
            ->only(['index', 'show', 'store', 'update', 'destroy'])
            ->names('api.mikapi.system.groups');
        Route::delete('mikapi/system/groups', [GroupController::class, 'destroy_batch'])
            ->name('api.mikapi.system.groups.destroy.batch');

        Route::apiResource('mikapi/system/user_actives', UserActiveController::class)
            ->only(['index', 'show'])
            ->names('api.mikapi.system.user_actives');

        Route::delete('mikapi/logs', [LogController::class, 'destroy'])->name('api.mikapi.logs.destroy');
        Route::apiResource('mikapi/logs', LogController::class)->only(['index', 'show'])->names('api.mikapi.logs');
    });
});
