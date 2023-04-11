<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PackageController extends Controller
{
    public function getPackages(Request $request)
    {

        if (!$request->packageId) {
            redirect()->back();
        }

        try {
            $response = Http::get(env('API_URL') . '/' . app()->getLocale() . '/packages');
            // $response = Http::get(env('API_URL') . '/' . app()->getLocale() . '/package/' . $request->packageId);
            $response = Http::get(env('API_URL') . '/' . app()->getLocale() . '/package/{packageId}', [
                'packageId' => $request->packageId,
            ]);
            // dd($request->packageId);
            dd($response);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }
        if ($response->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$response->json()['status']) return redirect()->back()->with('warning', $response->json()['msg']);


        return  view('components.home.packages.show', ['packages' => $response['data'][$request->packageId]]);
    }
}
