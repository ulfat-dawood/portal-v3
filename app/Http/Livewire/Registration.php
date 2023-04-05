<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Registration extends Component
{

    public $name;
    public $mobile;
    public $email;
    public $password;
    public $password_confirmation;
    public $policy;
    public $otp;
    public $isOtpSent;
    public $msg;

    public function mount()
    {
        $this->isOtpSent = false;
    }

    public function requestOtp()
    {

        $this->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
            'policy' => 'required'
        ]);

        // Validation successful> send OTP
        $response = Http::post(
            env('API_URL') . '/' . app()->getLocale() . '/account/register',
            [
                'mobile' =>  '966' . substr($this->mobile, -9),
                "name" => $this->name,
                "email" => $this->email,
                "password" => $this->password,
            ]
        );
        if ($response->failed()) return redirect()->route('register', ['locale' => session('locale')])->with('error', __('Error occured, please try again.'));
        if (!$response->json()['status']) return redirect()->route('register', ['locale' => session('locale')])->with('warning', $response->json()['msg']);

        // OTP sent successfully
        $this->isOtpSent = true;
    }

    public function submitOtp()
    {
        $this->validate(['otp' => 'required']);

        // Validation successful> try to register user
        try {
            $responseRegister = Http::post(env('API_URL') . '/' . app()->getLocale() . '/account/registerOtp', [
                'otp' => $this->otp,
                'mobile' => $this->mobile,
                'password' => $this->password,
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($responseRegister->failed()) return  $this->msg = __('Error occured, please try again.');
        if (!$responseRegister->json()['status']) {
            $this->msg = $responseRegister->json()['msg'];
        } else {
            // Registration succesful
            session(['user' => $responseRegister->json()['data']]);
            return redirect()->route('home', ['locale' => session('locale')])->with('success', __('Accout crated succesfully, please login'));
        }
    }
    public function render()
    {
        return view('livewire.registration');
    }
}
