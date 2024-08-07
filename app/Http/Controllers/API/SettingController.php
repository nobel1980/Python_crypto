<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SettingController extends Controller
{
    public function binholder_outlet(Request $request, $binNumber)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $request->bearerToken()
        ])
        ->withOptions([
            'verify' => storage_path('app/cacert.pem'),
        ])
        ->withUrlParameters([
            'endpoint' => 'http://152.69.210.188:8088/efdms/services/api/taxpayer/setup/outlets',
            'binNumber' => $binNumber,
        ])->get('{+endpoint}/{binNumber}/bin'); 

        //->get('https://efdmsapi.nbr.gov.bd/efdms/services/api/inventory/devices/dto/004296313-0101/slno');

        $data = json_decode($response->getBody()->getContents(), true);
        return response()->json($data);
    }
}
