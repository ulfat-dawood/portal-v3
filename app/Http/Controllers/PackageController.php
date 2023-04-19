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
        if (!$response->json()['data']) return redirect()->back()->with('error', __('Not Found'));
        return  view('components.home.packages.show', ['package' => $response->json()['data'][0]]);
    }

    public function orderPackage(Request $request)
    {
        if (!$request->packageId) redirect()->back()->with('error', __('Not Found'));
        $response = FeachPortalAPI::feach('/package/' . $request->packageId);
        if (!$response->json()['data']) return redirect()->back()->with('error', __('Not Found'));
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
