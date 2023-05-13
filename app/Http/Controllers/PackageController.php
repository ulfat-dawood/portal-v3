<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FeachPortalAPI;
use App\Models\Checkout;
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
        session(['checkout' => $request->package_id]);
        $response = FeachPortalAPI::feach('/package/' . $request->packageId);
        if (!$response[0]) return redirect()->back()->with($response[1], $response[2]);
        $response = $response[0]->json()['data'][0];
        FeachPortalAPI::feach('/packages/order', [
            'package_id' => $request->packageId,
            'account_id' => session('user')['id'],
            'quantity' => 1,
            'hospital_id' => $response['HOSPITAL_ID']
        ], 'post');

        Checkout::create([
            'package_id' => $response['PKG_ID'],
            'PKG_PRICE' => $response['PKG_PRICE'],
            'mobile' =>  session('user')['phone'],
            'accountId' => session('user')['id'],
            'firstName' => session('user')['name'],
            'email' => session('user')['phone'] . '@athir.com.sa',
            'HOSPITAL_ID' => $response['HOSPITAL_ID']
        ]);
        return redirect()->route('checkout.package');
    }

    public function checkout(Request $request)
    {
        session(['checkout' => $request->package_id]);
        return redirect()->route('checkout');
    }
}
