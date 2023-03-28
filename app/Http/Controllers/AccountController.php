<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Http;

class AccountController extends Controller
{

    public function login(LoginRequest $request)
    {
        try {
            $response = Http::post(env('API_URL') . '/' . app()->getLocale() . '/account/login', [
                'mobile' =>  $request->input()['loginMobile'],
                'password' =>  $request->input()['loginPassword']
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('warning', __('Server error: coudn\'t connet. Please try again'));
        }
        if ($response->failed()) return redirect()->back()->with('warning', __('Error: Not found. Please try again'));
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

    public function register(Request $request)
    {

        // Validate
        $request->validate([
            // "title" => 'required',
            "name" => "required",
            "mobile" => "required",
            "email" => "required|email",
            "password" => 'required|confirmed|min:6',
            "policy" => "required"
        ]);

        // prepare for the request:
        $token = session('apiToken');
        $locale = session()->has('locale') ? session('locale') : 'ar';
        $endpoint = env('API_URL') . '/' . $locale . '/account/register';
        $parameters = [
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'password' => $request->input('password'),
            'email' => $request->input('email')
        ];
        $response = Http::withToken($token)->post($endpoint, $parameters)->json();
        dd($response);
        // Make request:
        try {
            $response = Http::withToken($token)->post($endpoint, $parameters)->json();
            dd($response);
            // Endpoint request is successful:
            if (isset($response['operationType']) && $response['operationType'] == "Success") {

                //response msg:
                $msg = session('locale') == 'ar' ? $response['data']['messageAr'] : $response['data']['message'];

                // if status code == 200:
                if ($response['data']['code'] == '200') {
                    // Send OTP via API endpoint
                    //
                    //

                    // if OTP sent successfully:
                    $response['OTP'] = '5151';
                    // Store the sent OTP in session
                    session(['otp' => $response['OTP']]);
                    // Redirect the user to the OTP page
                    return redirect()->route('home', ['locale' => session('locale')])->with('success', $msg);

                    // if OTP not sent successfully
                    return redirect()->back()->with('warning',  __('Error occured, please try again.'));
                }
                // if status code != 200   >> redirect back
                return redirect()->back()->with('warning', $msg);
            } else {
                // Endpoint request is not successful:
                return redirect()->back()->with('warning',  __('Error occured, please try again.'));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',  __('Error occured, please try again.'));
            return $th;
        }
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
