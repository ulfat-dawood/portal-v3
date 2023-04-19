<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\FuncCall;

class PackageController extends Controller
{
    public function getPackage(Request $request)
    {

        if (!$request->packageId) {
            redirect()->back();
        }

        try {
            $response = Http::get(env('API_URL') . '/' . app()->getLocale() . '/package/'.$request->packageId);
            // dd($response->json()['data'][0] );
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($response->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$response->json()['status']) return redirect()->back()->with('warning', $response->json()['msg']);


        return  view('components.home.packages.show', ['package' => $response->json()['data'][0] ]);
    }

    public function orderPackage(Request $request){
        if (!$request->packageId) {
            redirect()->back();
        }

        try {
            $response = Http::get(env('API_URL') . '/' . app()->getLocale() . '/package/'.$request->packageId);
            // dd($response->json()['data'][0] );
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($response->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$response->json()['status']) return redirect()->back()->with('warning', $response->json()['msg']);
        return  view('components.home.packages.order', ['package' => $response->json()['data'][0] ]);
    }

    public function checkout(Request $request){
        session(['checkout'=> [
            'package_id' => $request->package_id,
            'quantity' => 1,
            'account_id' => session('user')['id'],
            'mobile' => session('user')['phone'],
            'name' => session('user')['name']

        ]]);
        return redirect()->route('checkout');
    }
}
