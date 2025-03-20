<?php
use App\Http\Controllers\Admin\ReportsController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'reports',
], function ($router) {

    Route::get('/auth', [ReportsController::class, 'authenticationReport'])->name('report.userAuths');

    Route::post('/searchUserAuths', [ReportsController::class, 'searchUserAuths'])->name('report.searchUserAuths');

    Route::get('/userauths/{et?}/{sd?}/{ed?}', [ReportsController::class, 'fetchUserAuths'])->name('report.fetchUserAuths');

    Route::get('/audit', [ReportsController::class, 'auditTrailReport'])->name('report.auditTrailReport');

    Route::post('/searchAuditTrails', [ReportsController::class, 'searchAuditTrails'])->name('report.searchAuditTrails');

    Route::get('/audittrails/{et?}/{sd?}/{ed?}', [ReportsController::class, 'fetchAuditTrails'])->name('report.fetchAuditTrails');

    Route::get('/terminals/{status?}', [ReportsController::class, 'terminals'])->name('report.terminals');

    Route::post('/searchTerminals', [ReportsController::class, 'searchTerminals'])->name('report.searchTerminals');

    Route::get('/fetchTerminals/{status?}/{sd?}/{ed?}', [ReportsController::class, 'fetchTerminals'])->name('report.fetchTerminals');

    Route::get('/pos/withdrawals/{status?}', [ReportsController::class, 'posWithdrawals'])->name('report.posWithdrawals');

    Route::post('/pos/searchPosWithdrawals', [ReportsController::class, 'searchPosWithdrawals'])->name('report.searchPosWithdrawals');

    Route::get('/post/fetchPosWithdrawals/{status?}/{sd?}/{ed?}', [ReportsController::class, 'fetchPosWithdrawals'])->name('report.fetchPosWithdrawals');

    Route::get('/utilities/{service?}', [ReportsController::class, 'utilityTrxs'])->name('report.utilityTrxs');

    Route::post('/utilities/searchUtilitiesTrx', [ReportsController::class, 'searchUtilitiesTrx'])->name('report.searchUtilitiesTrx');

    Route::get('/utilities/fetchUtilitiesTrx/{service?}/{sd?}/{ed?}', [ReportsController::class, 'fetchUtilitiesTrx'])->name('report.fetchUtilitiesTrx');

    Route::get('/customer/accounts', [ReportsController::class, 'customerAccounts'])->name('report.customerAccounts');

    Route::post('/customer/searchCustomers', [ReportsController::class, 'searchCustomers'])->name('report.searchCustomers');

    Route::get('/customer/fetchCustAccounts/{sd?}/{ed?}', [ReportsController::class, 'fetchCustAccounts'])->name('report.fetchCustAccounts');

    Route::get('/customer/businesses', [ReportsController::class, 'customerBusinesses'])->name('report.customerBusinesses');

    Route::post('/customer/searchBusiness', [ReportsController::class, 'searchBusiness'])->name('report.searchBusiness');

    Route::get('/customer/fetchCustBusiness/{id}', [ReportsController::class, 'fetchCustBusiness'])->name('report.fetchCustBusiness');

    Route::get('/customer/terminals', [ReportsController::class, 'customerTermimals'])->name('report.customerTermimals');

    Route::post('/customer/searchCustTerminals', [ReportsController::class, 'searchCustTerminals'])->name('report.searchCustTerminals');

    Route::get('/customer/fetchCustTerminals/{id?}', [ReportsController::class, 'fetchCustTerminals'])->name('report.fetchCustTerminals');

    Route::get('/transfers/{type?}', [ReportsController::class, 'customerTransfers'])->name('report.customerTransfers');

    Route::post('/searchTransfers', [ReportsController::class, 'searchTransfers'])->name('report.searchTransfers');

    Route::get('/fetchTransfers/{type?}/{sd?}/{ed?}', [ReportsController::class, 'fetchTransfers'])->name('report.fetchTransfers');

    Route::get('/endOfDay/{date?}', [ReportsController::class, 'endOfDay'])->name('report.endOfDay');

    Route::post('/searchEndOfDay', [ReportsController::class, 'searchEndOfDay'])->name('report.searchEndOfDay');

    Route::get('/fetchEndOfDay/{date?}', [ReportsController::class, 'fetchEndOfDay'])->name('report.fetchEndOfDay');

    Route::get('/endOfMonth/{month?}/{year?}', [ReportsController::class, 'endOfMonth'])->name('report.endOfMonth');

    Route::post('/searchEndOfMonth', [ReportsController::class, 'searchEndOfMonth'])->name('report.searchEndOfMonth');

    Route::get('/fetchEndOfMonth/{month?}/{year?}', [ReportsController::class, 'fetchEndOfMonth'])->name('report.fetchEndOfMonth');

    Route::get('/endOfYear/{year?}', [ReportsController::class, 'endOfYear'])->name('report.endOfYear');

    Route::post('/searchEndOfYear', [ReportsController::class, 'searchEndOfYear'])->name('report.searchEndOfYear');

    Route::get('/fetchEndOfYear/{year?}', [ReportsController::class, 'fetchEndOfYear'])->name('report.fetchEndOfYear');

});
