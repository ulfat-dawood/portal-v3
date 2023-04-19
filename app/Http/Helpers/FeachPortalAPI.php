<?php

namespace App\Http\Helpers;

use GuzzleHttp\Pool;
use Illuminate\Support\Facades\Http;

class FeachPortalAPI
{
    /**
     * make API request for the portal server
     * @param string endpoint
     * @param array $parameters optional
     * @param string $method optional
     */
    public static function feach($endpoint, $paramiters = [], $method = "get")
    {
        try {
            $response = Http::$method(env('API_URL') . '/' . app()->getLocale() . $endpoint, $paramiters);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', __('Server error: coudn\'t connect. Please try again'));
        }

        if ($response->failed()) return redirect()->back()->with('error', __('Error occured, please try again.'));
        if (!$response->json()['status'])  redirect()->back()->with('warning', $response->json()['msg']);

        return $response;
    }

    public static function pull($endpoints, $methods, $paramiters = [])
    {
    }
}
