<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActivityTrackerController extends Controller
{
    public function track(Request $request)
    {
        // Kirim data ke Elasticsearch
        $response = Http::withBasicAuth('elastic', 'r5h*GlS2Mc4HdSrlQUip') // Ganti dengan password kamu
            ->withOptions(['verify' => false]) // Abaikan SSL di localhost
            ->post('https://localhost:9200/user-activity/_doc', [
                'user_id' => $request->user_id,
                'ip' => $request->ip,
                'city' => $request->city,
                'region' => $request->region,
                'country' => $request->country,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'browser' => $request->browser,
                'device' => $request->device,
                'page' => $request->page,
                'timestamp' => $request->timestamp,
            ]);

        return response()->json([
            'status' => 'ok',
            'elastic_response' => $response->json(),
        ]);
    }
}
