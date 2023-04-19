<?php

namespace App\Http\Livewire;

use App\Http\Helpers\FeachPortalAPI;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Login extends Component
{
    public $mobile;
    public $showModal = 0;
    public $isOtpSent = false;
    public $isPasswordReset = false;
    public $msg;
    public $otp;
    public $newPassword;
    public $newPassword_confirmation;

    public function showModal($showModal)
    {
        $this->showModal = $showModal;
    }

    public function sendOtp()
    {
        $this->validate(['mobile' => 'required']);
        $response = FeachPortalAPI::feach('/account/forgotpassword', ['mobile' => $this->mobile,], 'post');

        if (!$response->json()['status']) {
            $this->msg = $response->json()['msg'];
        } else {
            // OTP sent succesfully
            $this->msg = __('OTP has been sent');
            $this->isOtpSent = true;
        }
    }

    public function resetPassword()
    {
        $this->validate([
            'otp' => 'required',
            'newPassword' => 'required|confirmed|min:6'
        ]);

        $response = FeachPortalAPI::feach('/account/forgotpasswordcompletion', [
            'mobile' => $this->mobile,
            'password' => $this->newPassword,
            'otp' => $this->otp,
        ], 'post');

        if (!$response->json()['status']) {
            $this->msg = $response->json()['msg'];
        } else {
            // Password reset successfully
            $this->msg = false;
            $this->isPasswordReset = true;
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
