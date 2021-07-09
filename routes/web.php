<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
Route::get('/about', [App\Http\Controllers\MainController::class, 'about'])->name('about');
Route::get('/list-mitra', [App\Http\Controllers\MainController::class, 'store'])->name('store');

Route::post('/register-store', [App\Http\Controllers\StoreController::class, 'register'])->middleware('auth')->name('register-store');
Route::get('/store-detail/{id}', [App\Http\Controllers\StoreController::class, 'detail'])->middleware('auth')->name('store-detail');
Route::post('/store-autocomplete', [App\Http\Controllers\StoreController::class, 'autocomplete'])->name('store-autocomplete');
Route::post('/store-nearby', [App\Http\Controllers\StoreController::class, 'getNearbyStore'])->name('store-nearby');

Route::group(['middleware' => 'verified'],function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    # store
    Route::get('/store-verification', [App\Http\Controllers\StoreVerificationController::class, 'index'])->name('store.verification');
    Route::get('/store-verification/{id}', [App\Http\Controllers\StoreVerificationController::class, 'approval'])->name('store.approval');
    Route::get('/store-verification/{id}/{action}', [App\Http\Controllers\StoreVerificationController::class, 'approvalAction'])->name('store.approval.action');

    # order
    Route::get('/order-list', [App\Http\Controllers\OrderController::class, 'index'])->name('order.list');
    Route::get('/order/{id}', [App\Http\Controllers\OrderController::class, 'createForm'])->name('order.create');
    Route::post('/order/{id}/action', [App\Http\Controllers\OrderController::class, 'createAction'])->name('order.create.action');
    Route::get('/order/file/{fileaccess}', [App\Http\Controllers\OrderController::class, 'downloadFile'])->name('order.get.file');
    Route::get('/order/{id}/detail', [App\Http\Controllers\OrderController::class, 'orderDetail'])->name('order.detail');
    Route::post('/order/{id}/ready', [App\Http\Controllers\OrderController::class, 'orderReady'])->name('order.ready');
    Route::post('/order/{id}/done', [App\Http\Controllers\OrderController::class, 'orderDone'])->name('order.done');
    Route::post('/order/{id}/cancel', [App\Http\Controllers\OrderController::class, 'orderCancel'])->name('order.cancel');

    # order payment
    Route::get('/order/{id}/payment', [App\Http\Controllers\OrderController::class, 'uploadPaymentForm'])->name('order.payment');
    Route::post('/order/{id}/payment', [App\Http\Controllers\OrderController::class, 'uploadPaymentAction'])->name('order.payment.action');
    Route::get('/order/{id}/payment/verify', [App\Http\Controllers\OrderController::class, 'paymentDetail'])->name('order.payment.detail');
    Route::post('/order/{id}/payment/verify', [App\Http\Controllers\OrderController::class, 'paymentVerify'])->name('order.payment.verify');
    Route::post('/order/{id}/deny', [App\Http\Controllers\OrderController::class, 'orderDeny'])->name('order.payment.deny');

    # user setting
    Route::get('/user/setting', [App\Http\Controllers\UserController::class, 'index'])->name('user.setting');
    Route::post('/user/profile/update', [App\Http\Controllers\UserController::class, 'userUpdate'])->name('user.update.profile');
    Route::post('/user/store/update', [App\Http\Controllers\UserController::class, 'storeUpdate'])->name('user.update.store');

    # store price setting
    Route::resource('store/price', App\Http\Controllers\StorePriceController::class);
});


require __DIR__ . '/auth.php';
