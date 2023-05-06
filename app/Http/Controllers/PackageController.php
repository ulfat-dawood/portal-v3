<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FeachPortalAPI;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function getPackage(Request $request)
    {
        if (!$request->packageId) redirect()->back()->with('error', __('Not Found'));
        $response = FeachPortalAPI::feach('/package/' . $request->packageId);
        if (!$response[0]) return redirect()->back()->with($response[1], $response[2]);
        $response = $response[0];
        // dump($response->json()['data']);
        return  view('components.home.packages.show', ['package' => $response->json()['data']]);
    }

    public function getPackages()
    {
        $response = FeachPortalAPI::feach('/packages');
        if (!$response[0]) return redirect()->back()->with($response[1], $response[2]);
        $response = $response[0];
        return  view('components.home.packages.packages', ['packages' => $response->json()['data']]);
    }

    public function orderPackage(Request $request)
    {
        if (!$request->packageId) redirect()->back()->with('error', __('Not Found'));
        $response = FeachPortalAPI::feach('/package/' . $request->packageId);
        if (!$response[0]) return redirect()->back()->with($response[1], $response[2]);
        $response = $response[0];
        return  view('components.home.packages.order', ['package' => $response->json()['data'][0]]);
    }

    public function checkout(Request $request)
    {
        session(['checkout' => [
            'package_id' => $request->package_id,
            'quantity' => 1,
            'account_id' => session('user')['id'],
            'mobile' => session('user')['phone'],
            'name' => session('user')['name']
        ]]);
        return redirect()->route('checkout');
    }
}
