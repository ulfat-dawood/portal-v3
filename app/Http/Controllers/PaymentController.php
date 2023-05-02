<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FeachPortalAPI;
use Illuminate\Http\Request;
use Paytabscom\Laravel_paytabs\Facades\paypage;

class PaymentController extends Controller
{
    /**
     * check payment type
     * reserve the appointment if pay on arraive
     * or check out payment page for displaying credit card payment information
     * @param array appointment data from session
     */
    public function checkout()
    {
        if (!session()->has('checkout')) return redirect()->route('home', ['locale' => app()->getLocale()])->with('error', __('Sorry, your session has expired.'));
        $data = session('checkout');
        if ($data['payOnArrival']) {
            //reserve the appointment
            $response = FeachPortalAPI::feach('/slot/create', [
                'firstName' => $data['firstName'],
                'centerId' => $data['slot']['CENTER_ID'],
                'mobile' => $data['mobile'],
                'slotId' => $data['slot']['CLIN_APPT_SLOT_ID'],
                'accountId' => $data['accountId'],
                'patient_id' => $data['patient_id'],
            ], 'post');
            if (!$response[0]) return redirect()->route('payment.failed', ['locale' => app()->getLocale()])->with('warning', $response[2]);

            return redirect()->route('payment.success', ['locale' => app()->getLocale()])->with('success', __('Appointment booked successfully'));
        }
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

    /**
     * handle payment return response from paytabs
     * redirect to success/failed page
     *
     * @param Request $request
     * @return redirect
     */
    public function response(Request $request) //return
    {
        return '<script>window.parent.location.href = "' . route('payment.failed') . '";</script>';
        dd($request->query('respStatus'));
    }

    /**
     * handeling payment callback response status from paytabs
     * store payment information
     *
     * @param Request $request
     * @return void
     */
    public function callback(Request $request) //callback
    {
        dd($request->query());
    }

    /**
     * success page
     * clearing session data
     *
     * @param Request $request
     * @return view
     */
    public function success(Request $request) //callback
    {
        session()->forget('checkout');
        return view('payment.success');
    }

    /**
     * failed payment page
     * unlock slote if locked & clear session data
     *
     * @param Request $request
     * @return view
     */
    public function failed(Request $request) //callback
    {
        //unlock the appointment
        FeachPortalAPI::feach('/slot/unlocksingleslot', ["account_id" => session('user')['id'], "slot_id" => session('checkout')['slot']['CENTER_ID']], 'post');
        session()->forget('checkout');
        //  cancel the appointment
        return view('payment.failed');
    }
}
