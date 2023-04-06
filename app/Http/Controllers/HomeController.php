<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {

        $response = Http::get(env('API_URL') . '/' . app()->getLocale() . '/packages');

        if ($response->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$response->json()['status']) return redirect()->back()->with('warning', $response->json()['msg']);

        return  view('index', [
            'cities' => ['Jeddah', 'Makkah', 'Taif'],
            'clinics' => ['Dental', 'General', 'Dermatology', 'Gynacology'],
            'packages' => $response['data']
        ]);
    }
}
