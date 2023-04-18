<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SlotController;
use App\Http\Livewire\Account as LivewireAccount;
use App\Models\Account;
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

    Route::get('', [HomeController::class, 'index'])->name('home');

    // Account
    Route::get('/login', [AccountController::class, 'getRegistrationView'])->middleware('RedirectIfLoggedIn');
    Route::post('/login', [AccountController::class, 'login'])->name('login');
    Route::get('/register', [AccountController::class, 'getRegistrationView'])->middleware('RedirectIfLoggedIn');
    Route::post('/register/otp', [AccountController::class, 'registrationOtp'])->name('register-otp');
    Route::post('/register', [AccountController::class, 'register'])->name('register');
    // Route::view('/registrationOtp', 'registration-otp')->name('registratio-otp-page');
    // Route::post('/registrationOtp', [AccountController::class, 'verifyRegistrationOtp'])->name('registration-otp');


    //Doctor
    Route::get('doctors', [DoctorController::class, 'getDoctors'])->name('getDoctors');
    Route::get('doctor/{doctorName?}/{doctorId}/{centerId}/{clinicId}', [DoctorController::class, 'getDoctor'])->name('doctor');

    //Slots
    Route::get('slot/{slotId}', [SlotController::class, 'getSlot'])->name('slot');

    Route::get('/package/{packageId}', [PackageController::class, 'getPackages'])->name('getPackages');

    // payment
    Route::get('checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::get('payment/response', [PaymentController::class, 'response'])->name('payment.response');
    Route::post('payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
    Route::get('payment/success', [PaymentController::class, 'success'])->name('payment.success');
    Route::get('payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');


    Route::middleware('AccountAuth')->group(function () {
        // Account
        Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
        Route::get('/account/{tabNo?}', LivewireAccount::class)->name('account');

    });


});
