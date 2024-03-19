<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DatabaseBackupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Mikapi\DashboardController;
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
Route::get('tes', function () {
    return view('tes');
});

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

        Route::resource('invoice', InvoiceController::class)->only(['index', 'show', 'store', 'update', 'destroy',]);

        Route::get('user/paginate', [UserController::class, 'paginate'])->name('user.paginate');
        Route::delete('user/batch', [UserController::class, 'destroyBatch'])->name('user.destroy.batch');
        Route::resource('user', UserController::class)->except(['edit', 'create']);

        Route::get('vpn/{vpn}/analyze', [VpnController::class, 'analyze'])->name('vpn.analyze');
        Route::post('vpn/{vpn}/send-email', [VpnController::class, 'sendEmail'])->name('vpn.send.email');
        Route::get('vpn/paginate', [VpnController::class, 'paginate'])->name('vpn.paginate');
        Route::delete('vpn/batch', [VpnController::class, 'destroyBatch'])->name('vpn.destroy.batch');
        Route::post('vpn/autocreate', [VpnController::class, 'autoCreate'])->name('vpn.autocreate');
        Route::resource('vpn', VpnController::class)->except(['edit']);

        Route::get('server/paginate', [ServerController::class, 'paginate'])->name('server.paginate');
        Route::delete('server/batch', [ServerController::class, 'destroyBatch'])->name('server.destroy.batch');
        Route::get('server/{server}/ping', [ServerController::class, 'ping'])->name('server.ping');
        Route::resource('server', ServerController::class)->except(['edit', 'create']);

        Route::get('port/paginate', [PortController::class, 'paginate'])->name('port.paginate');
        Route::get('port/getbyuser', [PortController::class, 'getByUser'])->name('port.getbyuser');
        Route::delete('port/batch', [PortController::class, 'destroyBatch'])->name('port.destroy.batch');
        Route::resource('port', PortController::class)->except(['edit', 'create']);

        Route::delete('bank/batch', [BankController::class, 'destroyBatch'])->name('bank.destroy.batch');
        Route::resource('bank', BankController::class)->except(['edit', 'create']);

        Route::delete('router/batch', [RouterController::class, 'destroyBatch'])->name('router.destroy.batch');
        Route::get('router/open', [RouterController::class, 'open'])->name('router.open');
        Route::get('router/ping', [RouterController::class, 'ping'])->name('router.ping');
        Route::resource('router', RouterController::class)->except(['edit', 'create']);

        // Profile
        Route::get('setting/profile', [ProfileController::class, 'profile'])->name('setting.profile');
        Route::get('setting/profile/general', [ProfileController::class, 'profileEdit'])->name('setting.profile.edit');
        Route::post('setting/profile/general', [ProfileController::class, 'profileUpdate'])->name('setting.profile.update');

        Route::get('setting/profile/social/', [ProfileController::class, 'social'])->name('setting.profile.social');
        Route::post('setting/profile/social/', [ProfileController::class, 'socialUpdate'])->name('setting.profile.social.update');

        Route::get('setting/profile/password', [ProfileController::class, 'password'])->name('setting.profile.password');
        Route::post('setting/profile/password', [ProfileController::class, 'passwordUpdate'])->name('setting.profile.password.update');

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

        Route::get('mikapi/dashboard', [DashboardController::class, 'index'])->name('mikapi.dashboard');


        Route::delete('database/batch', [DatabaseBackupController::class, 'destroyBatch'])->name('database.destroy.batch');
        Route::get('database/detail/{file}', [DatabaseBackupController::class, 'download'])->name('database.download');
        Route::get('database', [DatabaseBackupController::class, 'index'])->name('database.index');
        Route::post('database', [DatabaseBackupController::class, 'store'])->name('database.store');
        Route::delete('database/{file}', [DatabaseBackupController::class, 'destroy'])->name('database.destroy');

        Route::get('tools/phpinfo', [ToolController::class, 'php_info'])->name('tool.phpinfo');
    });
});
