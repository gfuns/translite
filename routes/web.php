<?php

use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Business\CommerceController;
use App\Http\Controllers\Business\KYCController;
use App\Http\Controllers\Business\LogsController;
use App\Http\Controllers\Business\PaymentController;
use App\Http\Controllers\Business\POSController;
use App\Http\Controllers\Business\SettingsController;
use App\Http\Controllers\Business\UtilityController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/gateway', function () {
    return view('gateway');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'business',
    // 'middleware' => 'isActive',
], function ($router) {

    Route::get('/dashboard', [BusinessController::class, 'dashboard'])->name('business.dashboard');

    Route::get('/transactions', [PaymentController::class, 'transactions'])->name('business.paymentTrxs');

    Route::get('/settlements', [PaymentController::class, 'settlements'])->name('business.settlements');

    Route::get('/refunds', [PaymentController::class, 'refunds'])->name('business.refunds');

    Route::get('/disputes', [PaymentController::class, 'disputes'])->name('business.disputes');

    Route::get('/customers', [CommerceController::class, 'customers'])->name('business.customers');

    Route::get('/invoices', [CommerceController::class, 'invoices'])->name('business.invoices');

    Route::get('/payment-links', [CommerceController::class, 'paymentLinks'])->name('business.paymentLinks');

    Route::get('/utilities', [UtilityController::class, 'utilities'])->name('business.utilities');

    Route::get('/webhook-logs', [LogsController::class, 'webhookLogs'])->name('business.webhookLogs');

    Route::get('/xtrapay-pos', [POSController::class, 'xtrapayPos'])->name('business.pos.terminals');

    Route::get('/xtrapay-pos/branches', [POSController::class, 'branches'])->name('business.pos.branches');

    Route::get('/xtrapay-pos/requests', [POSController::class, 'requests'])->name('business.pos.requests');

    Route::get('/settings', [SettingsController::class, 'settings'])->name('business.settings');

    Route::get('/settings/profile', [SettingsController::class, 'userProfile'])->name('business.settings.profile');

    Route::get('/settings/keys', [SettingsController::class, 'apiKeys'])->name('business.settings.apiKeys');

    Route::get('/settings/webhooks', [SettingsController::class, 'webhooks'])->name('business.settings.webhooks');

    Route::get('/settings/settlement', [SettingsController::class, 'settlements'])->name('business.settings.settlement');

    Route::get('/settings/settlement/services', [SettingsController::class, 'dynamicSettlement'])->name('business.settings.dynamicSettlement');

    Route::get('/settings/settlement/accounts', [SettingsController::class, 'settlementAccounts'])->name('business.settings.settlementAccounts');

    Route::get('/settings/type', [SettingsController::class, 'businessType'])->name('business.settings.businessType');

    Route::get('/settings/about', [SettingsController::class, 'businessDetails'])->name('business.settings.about');

    Route::post('/settings/update-logo', [SettingsController::class, 'updateLogo'])->name('business.logo.change');

    Route::get('/settings/documents', [SettingsController::class, 'businessDocuments'])->name('business.settings.bizDocuments');

    Route::get('/settings/notifications', [SettingsController::class, 'notificationSettings'])->name('business.settings.notifSettings');

    Route::get('/settings/representatives', [SettingsController::class, 'businessRepresentatives'])->name('business.settings.bizReps');

    Route::get('/settings/payments', [SettingsController::class, 'paymentSettings'])->name('business.settings.paymentSettings');

    Route::get('/kyc/application', [KYCController::class, 'kycApplication'])->name('business.kyc.apply');
});
