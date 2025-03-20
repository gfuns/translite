<?php
use App\Http\Controllers\Workers\ServiceWorkers;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'worker',
], function ($router) {
    Route::get('/endOfDay', [ServiceWorkers::class, 'endOfDay'])->name('worker.endOfDay');
    Route::get('/endOfMonth', [ServiceWorkers::class, 'endOfMonth'])->name('worker.endOfMonth');
    Route::get('/endOfYear', [ServiceWorkers::class, 'endOfYear'])->name('worker.endOfYear');
});
