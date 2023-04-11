<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterOtpRequest;
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
        if (!$response->json()['status']) return redirect()->back()->with('warning', $response->json()['msg']);
        // user successfully logged
        session(['user' => $response->json()['data']]);

        if(session()->has('url')){
            $url = session('url');
            session()->forget('url');
            return redirect($url);
        }
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
        if(session()->has('slot-url')){
            $url = session('slot-url');
            session()->forget('slot-url');
        }else{
            $url = url()->previous();
        }
        session(['url' => $url ]);

        return view('login');
    }



    public function registrationOtp(RegisterRequest $request)
    {
        // Send OTP to user
        $response = Http::post(
            env('API_URL') . '/' . app()->getLocale() . '/account/register',
            [
                'mobile' =>  '966' . substr($request->mobile, -9) ,
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password,
                ]
            );
        if ($response->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$response->json()['status']) return redirect()->back()->with('warning', $response->json()['msg']);

        return view('registration-otp', [
            'data' => [
                'mobile' => $request->mobile,
                'password' => $request->password
            ]
        ]);
    }

    public function register(RegisterOtpRequest $request)
    {

        try {
            $responseRegister = Http::post(env('API_URL') . '/' . app()->getLocale() . '/account/registerOtp', [
                'otp' => $request->otp,
                'mobile' => $request->mobile,
                'password' => $request->password,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($responseRegister->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$responseRegister->json()['status']) return redirect()->back()->with('warning', $responseRegister->json()['msg']);

        // Registration succesful
        if(session()->has('url')){
            $url = session('url');
            session()->forget('url');
            return redirect($url);
        }

        return redirect()->route('home', ['locale' => session('locale')])->with('success', __('Accout crated succesfully, please login'));
    }
}

