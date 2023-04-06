<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
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

Route::group(['prefix' => '{locale?}', 'middleware' => ['Localization']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Account
    Route::get('/login', [AccountController::class, 'getRegistrationView'])->middleware('RedirectIfLoggedIn');
    Route::post('/login', [AccountController::class, 'login'])->name('login');
    Route::get('/register', [AccountController::class, 'getRegistrationView'])->name('register')->middleware('RedirectIfLoggedIn');
    Route::post('/register', [AccountController::class, 'register'])->name('register');
    Route::view('/registrationOtp', 'registration-otp')->name('registratio-otp-page');
    Route::post('/registrationOtp', [AccountController::class, 'verifyRegistrationOtp'])->name('registration-otp');
    Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
    Route::get('/profile', [AccountController::class, 'getProfile'])->name('profile');


});
