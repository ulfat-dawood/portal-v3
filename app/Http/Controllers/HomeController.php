<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        try {
            $response = Http::pool(fn (Pool $pool) => [
                $pool->get(env('API_URL') . '/' . app()->getLocale() . '/cities'),
                $pool->get(env('API_URL') . '/' . app()->getLocale() . '/clinics'),
                $pool->get(env('API_URL') . '/' . app()->getLocale() . '/packages')
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($response[0]->failed() && $response[1]->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$response[0]->json()['status']) return redirect()->back()->with('warning', $response[0]->json()['msg']);
        if (!$response[1]->json()['status']) return redirect()->back()->with('warning', $response[1]->json()['msg']);


        return  view('index', [
            'cities' => $response[0]['data'],
            'clinics' => $response[1]['data'],
            'packages' => $response[2]['data']
        ]);
    }

    public function getPackages()
    {
        try {
            $response = Http::get(env('API_URL') . '/' . app()->getLocale() . '/packages');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($response->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$response->json()['status']) return redirect()->back()->with('warning', $response->json()['msg']);


        return  view('components.home.packages.show', ['packages' => $response['data']]);
    }
}
