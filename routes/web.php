<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\payController;
use App\Http\Controllers\profilController;
use App\Models\categorie;
use App\Models\service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
})->name('auth.login');

Route::get('/space/register', function () {
    $categories = categorie::all();
    $services = service::all();
    return view('auth.register', compact('categories', 'services'));
})->name('auth.register');


Route::post('/space/logout', [LoginController::class, 'logout'])->name('auth.logout');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('checkPayement');
    Route::get('/subscription', [HomeController::class, 'subscription'])->name('subscription');
    Route::post('/update-password', [profilController::class, 'updatePassword'])->name('password.update');
    Route::post('/uploadingPhoto', [profilController::class, 'storeOrUpdateImage'])->name('image.store');
    Route::patch('/updateUserInfo', [profilController::class, 'updateUserData'])->name('user.update');
    Route::get('/pay', [payController::class, 'pay'])->name('pay');
    Route::get('/subsuccess', [HomeController::class, 'mailIndex'])->name('mails.index');
    Route::get('/suberror', [HomeController::class, 'mailerror'])->name('mails.error');
    Route::post('check/password', [profilController::class, 'checkPassword'])->name('check.password');
    Route::post('/uploadDoc', [profilController::class, 'docsUpload'])->name('doc.store');
    Route::post('/tacheUpdate', [profilController::class, 'docsUpload'])->name('task.update');
    Route::post('/taches', [profilController::class, 'tasks'])->name('task.index');
});
