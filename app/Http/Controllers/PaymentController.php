<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkout(){

        $data = session('checkout');
        session()->forget('checkout');
        dd($data);
    }
}
