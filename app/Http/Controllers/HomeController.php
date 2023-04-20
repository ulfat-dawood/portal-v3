<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FeachPortalAPI;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $response = FeachPortalAPI::pool(['/cities', '/clinics', '/packages']);
        if (!$response[0]) return redirect()->route('failed')->with($response[1], $response[2]);
        $response = $response[0];
        return  view('index', [
            'cities' => $response[0]['data'],
            'clinics' => $response[1]['data'],
            'packages' => $response[2]['data']
        ]);
    }
}
