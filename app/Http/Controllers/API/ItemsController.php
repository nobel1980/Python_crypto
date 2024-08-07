<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ItemsController extends Controller
{
    public function bin_wise_items(Request $request, $binNumber)
    {
        //$binNumber = $request->all();

        // var_dump($binNumber);
        // exit();

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $request->bearerToken()
        ])
        ->withOptions([
            'verify' => storage_path('app/cacert.pem'),
        ])
        ->withUrlParameters([
            'endpoint' => 'http://152.69.210.188:8088/efdms/services/api/items',
            'binNumber' => $binNumber,
        ])->get('{+endpoint}/{binNumber}/bin');        
        $data = json_decode($response->getBody()->getContents(), true);
        return response()->json($data);
    }
}
