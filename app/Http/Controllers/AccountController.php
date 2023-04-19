<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FeachPortalAPI;
use App\Http\Requests\LoginRequest;

class AccountController extends Controller
{

    public function login(LoginRequest $request)
    {
        $request->validate(['loginMobile' => 'required|min:9', 'loginPassword' => 'required|min:6']);
        $response = FeachPortalAPI::feach('/account/login', ['mobile' =>  $request->loginMobile, 'password' =>  $request->loginPassword], 'post');

        // user successfully logged
        session(['user' => $response->json()['data']]);

        if (session()->has('url')) {
            $url = session('url');
            session()->forget('url');
            return redirect($url)->with('success', __('Logged in sucessfully'));
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
        if (session()->has('slot-url')) {
            $url = session('slot-url');
            session()->forget('slot-url');
        } else {
            $url = url()->previous();
        }
        session(['url' => $url]);

        return view('login');
    }


}
