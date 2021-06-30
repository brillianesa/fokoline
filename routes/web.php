<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('homepage');

Route::post('/register-store', [App\Http\Controllers\StoreController::class, 'register'])->middleware('auth')->name('register-store');
Route::get('/store-detail/{id}', [App\Http\Controllers\StoreController::class, 'detail'])->middleware('auth')->name('store-detail');
Route::post('/store-autocomplete', [App\Http\Controllers\StoreController::class, 'autocomplete'])->name('store-autocomplete');

Route::group(['middleware' => 'verified'],function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    # store
    Route::get('/store-verification', [App\Http\Controllers\StoreVerificationController::class, 'index'])->name('store.verification');
    Route::get('/store-verification/{id}', [App\Http\Controllers\StoreVerificationController::class, 'approval'])->name('store.approval');
    Route::get('/store-verification/{id}/{action}', [App\Http\Controllers\StoreVerificationController::class, 'approvalAction'])->name('store.approval.action');

    # order
    Route::get('/order-list', [App\Http\Controllers\OrderController::class, 'index'])->name('order.list');
    Route::get('/order/{id}', [App\Http\Controllers\OrderController::class, 'createForm'])->name('order.create');
    Route::get('/order/{id}/action', [App\Http\Controllers\OrderController::class, 'createAction'])->name('order.create.action');
});


require __DIR__ . '/auth.php';
