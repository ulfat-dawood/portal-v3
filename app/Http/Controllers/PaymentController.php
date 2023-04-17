<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Paytabscom\Laravel_paytabs\Facades\paypage;

class PaymentController extends Controller
{
    /**
     * check out payment page for displaying credit card payment information
     * @param array appointment data from session
     */
    public function checkout()
    {
        $data = (session('checkout'));

        $pay = paypage::sendPaymentCode('creditcard,mada,stcpay,applepay')
            ->sendTransaction('sale')
            ->sendCart(10, $data['slot']['EXAM_PRICE'], 'Appointment number :' . $data['slot']['CLIN_APPT_SLOT_ID'])
            ->sendCustomerDetails($data['firstName'], $data['mobile'] . '@athir.com.sa', $data['mobile'], 'temp address', 'Jeddah', 'Makkah', 'SA', '12345', request()->ip())
            ->sendShippingDetails($data['firstName'], $data['mobile'] . '@athir.com.sa', $data['mobile'], 'temp address', 'Jeddah', 'Makkah', 'SA', '12345', request()->ip())
            // ->sendHideShipping(true)
            ->sendFramed(true)
            ->sendURLs(route('payment.response', ['locale' => app()->getLocale()]), route('payment.callback', ['locale' => app()->getLocale()]))
            ->sendLanguage(app()->getLocale())
            ->create_pay_page();

        // return $pay;
        return view('payment.checkout', ['url' => $pay]);
    }
    public function response(Request $request) //return
    {
        return '<script>window.parent.location.href = "'.route('payment.failed').'";</script>';
        dd($request->query('respStatus'));
    }
    public function callback(Request $request) //callback
    {
        dd($request->query());
    }
    public function success(Request $request) //callback
    {
        dd($request->query());
    }
    public function failed(Request $request) //callback
    {
        dd($request->query());
    }
}
