<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\payController;
use App\Http\Controllers\profilController;
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


Route::get('/', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('/mycbacespace/register', function () {
    return view('auth.register');
})->name('auth.register');

Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/mycbacespace/logout', [LoginController::class, 'logout'])->name('auth.logout');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/subscription', [HomeController::class, 'subscription'])->name('subscription');
    Route::post('/update-password', [profilController::class, 'updatePassword'])->name('password.update');
    Route::post('/uploadingPhoto', [profilController::class, 'storeOrUpdateImage'])->name('image.store');
    Route::patch('/updateUserInfo', [profilController::class, 'updateUserData'])->name('user.update');
    Route::get('/pay', [payController::class, 'pay'])->name('pay');
    Route::get('/subsuccess', [HomeController::class, 'mailIndex'])->name('mails.index');
    Route::post('check/password', [profilController::class, 'checkPassword'])->name('check.password');
});
