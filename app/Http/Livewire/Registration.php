<?php

namespace App\Http\Livewire;

use App\Http\Helpers\FeachPortalAPI;
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
        $response = FeachPortalAPI::feach('/account/register', [
            'mobile' =>  '966' . substr($this->mobile, -9),
            "name" => $this->name,
            "email" => $this->email,
            "password" => $this->password,
        ], 'post');


        // OTP sent successfully
        $this->isOtpSent = true;
    }

    public function submitOtp()
    {
        $this->validate(['otp' => 'required']);

        // Validation successful> try to register user
        $response = FeachPortalAPI::feach('/account/registerOtp', [
            'otp' => $this->otp,
            'mobile' =>  '966' . substr($this->mobile, -9),
            "password" => $this->password,
        ], 'post');

        if (!$response->json()['status']) {
            $this->msg = $response->json()['msg'];
        } else {
            // Registration succesful
            session(['user' => $response->json()['data']]);
            // Registration succesful
            if (session()->has('url')) {
                $url = session('url');
                session()->forget('url');
                return redirect($url)->with('success', __('Account created succesfully.'));
            }
            return redirect()->route('home', ['locale' => session('locale')])->with('success', __('Account created succesfully.'));
        }
    }
    public function render()
    {
        return view('livewire.registration');
    }
}
