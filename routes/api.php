<?php

use App\Http\Controllers\Mobile\AuthenticationController;
use App\Http\Controllers\Mobile\BeneficiaryController;
use App\Http\Controllers\Mobile\BusinessController;
use App\Http\Controllers\Mobile\DisputeController;
use App\Http\Controllers\Mobile\EODController;
use App\Http\Controllers\Mobile\GeneralSettingsController;
use App\Http\Controllers\Mobile\SupportController;
use App\Http\Controllers\Mobile\TransferController;
use App\Http\Controllers\Mobile\UtilityBillsController;
use App\Http\Controllers\Mobile\WithdrawalController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => ['api'],
    'prefix'     => 'v1',

], function ($router) {

    Route::group([
        'prefix' => 'settings',
    ], function ($router) {
        Route::get('/authorization-key', [GeneralSettingsController::class, 'getApplicationKey']);
    });

    Route::group([
        'middleware' => ['validatemobilekey'],
    ], function ($router) {

        Route::post('/login', [AuthenticationController::class, 'login']);

        Route::group([
            'middleware' => ['mobileauthenticated'],
        ], function () {
            Route::post('/logout', [AuthenticationController::class, 'logout']);
            Route::post('/changeDefaultPassword', [AuthenticationController::class, 'changeDefaultPassword']);
            Route::post('/createTransactionPIN', [AuthenticationController::class, 'createTransactionPIN']);

            Route::group([
                'prefix'     => 'agent',
                'middleware' => ['pincreated'],
            ], function () {
                Route::get('/dashboard', [BusinessController::class, 'agentDashboard']);
                Route::get('/accountDetails', [BusinessController::class, 'accountDetails']);
                Route::get('/balanceEnquiry', [BusinessController::class, 'balanceEnquiry']);
                Route::get('/profile', [BusinessController::class, 'agentProfile']);
                Route::post('/validateCurrentPassword', [BusinessController::class, 'validateCurrentPassword']);
                Route::post('/updatePassword', [BusinessController::class, 'updatePassword']);
                Route::post('/validateCurrentPIN', [BusinessController::class, 'validateCurrentPIN']);
                Route::post('/updatePIN', [BusinessController::class, 'updatePIN']);
                Route::get('/trxHistory', [BusinessController::class, 'transactionHistory']);
                Route::get('/notifications', [BusinessController::class, 'notifications']);
                Route::get('/notification/{id}', [BusinessController::class, 'readNotification']);

                Route::group([
                    'prefix' => 'bills',
                ], function () {
                    Route::get('/getBillTypes', [UtilityBillsController::class, 'getBillTypes']);
                    Route::get('/getPowerProviders', [UtilityBillsController::class, 'getPowerProviders']);
                    Route::get('/getMeterInfo', [UtilityBillsController::class, 'getMeterInfo']);
                    Route::post('/vendPower', [UtilityBillsController::class, 'vendPower']);
                    Route::get('/getAirtimeProviders', [UtilityBillsController::class, 'getAirtimeProviders']);
                    Route::post('/vendAirtime', [UtilityBillsController::class, 'vendAirtime']);
                    Route::get('/getDataProviders', [UtilityBillsController::class, 'getDataProviders']);
                    Route::get('/getDataBundles', [UtilityBillsController::class, 'getDataBundles']);
                    Route::post('/vendData', [UtilityBillsController::class, 'vendData']);
                    Route::get('/getTvProviders', [UtilityBillsController::class, 'getTvProviders']);
                    Route::get('/getTvBouquets', [UtilityBillsController::class, 'getTvBouquets']);
                    Route::get('/getSmartCardInfo', [UtilityBillsController::class, 'getSmartCardInfo']);
                    Route::post('/vendTvSubscription', [UtilityBillsController::class, 'vendTvSubscription']);
                    Route::get('/trxHistory', [UtilityBillsController::class, 'transactionHistory']);
                });

                Route::group([
                    'prefix' => 'dispute',
                ], function () {
                    Route::post('/initiate', [DisputeController::class, 'initateDispute']);
                    Route::get('/history', [DisputeController::class, 'history']);
                });

                Route::group([
                    'prefix' => 'support',
                ], function () {
                    Route::get('/getCategories', [SupportController::class, 'getSupportCategories']);
                    Route::post('/submitTicket', [SupportController::class, 'submitTicket']);
                    Route::get('/viewTickets', [SupportController::class, 'viewTickets']);
                });

                Route::group([
                    'prefix' => 'beneficiary',
                ], function () {
                    Route::post('/addBeneficiary', [BeneficiaryController::class, 'addBeneficiary']);
                    Route::get('/viewBeneficiaries', [BeneficiaryController::class, 'viewBeneficiaries']);
                });

                Route::group([
                    'prefix' => 'withdrawal',
                ], function () {
                    Route::post('/initiate', [WithdrawalController::class, 'initiateWithdrawal']);
                    Route::get('/verify/{reference}', [WithdrawalController::class, 'verifyTransaction']);
                    Route::get('/history', [WithdrawalController::class, 'withdrawalHistory']);
                });

                Route::group([
                    'prefix' => 'transfer',
                ], function () {
                    Route::post('/simulate', [TransferController::class, 'simulateInwardTransfer']);
                    Route::get('/getBanks', [TransferController::class, 'getBanks']);
                    Route::post('/nameEnquiry', [TransferController::class, 'nameEnquiry']);
                    Route::post('/outward', [TransferController::class, 'initiateOutwardTransfer']);
                    Route::get('/verify/{reference}', [TransferController::class, 'verifyTransaction']);
                    Route::get('/details/{reference}', [TransferController::class, 'transferDetails']);
                    Route::get('/history', [TransferController::class, 'transferHistory']);
                });

                Route::group([
                    'prefix' => 'eod',
                ], function () {
                    Route::post('/', [EODController::class, 'endOfDay']);
                    Route::post('/email', [EODController::class, 'emailEndOfDay']);
                });
            });

        });
    });
});
