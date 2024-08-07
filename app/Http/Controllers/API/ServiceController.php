<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ServiceController extends Controller
{
    public function device_status(Request $request, $binNumber)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $request->bearerToken()
        ])
        ->withOptions([
            'verify' => storage_path('app/cacert.pem'),
        ])
        ->withUrlParameters([
            'endpoint' => 'http://152.69.210.188:8088/efdms/services/api/inventory/devices/dto',
            'binNumber' => $binNumber,
        ])->get('{+endpoint}/{binNumber}/slno'); 

        //->get('https://efdmsapi.nbr.gov.bd/efdms/services/api/inventory/devices/dto/004296313-0101/slno');

        $data = json_decode($response->getBody()->getContents(), true);
        return response()->json($data);
    }
      /* 9. GET DEVICE DATA DETAILS FOR INVENTORY */
    public function device_data(Request $request, $deviceNumber)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $request->bearerToken()
        ])
        ->withOptions([
            'verify' => storage_path('app/cacert.pem'),
        ])
        ->withUrlParameters([
            'endpoint' => 'http://152.69.210.188:8088/efdms/services/api/inventory/devices',
            'deviceNumber' => $deviceNumber,
        ])->get('{+endpoint}/{deviceNumber}/slno'); 

        $data = json_decode($response->getBody()->getContents(), true);
        return response()->json($data);
    }

    public function policies_dto(Request $request)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $request->bearerToken()
        ])
        ->withOptions([
            'verify' => storage_path('app/cacert.pem'),
        ])
        ->get('https://efdmsapi.nbr.gov.bd/efdms/services/api/settings/policies/dto');

        $data = json_decode($response->getBody()->getContents(), true);
        return response()->json($data);
    }

    public function devices_all(Request $request)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $request->bearerToken()
        ])
        ->withOptions([
            'verify' => storage_path('app/cacert.pem'),
        ])
        ->get('https://efdmsapi.nbr.gov.bd/efdms/services/api/inventory/devices/all');

        $data = json_decode($response->getBody()->getContents(), true);
        return response()->json($data);
    }

    public function server_date(Request $request)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $request->bearerToken()
        ])
        ->withOptions([
            'verify' => storage_path('app/cacert.pem'),
        ])
        ->get('https://efdmsapi.nbr.gov.bd/efdms/services/api/inventory/devices/sysdate');

        $data = json_decode($response->getBody()->getContents(), true);
        return response()->json($data);
    }

    public function invoice_details(Request $request, $invoiceNo)
    {
        
        /*
        $response = $client->get('https://efdmsapi.nbr.gov.bd/efdms/services/api/invoices/items/', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $request->bearerToken()
            ],
            'query' => [
                'invoiceNo' => $invoiceNo,
            ],
        ]);
      */
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $request->bearerToken()
        ])
        ->withOptions([
            'verify' => storage_path('app/cacert.pem'),
        ])
        ->get('https://efdmsapi.nbr.gov.bd/efdms/services/api/invoices/items/', [
            'invoiceNo' => $invoiceNo,
        ]);

        $data = json_decode($response->getBody()->getContents(), true);
        return response()->json($data);
    }
    public function category_all(Request $request)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $request->bearerToken()
        ])
        ->withOptions([
            'verify' => storage_path('app/cacert.pem'),
        ])
        ->post('http://152.69.210.188:8088/efdms/services/api/settings/service/categories/all');

        $data = json_decode($response->getBody()->getContents(), true);
        return response()->json($data);
    }
}
