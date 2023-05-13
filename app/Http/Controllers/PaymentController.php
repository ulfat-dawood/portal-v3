<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FeachPortalAPI;
use App\Models\Checkout;
use App\Models\LogPayment;
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
        // dd(session('checkout'));
        if (!session()->has('checkout')) return redirect()->route('home', ['locale' => app()->getLocale()])->with('error', __('Sorry, your session has expired.'));
        $data = Checkout::where(['CLIN_APPT_SLOT_ID' => session('checkout')])->latest()->first();

        if ($data['payOnArrival']) {
            //reserve the appointment
            $response = FeachPortalAPI::feach('/slot/create', [
                'firstName' => $data['firstName'],
                'centerId' => $data['CENTER_ID'],
                'mobile' => $data['mobile'],
                'slotId' => $data['CLIN_APPT_SLOT_ID'],
                'accountId' => $data['accountId'],
                'patient_id' => $data['patient_id'],
                // 'location_id'=> $data['location_id'],
            ], 'post');
            if (!$response[0]) return redirect()->route('payment.failed', ['locale' => app()->getLocale()])->with('warning', $response[2]);

            return redirect()->route('payment.success', ['locale' => app()->getLocale()])->with('success', __('Appointment booked successfully'));
        }
        // $data['EXAM_PRICE'] = .25;
        $pay = paypage::sendPaymentCode('creditcard,mada,stcpay,applepay')
            ->sendTransaction('sale')
            ->sendCart($data['CLIN_APPT_SLOT_ID'], $data['EXAM_PRICE'], 'Appointment number :' . $data['CLIN_APPT_SLOT_ID'])
            ->sendCustomerDetails($data['firstName'], $data['mobile'] . '@athir.com.sa', $data['mobile'], 'temp address', 'Jeddah', 'Makkah', 'SA', '12345', request()->ip())
            ->sendShippingDetails($data['firstName'], $data['mobile'] . '@athir.com.sa', $data['mobile'], 'temp address', 'Jeddah', 'Makkah', 'SA', '12345', request()->ip())
            ->sendHideShipping(true)
            ->sendFramed(true)
            ->sendURLs(route('payment.response.api'), route('payment.callback.api'))
            ->sendLanguage(app()->getLocale())
            ->create_pay_page();
        return view('payment.checkout', ['url' => $pay]);
    }

    public function packageCheckout(Request $request)
    {
        if (!$data = Checkout::where(['package_id' => $request->package_id])->latest()->first())
            return redirect()->route('home', ['locale' => app()->getLocale()])->with('error', __('Not Found'));

        $pay = paypage::sendPaymentCode('creditcard,mada,stcpay,applepay')
            ->sendTransaction('sale')
            ->sendCart($data['package_id'], $data['PKG_PRICE'], 'Appointment number :' . $data['package_id'])
            ->sendCustomerDetails($data['firstName'], $data['mobile'] . '@athir.com.sa', $data['mobile'], 'temp address', 'Jeddah', 'Makkah', 'SA', '12345', request()->ip())
            ->sendShippingDetails($data['firstName'], $data['mobile'] . '@athir.com.sa', $data['mobile'], 'temp address', 'Jeddah', 'Makkah', 'SA', '12345', request()->ip())
            ->sendHideShipping(true)
            ->sendFramed(true)
            ->sendURLs(route('payment.package.response.api'), route('payment.callback.api'))
            ->sendLanguage(app()->getLocale())
            ->create_pay_page();
        return view('payment.checkout', ['url' => $pay]);
    }

    /**
     * handle payment return response from paytabs
     * 1-check if valide signature
     * 2- storing through API request
     * redirect to success/failed page
     *
     * @param Request $request
     * @return redirect
     */
    public function response(Request $request) //return
    {
        if ($this->validateResponse($request->input(), $request->signature)) {
            // log response to DB
            LogPayment::create(['title' => $request->cartId, 'data' => json_encode($request->input())]);
            // if payment successful
            if ($request->respStatus == 'A') {
                $data = Checkout::where(['CLIN_APPT_SLOT_ID' => $request->cartId])->latest()->first();
                $response = FeachPortalAPI::feach('/slot/payment', [
                    "service_type" => 'APPT',
                    "amount" => $data['EXAM_PRICE'],
                    "portal_discount" =>  $data['PORTAL_DISCOUNT'],
                    "account_id" => $data['accountId'],
                    "patient_id" => $data['patient_id'],
                    "slot_id" => $data['CLIN_APPT_SLOT_ID'],
                    "trans_type" => 'in',
                    "hospital_id" => $data['HOSPITAL_ID'],
                    "center_id" => $data['CENTER_ID'],
                    "pkg_id" => null,
                    "srvc_id" => null,
                    "discount" => $data['DISCOUNT_CASH'],
                    "transaction_id" => $request->tranRef,
                    "card_info" => $request->cartId,
                    "card_owner" => $data['firstName'],
                ], 'post');

                if (!$response[0]) return redirect()->route('payment.failed', ['locale' => app()->getLocale()])->with('warning', $response[2]);
                $response = $response[0];
                session('success', __('Appointment booked successfully'));
                return '<script>window.parent.location.href = "' . route('payment.success', ['locale' => app()->getLocale()]) . '";</script>';
            } else {
                session('error', __('Appointment book failed'));
                return '<script>window.parent.location.href = "' . route('payment.failed') . '";</script>';
            }
        } else {
            session('error', __('Appointment book failed'));
            return '<script>window.parent.location.href = "' . route('payment.failed') . '";</script>';
        };
    }

    public function responsePackage(Request $request)
    {
        if ($this->validateResponse($request->input(), $request->signature)) {
            // log response to DB
            LogPayment::create(['title' => $request->cartId, 'data' => json_encode($request->input())]);
            // if payment successful
            if ($request->respStatus == 'A') {
                $data = Checkout::where(['package_id' => $request->cartId])->latest()->first();

                $response = FeachPortalAPI::feach('/slot/payment', [
                    "service_type" => 'PKG',
                    "amount" => $data['EXAM_PRICE'],
                    "portal_discount" =>  null,
                    "account_id" => $data['accountId'],
                    "patient_id" => null,
                    "slot_id" => null,
                    "trans_type" => 'in',
                    "hospital_id" => $data['HOSPITAL_ID'],
                    "center_id" => null,
                    "pkg_id" => $data['package_id'],
                    "srvc_id" => null,
                    "discount" => null,
                    "transaction_id" => $request->tranRef,
                    "card_info" => $request->cartId,
                    "card_owner" => $data['firstName'],
                ], 'post');

                if (!$response[0]) return redirect()->route('payment.failed', ['locale' => app()->getLocale()])->with('warning', $response[2]);
                $response = $response[0];
                session('success', __('Package ordered successfully'));
                return '<script>window.parent.location.href = "' . route('payment.success', ['locale' => app()->getLocale()]) . '";</script>';
            } else {
                session('error', __('Package ordered failed'));
                return '<script>window.parent.location.href = "' . route('payment.failed') . '";</script>';
            }
        } else {
            session('error', __('Package ordered failed'));
            return '<script>window.parent.location.href = "' . route('payment.failed') . '";</script>';
        };
    }
    //


    /**
     * compare URI signatures and return boolean
     *
     * @param array $inputs
     * @param string $signature
     * @return boolean
     */
    private function validateResponse($inputs, $signature)
    {
        $fields = array_filter($inputs);
        unset($fields["signature"]);
        ksort($fields);
        // Generate URL-encoded query string of Post fields except signature field.
        $query = http_build_query($fields);
        //hash the query string
        $signature = hash_hmac('sha256', $query, env('paytabs_server_key'));
        return hash_equals($signature, $signature);
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
        LogPayment::create(['title' => 'Payment1', 'data' => $request->input()]);
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
        if (isset(session('checkout')['slot']['CENTER_ID'])) {
            //unlock the appointment
            FeachPortalAPI::feach('/slot/unlocksingleslot', ["account_id" => session('user')['id'], "slot_id" => session('checkout')['slot']['CENTER_ID']], 'post');
        }
        //  cancel the appointment
        session()->forget('checkout');
        return view('payment.failed');
    }
}
