<?php

use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\Business\CommerceController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group([
    'prefix' => 'business',
    // 'middleware' => 'isActive',
], function ($router) {

    Route::get('/dashboard', [BusinessController::class, 'dashboard'])->name('business.dashboard');

    Route::get('/transactions', [BusinessController::class, 'transactions'])->name('business.paymentTrxs');

    Route::get('/settlements', [BusinessController::class, 'settlements'])->name('business.settlements');

    Route::get('/refunds', [BusinessController::class, 'refunds'])->name('business.refunds');

    Route::get('/disputes', [BusinessController::class, 'disputes'])->name('business.disputes');

    Route::get('/customers', [CommerceController::class, 'customers'])->name('business.customers');

    Route::get('/invoices', [CommerceController::class, 'invoices'])->name('business.invoices');

    Route::get('/payment-links', [CommerceController::class, 'paymentLinks'])->name('business.paymentLinks');

    Route::get('/utilities', [UtilityController::class, 'utilities'])->name('business.utilities');

    Route::get('/settings', [SettingsController::class, 'settings'])->name('business.settings');

});
