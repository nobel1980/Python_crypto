<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $userLoginInfo = $request->all();

        //$decryptedData = decrypt($request->input($userLoginInfo));

        //$encryptdedData = encrypt($request->input($userLoginInfo));

        var_dump($userLoginInfo);
        exit();

        $encryptedResponse = encrypt($response->body());


        $response = Http::post('https://bankapi.fareastlife.com/api/login', [
            'email' => 'eximbank@fareastislamilife.com',
            'password' => '12345678',
        ]);

        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'This User does not exist, check your details'], 400);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }

    public function refresh_token(Request $request)
    {
        $response = Http::withOptions([
            'verify' => storage_path('app/cacert.pem'),
        ])
        ->post('https://efdmsapi.nbr.gov.bd/efdms/services/api/auth/refreshtoken');

        $data = json_decode($response->getBody()->getContents(), true);
        return response()->json($data);
    }
}
