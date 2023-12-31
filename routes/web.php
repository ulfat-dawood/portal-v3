<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SlotController;
use App\Http\Livewire\Account\Index as LivewireAccount;
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

Route::any('test', function () {
    echo env('APP_ENV');
    echo "/n/t <br/> ";
    echo env('APP_DEBUG');
});

Route::group(['prefix' => '{locale?}', 'middleware' => ['Localization']], function () {

    Route::get('', [HomeController::class, 'index'])->name('home');

    // Account
    Route::get('/login', [AccountController::class, 'getRegistrationView'])->name('login')->middleware('RedirectIfLoggedIn');
    Route::post('/login', [AccountController::class, 'login'])->name('login');
    Route::get('/register', [AccountController::class, 'getRegistrationView'])->middleware('RedirectIfLoggedIn')->name('register');

    //Doctor
    Route::get('doctors', [DoctorController::class, 'getDoctors'])->name('getDoctors');
    Route::get('doctor/{doctorName?}/{doctorId}/{centerId}/{clinicId}/{appt_type_in?}', [DoctorController::class, 'getDoctor'])->name('doctor');


    //Packages
    Route::get('/package/{packageId}', [PackageController::class, 'getPackage'])->name('getPackage');
    Route::get('/packages/{clinicId?}/{clinicName?}', [PackageController::class, 'getPackages'])->name('getPackages');



    Route::middleware('AccountAuth')->group(function () {
        // Account
        Route::get('/logout', [AccountController::class, 'logout'])->name('logout');
        Route::get('/account/{tabNo?}', LivewireAccount::class)->name('account');
        Route::post('/packages/order/{packageId}', [PackageController::class, 'orderPackage'])->name('package.order');
        // Route::post('/package/checkout', [PackageController::class, 'checkout'])->name('package.checkout');
        //Slots
        Route::get('slot/{slotId}', [SlotController::class, 'getSlot'])->name('slot');
        // payment
        Route::get('checkout', [PaymentController::class, 'checkout'])->name('checkout');
        Route::get('checkout/package/{package_id}', [PaymentController::class, 'packageCheckout'])->name('checkout.package');
        Route::get('payment/success', [PaymentController::class, 'success'])->name('payment.success');
        Route::get('payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');
        Route::get('payment/cancelled', [PaymentController::class, 'cancelled'])->name('payment.cancelled');
    });
    // failed to load first page
    Route::view('failed', 'errors.failed')->name('failed');
});
