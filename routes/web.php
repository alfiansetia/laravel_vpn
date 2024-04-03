<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DatabaseBackupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Mikapi\DashboardController;
use App\Http\Controllers\Mikapi\DHCPController;
use App\Http\Controllers\Mikapi\HotspotController;
use App\Http\Controllers\Mikapi\LogController;
use App\Http\Controllers\Mikapi\PPPController;
use App\Http\Controllers\Mikapi\SystemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ToolController;
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
    'register' => true,
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

    Route::group(['middleware' => ['is.active']], function () {

        Route::get('mikapi/dashboard/get-data', [DashboardController::class, 'getData'])->name('mikapi.dashboard.get.data');
        Route::get('mikapi/dashboard', [DashboardController::class, 'index'])->name('mikapi.dashboard');

        Route::get('mikapi/system/routerboard', [SystemController::class, 'routerboard'])->name('mikapi.system.routerboard');
        Route::get('mikapi/system/resource', [SystemController::class, 'resource'])->name('mikapi.system.resource');

        Route::get('mikapi/log', [LogController::class, 'index'])->name('mikapi.log.index');
        Route::get('mikapi/hotspot/server', [HotspotController::class, 'server'])->name('mikapi.hotspot.server');
        Route::get('mikapi/hotspot/profile', [HotspotController::class, 'profile'])->name('mikapi.hotspot.profile');
        Route::get('mikapi/hotspot/user', [HotspotController::class, 'user'])->name('mikapi.hotspot.user');
        Route::get('mikapi/hotspot/active', [HotspotController::class, 'active'])->name('mikapi.hotspot.active');
        Route::get('mikapi/hotspot/host', [HotspotController::class, 'host'])->name('mikapi.hotspot.host');
        Route::get('mikapi/hotspot/binding', [HotspotController::class, 'binding'])->name('mikapi.hotspot.binding');
        Route::get('mikapi/hotspot/cookie', [HotspotController::class, 'cookie'])->name('mikapi.hotspot.cookie');

        Route::get('mikapi/ppp/profile', [PPPController::class, 'profile'])->name('mikapi.ppp.profile');
        Route::get('mikapi/ppp/secret', [PPPController::class, 'secret'])->name('mikapi.ppp.secret');
        Route::get('mikapi/ppp/active', [PPPController::class, 'active'])->name('mikapi.ppp.active');
        Route::get('mikapi/ppp/l2tp_secret', [PPPController::class, 'l2tp_secret'])->name('mikapi.ppp.l2tp_secret');

        Route::get('mikapi/dhcp/lease', [DHCPController::class, 'lease'])->name('mikapi.dhcp.lease');

        // Profile
        Route::get('setting/profile', [ProfileController::class, 'profile'])->name('setting.profile');
        Route::get('setting/profile/general', [ProfileController::class, 'profileEdit'])->name('setting.profile.edit');
        Route::post('setting/profile/general', [ProfileController::class, 'profileUpdate'])->name('setting.profile.update');

        Route::get('setting/profile/social/', [ProfileController::class, 'social'])->name('setting.profile.social');
        Route::post('setting/profile/social/', [ProfileController::class, 'socialUpdate'])->name('setting.profile.social.update');

        Route::get('setting/profile/password', [ProfileController::class, 'password'])->name('setting.profile.password');
        Route::post('setting/profile/password', [ProfileController::class, 'passwordUpdate'])->name('setting.profile.password.update');


        Route::post('vpn-autocreate', [VpnController::class, 'autoCreate'])->name('vpn.autocreate');
        Route::get('port-getbyuser', [PortController::class, 'getByUser'])->name('port.getbyuser');
        Route::resource('vpn', VpnController::class)->only(['create', 'index', 'show']);

        Route::delete('router-batch', [RouterController::class, 'destroyBatch'])->name('router.destroy.batch');
        Route::get('router-open', [RouterController::class, 'open'])->name('router.open');
        Route::get('router/{router}/ping', [RouterController::class, 'ping'])->name('router.ping');
        Route::resource('router', RouterController::class)->except(['edit', 'create']);

        Route::resource('invoice', InvoiceController::class)->only(['index', 'show']);

        Route::group(['middleware' => ['is.admin']], function () {

            Route::resource('invoice', InvoiceController::class)->only(['store', 'update', 'destroy',]);

            Route::get('user-paginate', [UserController::class, 'paginate'])->name('user.paginate');
            Route::delete('user-batch', [UserController::class, 'destroyBatch'])->name('user.destroy.batch');
            Route::resource('user', UserController::class)->except(['edit', 'create']);

            Route::get('vpn-paginate', [VpnController::class, 'paginate'])->name('vpn.paginate');
            Route::get('vpn/{vpn}/analyze', [VpnController::class, 'analyze'])->name('vpn.analyze');
            Route::post('vpn/{vpn}/send-email', [VpnController::class, 'sendEmail'])->name('vpn.send.email');
            Route::delete('vpn-batch', [VpnController::class, 'destroyBatch'])->name('vpn.destroy.batch');
            Route::resource('vpn', VpnController::class)->only(['store', 'update', 'destroy']);

            Route::get('server-paginate', [ServerController::class, 'paginate'])->name('server.paginate');
            Route::delete('server-batch', [ServerController::class, 'destroyBatch'])->name('server.destroy.batch');
            Route::get('server/{server}/ping', [ServerController::class, 'ping'])->name('server.ping');
            Route::resource('server', ServerController::class)->except(['edit', 'create']);

            Route::get('port-paginate', [PortController::class, 'paginate'])->name('port.paginate');
            Route::delete('port-batch', [PortController::class, 'destroyBatch'])->name('port.destroy.batch');
            Route::resource('port', PortController::class)->except(['edit', 'create']);

            Route::get('bank-paginate', [BankController::class, 'paginate'])->name('bank.paginate');
            Route::delete('bank-batch', [BankController::class, 'destroyBatch'])->name('bank.destroy.batch');
            Route::resource('bank', BankController::class)->except(['edit', 'create']);


            // Company
            Route::get('setting/company/general', [CompanyController::class, 'general'])->name('setting.company.general');
            Route::post('setting/company/general', [CompanyController::class, 'generalUpdate'])->name('setting.company.general.update');

            Route::get('setting/company/image', [CompanyController::class, 'image'])->name('setting.company.image');
            Route::post('setting/company/image', [CompanyController::class, 'imageUpdate'])->name('setting.company.image.update');

            Route::get('setting/company/social', [CompanyController::class, 'social'])->name('setting.company.social');
            Route::post('setting/company/social', [CompanyController::class, 'socialUpdate'])->name('setting.company.social.update');

            Route::get('setting/company/telegram', [SettingController::class, 'telegram'])->name('setting.company.telegram');
            Route::post('setting/company/telegram', [SettingController::class, 'telegramUpdate'])->name('setting.company.telegram.update');
            Route::put('setting/company/telegram', [SettingController::class, 'telegramSet'])->name('setting.company.telegram.set');

            Route::get('setting/company/backup', [SettingController::class, 'backup'])->name('setting.company.backup');

            Route::delete('database-batch', [DatabaseBackupController::class, 'destroyBatch'])->name('database.destroy.batch');
            Route::get('database-detail/{file}', [DatabaseBackupController::class, 'download'])->name('database.download');
            Route::get('database', [DatabaseBackupController::class, 'index'])->name('database.index');
            Route::post('database', [DatabaseBackupController::class, 'store'])->name('database.store');
            Route::delete('database/{file}', [DatabaseBackupController::class, 'destroy'])->name('database.destroy');

            Route::get('tools/phpinfo', [ToolController::class, 'php_info'])->name('tool.phpinfo');
        });
    });
});
