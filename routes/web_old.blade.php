<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\WebhookController;
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
    'prefix'     => 'admin',
    'middleware' => 'isActive',
], function ($router) {

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/change-password', [HomeController::class, 'changePassword'])->name('admin.changePassword');

    Route::post('/update-password', [HomeController::class, 'updatePassword'])->name('admin.updatePassword');

    Route::get('/customers', [HomeController::class, 'customers'])->name('admin.customers');

    Route::get('/customers/businesses/{id}', [HomeController::class, 'customerBusinesses'])->name('admin.customerBusinesses');

    Route::post('/storeBusiness', [HomeController::class, 'storeBusiness'])->name('admin.storeBusiness');

    Route::post('/updateBusiness', [HomeController::class, 'updateBusiness'])->name('admin.updateBusiness');

    Route::post('/store-customer', [HomeController::class, 'storeCustomer'])->name('admin.storeCustomer');

    Route::post('/update-customer', [HomeController::class, 'updateCustomer'])->name('admin.updateCustomer');

    Route::post('/storeCustomFee', [HomeController::class, 'storeCustomFee'])->name('admin.storeCustomFee');

    Route::post('/updateCustomFee', [HomeController::class, 'updateCustomFee'])->name('admin.updateCustomFee');

    Route::get('/suspend-customer/{id}', [HomeController::class, 'suspendCustomer'])->name('admin.suspendCustomer');

    Route::get('/activate-customer/{id}', [HomeController::class, 'activateCustomer'])->name('admin.activateCustomer');

    Route::get('/account-types', [HomeController::class, 'accountTypes'])->name('admin.accountTypes');

    Route::post('/storeAccountType', [HomeController::class, 'storeAccountType'])->name('admin.storeAccountType');

    Route::post('/updateAccountType', [HomeController::class, 'updateAccountType'])->name('admin.updateAccountType');

    Route::get('/transfer-fees', [HomeController::class, 'transferFees'])->name('admin.transferFees');

    Route::post('/updateFeeAmount', [HomeController::class, 'updateFeeAmount'])->name('admin.updateFeeAmount');

    Route::get('/withdrawal-fees', [HomeController::class, 'withdrawalFees'])->name('admin.withdrawalFees');

    Route::get('/utility-fees', [HomeController::class, 'utilityFees'])->name('admin.utilityFees');

    Route::get('/utilities/transactions/{service}', [HomeController::class, 'utilityTransactions'])->name('admin.utilityTransactions');

    Route::post('/filterUtilityTrxs', [HomeController::class, 'filterUtilityTrxs'])->name('admin.filterUtilityTrxs');

    Route::get('/utilities/filterTrx/{service}/{sd}/{ed}', [HomeController::class, 'fetchUtilityTrxs'])->name('admin.fetchUtilityTrxs');

    Route::get('/reports', [ReportsController::class, 'index'])->name('admin.reports');

    Route::get('/customer-disputes', [HomeController::class, 'customerDisputes'])->name('admin.customerDisputes');

    Route::post('/closeDispute', [HomeController::class, 'closeDispute'])->name('admin.closeDispute');

    Route::get('/customer-tickets', [HomeController::class, 'customerTickets'])->name('admin.customerTickets');

    Route::post('/closeTicket', [HomeController::class, 'closeTicket'])->name('admin.closeTicket');

    Route::get('/terminals', [HomeController::class, 'terminals'])->name('admin.terminals');

    Route::post('/filterTerminals', [HomeController::class, 'filterTerminals'])->name('admin.filterTerminals');

    Route::get('/terminals/{status}', [HomeController::class, 'fetchTerminals'])->name('admin.fetchTerminals');

    Route::post('/storeTerminal', [HomeController::class, 'storeTerminal'])->name('admin.storeTerminal');

    Route::post('/updateTerminal', [HomeController::class, 'updateTerminal'])->name('admin.updateTerminal');

    Route::get('/deactivate-terminal/{id}', [HomeController::class, 'deactivateTerminal'])->name('admin.deactivateTerminal');

    Route::get('/activate-terminal/{id}', [HomeController::class, 'activateTerminal'])->name('admin.activateTerminal');

    Route::get('/business/release-terminal/{id}', [HomeController::class, 'releaseTerminal'])->name('admin.releaseTerminal');

    Route::post('assignTerminal', [HomeController::class, 'assignTerminal'])->name('admin.assignTerminal');

    Route::get('/pos/withdrawals', [HomeController::class, 'posWithdrawals'])->name('admin.posWithdrawals');

    Route::post('/filterWithdrawals', [HomeController::class, 'filterWithdrawals'])->name('admin.filterWithdrawals');

    Route::get('/fetchWithdrawals/{sd}/{ed}', [HomeController::class, 'fetchWithdrawals'])->name('admin.fetchWithdrawals');

    Route::get('/platform-features', [HomeController::class, 'platformFeatures'])->name('admin.platformFeatures');

    Route::get('/user-roles', [HomeController::class, 'manageRoles'])->name('admin.manageRoles');

    Route::post('/store-role', [HomeController::class, 'storeRole'])->name('admin.storeRole');

    Route::post('/update-role', [HomeController::class, 'updateRole'])->name('admin.updateRole');

    Route::get('/role-permissions/{id}', [HomeController::class, 'managePermissions'])->name('admin.managePermissions');

    Route::get('/grant-feature-permission/{role}/{feature}', [HomeController::class, 'grantFeaturePermission'])->name('admin.grantFeaturePermission');

    Route::get('/revoke-feature-permission/{role}/{feature}', [HomeController::class, 'revokeFeaturePermission'])->name('admin.revokeFeaturePermission');

    Route::get('/grant-create-permission/{role}/{feature}', [HomeController::class, 'grantCreatePermission'])->name('admin.grantCreatePermission');

    Route::get('/revoke-create-permission/{role}/{feature}', [HomeController::class, 'revokeCreatePermission'])->name('admin.revokeCreatePermission');

    Route::get('/grant-edit-permission/{role}/{feature}', [HomeController::class, 'grantEditPermission'])->name('admin.grantEditPermission');

    Route::get('/revoke-edit-permission/{role}/{feature}', [HomeController::class, 'revokeEditPermission'])->name('admin.revokeEditPermission');

    Route::get('/grant-delete-permission/{role}/{feature}', [HomeController::class, 'grantDeletePermission'])->name('admin.grantDeletePermission');

    Route::get('/revoke-delete-permission/{role}/{feature}', [HomeController::class, 'revokeDeletePermission'])->name('admin.revokeDeletePermission');

    Route::get('/administrators', [HomeController::class, 'administrators'])->name('admin.administrators');

    Route::post('/store-admin', [HomeController::class, 'storeAdmin'])->name('admin.storeAdmin');

    Route::post('/update-admin', [HomeController::class, 'updateAdmin'])->name('admin.updateAdmin');

    Route::get('/suspend-admin/{id}', [HomeController::class, 'suspendAdmin'])->name('admin.suspendAdmin');

    Route::get('/activate-admin/{id}', [HomeController::class, 'activateAdmin'])->name('admin.activateAdmin');

    Route::get('/businesses', [HomeController::class, 'businesses'])->name('admin.businesses');

    Route::get('/transfers/transactions/{category}', [HomeController::class, 'transfers'])->name('admin.transferTransactions');

    Route::post('/filterTransferTrxs', [HomeController::class, 'filterTransferTrxs'])->name('admin.filterTransferTrxs');

    Route::get('/transfers/filterTrx/{category}/{sd}/{ed}', [HomeController::class, 'fetchTransferTrxs'])->name('admin.fetchTransferTrxs');

    Route::get('/utility/requery/{id}', [HomeController::class, 'requeryUtilityTransaction'])->name('admin.requeryUtility');
    Route::get('/transfer/requery/{id}', [HomeController::class, 'requeryTransferTransaction'])->name('admin.requeryTrfTrans');
    Route::get('/posTrans/requery/{id}', [HomeController::class, 'requeryPOSTransaction'])->name('admin.requeryPOSTrans');
});

Route::group([
    'prefix' => 'webhook',
], function ($router) {
    Route::post('/translite', [WebhookController::class, 'transliteNotification'])->middleware("eat");
    Route::post('/bankone', [WebhookController::class, 'bankOneNotification']);
});

require __DIR__ . '/reports.php';
require __DIR__ . '/workers.php';
