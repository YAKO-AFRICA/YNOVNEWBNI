<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function testApi()
    {
        try {
            $response = Http::get(env('BASE_URL_API') . '/enov/getTestDsi');
            $response->throw();

            $data = $response->json();

            $datafinal = $data['data']['communeList'] ?? [];

            return view('testeur.test', ['datafinal' => $datafinal]);
        } catch (\Exception $e) {
           
            Log::error($e->getMessage());
            return view('testeur.test', ['datafinal' => []]);
        }
    }

}
