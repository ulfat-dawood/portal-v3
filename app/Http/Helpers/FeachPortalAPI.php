<?php

namespace App\Http\Helpers;

use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\Http;

class FeachPortalAPI
{
    /**
     * make API request for the portal server
     * @param string endpoint
     * @param array $parameters optional
     * @param string $method optional
     * @return  array [status response/message]
     */
    public static function feach($endpoint, $paramiters = [], $method = "get")
    {
        try {
            $response = Http::$method(env('API_URL') . '/' . app()->getLocale() . $endpoint, $paramiters);
        } catch (\Throwable $th) {
            return [false, 'error', __('Server error: coudn\'t connect. Please try again')];
        }
        if ($response->failed()) return [false, 'error', __('Error occured, please try again.')];
        if (!$response->json()['status']) return [false, 'warning', $response->json()['msg']];
        return [$response];
    }

    /**
     * Make multible API request for portal server
     *
     * @param array $endpoints
     * @return  array [status responses/message]
     */
    public static function pool($endpoints)
    {
        $error = [];
        try {
            $responses = Http::pool(function (Pool $pool) use ($endpoints) {
                $list = [];
                foreach ($endpoints as $value) {
                    $list[] = $pool->get(env('API_URL') . '/' . app()->getLocale() . $value);
                }
                return $list;
            });
        } catch (\Throwable $th) {
            return $error = [false, 'error', __('Server error: coudn\'t connect. Please try again')];
        }
        foreach ($responses as $response) {
            if ($response->failed()) return $error = [false, 'error', __('Error occured, please try again.')];
            if (!$response->json()['status']) return $error = [false, 'warning', $response[0]->json()['msg']];
        }
        if (!empty($error)) return $error;

        return [$responses];
    }
}
