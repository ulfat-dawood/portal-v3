<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function packages()
    {
        $response = Http::get(env('API_URL') . '/' . app()->getLocale() . '/packages');

        if ($response->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$response->json()['status']) return redirect()->back()->with('warning', $response->json()['msg']);

        return  view('index', [
            'packages' => $response['data']
        ]);
    }
}
