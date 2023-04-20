<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FeachPortalAPI;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SlotController extends Controller
{
    public function getSlot(Request $request)
    {
        //validate
        if (!$request->slotId) return redirect()->back()->with('error', __('Not Found'));
        $response = FeachPortalAPI::feach('/slot/' . $request->slotId);
        if (!$response[0]) return redirect()->back()->with($response[1], $response[2]);
        $response = $response[0];
        return view('slot', ['slot' => $response['data'][0]]);
    }
}
