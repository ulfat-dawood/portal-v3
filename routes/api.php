<?php

use App\Http\Controllers\PaymentController;
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
Route::any('payment/response/', [PaymentController::class, 'response'])->name('payment.response.api');
Route::any('payment/response/package', [PaymentController::class, 'responsePackage'])->name('payment.package.response.api');
Route::post('payment/callback', [PaymentController::class, 'callback'])->name('payment.callback.api');

