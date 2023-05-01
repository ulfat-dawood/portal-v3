<?php

namespace App\Http\Controllers;

use App\Http\Helpers\FeachPortalAPI;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function getSlot(Request $request)
    {
        //validate
        if (!$request->slotId) return redirect()->back()->with('error', __('Not Found'));
        $response = FeachPortalAPI::feach('/slot/' . $request->slotId);
        if (!$response[0]) return redirect()->back()->with($response[1], $response[2]);
        $response = $response[0];
        $lockSlote = FeachPortalAPI::feach('/slot/locksingleslot', ["account_id" => session('user')['id'], "slot_id" => $request->slotId], 'post');
        if (!$lockSlote[0])  return redirect()->back()->with($lockSlote[1], $lockSlote[2]);
        return view('slot', ['slot' => $response['data'][0]]);
    }
}
