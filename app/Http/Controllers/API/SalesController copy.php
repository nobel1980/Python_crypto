<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SalesController extends Controller
{
    public function invoice_bulk(Request $request)
    {

        $data = $request->all();
        $json_data = json_encode($data);
        //$json_data = "{'bin': '002382437-0103', 'deviceId': 37037}";
        //$json_data = ' "{\"bin\":\"002382437-0103\",\"deviceId\":37037}" ';
        //$json_data = json_encode($data, JSON_UNESCAPED_SLASHES);
        //$json_data = json_encode($data, JSON_PRETTY_PRINT);

        // $json_data = [
        //     "bin" => "002382437-0103",
        //     "deviceId" => 37036
        // ];

        //$json_data = '{"bin":"002382437-0103","deviceId":37037}';

        // print_r($json_data);        
        // exit();
        $encryptedData = [];
        $return_var = 0;
    
        $pythonPath = ' "C:\\Users\\IT BD\Python\\python.exe" 2>&1';
        $encryptPath = ' "C:\\Users\\IT BD\\Python\\Scripts\\encrypt.py" 2>&1';
        $command = $pythonPath . ' ' . $encryptPath . ' --json_data ' . escapeshellarg($json_data);        
        exec($command, $encryptedData, $return_var);
        //$response = exec($command);
        
        print_r($encryptedData);


        $json_data = json_encode($encryptedData);
        $decryptedData = [];
        $return_var = 0;
        //$chipher_data = 'b'gAAAAABmqgwXy3m1llAeWRlVcVw_ExHAIPc8txRb2QNmtT5lm5rZmsxeEkCdOaPcYqhGV-927XY-_3sCoHUO90hTlYkhe_YWEWX8noYYizSyq-fASaWmhVcqimAN-NTEI5ZLmhFPvgG8'' 
        $pythonPath = ' "C:\\Users\\IT BD\Python\\python.exe" 2>&1';
        $decryptPath = ' "C:\\Users\\IT BD\\Python\\Scripts\\decrypt.py" 2>&1';
        $command = $pythonPath . $decryptPath . $json_data;        
        exec($command, $decryptedData, $return_var);
        //$response = exec($command);

        print_r($decryptedData);

        /*        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $request->bearerToken()
        ])
        ->withOptions([
            'verify' => storage_path('app/cacert.pem'),
        ])
        ->post('http://152.69.210.188:8088/efdms/services/api/invoices/bulk');

        $data = json_decode($response->getBody()->getContents(), true);
        return response()->json($data);
        */
    }

    public function invoice_create(Request $request)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $request->bearerToken()
        ])
        ->withOptions([
            'verify' => storage_path('app/cacert.pem'),
        ])
        ->post('http://152.69.210.188:8088/efdms/services/api/invoices/create');

        $data = json_decode($response->getBody()->getContents(), true);
        return response()->json($data);
    }
}
