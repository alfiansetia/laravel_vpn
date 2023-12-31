<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Mikapi\DashboardController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VpnController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes([
    'verify' => true,
    'register' => false,
]);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/auth/facebook/redirect', [LoginController::class, 'redirectToProviderFb'])->name('auth.fb.redirect');
Route::get('/auth/facebook/callback', [LoginController::class, 'handleProviderCallbackFb'])->name('auth.fb.callback');

Route::get('/auth/redirect', [LoginController::class, 'redirectToProvider'])->name('auth.redirect');
Route::get('/auth/callback', [LoginController::class, 'handleProviderCallback'])->name('auth.callback');

Route::post('/auth/onetap', [LoginController::class, 'onetap'])->name('auth.onetap');

Route::group(['middleware' => ['auth', 'verified']], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::delete('user/batch', [UserController::class, 'destroyBatch'])->name('user.destroy.batch');
    Route::resource('user', UserController::class)->except(['edit', 'create']);

    Route::delete('vpn/batch', [VpnController::class, 'destroyBatch'])->name('vpn.destroy.batch');
    Route::post('vpn/autocreate', [VpnController::class, 'autoCreate'])->name('vpn.autocreate');
    Route::resource('vpn', VpnController::class)->except(['edit']);

    Route::delete('server/batch', [ServerController::class, 'destroyBatch'])->name('server.destroy.batch');
    Route::get('server/{server}/ping', [ServerController::class, 'ping'])->name('server.ping');
    Route::resource('server', ServerController::class)->except(['edit', 'create']);

    Route::get('port/getbyuser', [PortController::class, 'getByUser'])->name('port.getbyuser');
    Route::delete('port/batch', [PortController::class, 'destroyBatch'])->name('port.destroy.batch');
    Route::resource('port', PortController::class)->except(['edit', 'create']);

    Route::resource('bill', UserController::class)->except(['edit', 'destroy']);
    Route::resource('bank', UserController::class)->except(['edit', 'destroy']);

    Route::delete('router/batch', [RouterController::class, 'destroyBatch'])->name('router.destroy.batch');
    Route::get('router/open', [RouterController::class, 'open'])->name('router.open');
    Route::get('router/ping', [RouterController::class, 'ping'])->name('router.ping');
    Route::resource('router', RouterController::class)->except(['edit', 'create']);

    Route::get('setting/profile', [SettingController::class, 'profile'])->name('setting.profile');
    Route::post('setting/profile', [SettingController::class, 'profileUpdate'])->name('setting.profile.update');

    Route::get('setting/password', [SettingController::class, 'password'])->name('setting.password');
    Route::post('setting/password', [SettingController::class, 'passwordUpdate'])->name('setting.password.update');

    Route::get('setting/company', [SettingController::class, 'company'])->name('setting.company');
    Route::post('setting/company', [SettingController::class, 'companyUpdate'])->name('setting.company.update');

    Route::get('setting/telegram', [SettingController::class, 'telegram'])->name('setting.telegram');
    Route::post('setting/telegram', [SettingController::class, 'telegramUpdate'])->name('setting.telegram.update');
    Route::put('setting/telegram', [SettingController::class, 'telegramSet'])->name('setting.telegram.set');

    Route::get('setting/backup', [SettingController::class, 'backup'])->name('setting.backup');

    Route::get('mikapi/dashboard', [DashboardController::class, 'index'])->name('mikapi.dashboard');
});
