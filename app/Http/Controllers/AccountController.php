<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Http;

class AccountController extends Controller
{

    public function login(LoginRequest $request)
    {
        try {
            $response = Http::post(env('API_URL') . '/' . app()->getLocale() . '/account/login', [
                'mobile' =>  $request->loginMobile,
                'password' =>  $request->loginPassword,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($response->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        //check if the user exist
        if (!$response->json()['status']) return redirect()->back()->with('warning', $response->json()['msg']);
        // user successfully logged
        session(['user' => $response->json()['data']]);
        return redirect()->route('home', ['locale' => session('locale')])->with('success', __('Logged in sucessfully'));
    }

    public function logout()
    {
        if (session('user')) {
            session(['user' => false]);
            return redirect()->route('home', ['locale' => session('locale')])->with('success', __('logged out succssfuly'));
        }
    }

    public function getRegistrationView()
    {
        return view('login', ['titles' => [__('Mrs'), __('Mr'), __('Miss')]]);
    }

    public function register(RegisterRequest $request)
    {
        try {
            $response = Http::post(env('API_URL') . '/' . app()->getLocale() . '/account/register', [
                'name' => $request->name,
                'mobile' => $request->mobile,
                'password' => $request->password,
                'email' => $request->email
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($response->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        //check if the user exist
        if (!$response->json()['status']) return redirect()->back()->with('warning', $response->json()['msg']);

        //Redirect to the OTP page
        return redirect()->route('registrationOtp', ['locale'=> session('locale')]);

    }


    public function verifyRegistrationOtp(Request $request)
    {
        //validate
        $request->validate([
            "registrationOtp" => "Required"
        ]);

        // prepare for the request:
        $token = session('apiToken');
        $api = env('API_URL');

        // Endpoint:
        $endpoint = $api . '/NexenOTP/CheckRegistrationOTP';
        $parameters = [
            'otp' => intval($request->input('registrationOtp')),
            'transactionID' => session('registrationOperationId')
        ];

        // Make request:
        try {
            $response = Http::withToken($token)->post($endpoint, $parameters)->json();
            //is success?
            if (isset($response['operationType']) && $response['operationType'] == "Success") {
                session()->forget('registrationOperationId');
                return redirect()->route('login', ['locale' => session('locale')])->with('success', __('successfully register, please login'));
            } elseif (isset($response['operationType']) && $response['operationType'] == "Error") {
                return redirect()->back()->with('error', $response['operationDetails'][0]['details']);
            } else {
                return redirect()->back()->with('error', __('Error occured, please try again.'));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Error occured, please try again.'));
            return $th;
        }
    }
}
