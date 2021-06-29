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
Route::group(['middleware' => 'verified', 'prefix' => 'admin'],function () {
    Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
});

Route::post('/register-store', [App\Http\Controllers\StoreController::class, 'register'])->middleware('auth')->name('register-store');

require __DIR__ . '/auth.php';
