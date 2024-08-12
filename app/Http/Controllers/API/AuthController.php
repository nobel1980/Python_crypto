<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Helpers\FernetHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use MNC\Fernet;

class AuthController extends Controller
{
    protected $fernetHelper;

    public function __construct(FernetHelper $fernetHelper)
    {
        $this->fernetHelper = $fernetHelper;
    }

    public function login(Request $request)
    {

        $data = $request->all();
        $json_data = json_encode($data);

        //$fernet = Fernet::create('cw_0x689RpI-jtRR7oE8h_eQsKImvJapLeSbXpwF4e4=');

        $encryptdedData = $this->fernetHelper->encode($json_data);

        // var_dump($encryptdedData);
        // exit();
        
        // Encode a message
        $encryptdedData = $fernet->encode($json_data);

        $decryptdedData = $fernet->decode($encryptdedData);



        //$decryptedData = decrypt($request->input($userLoginInfo));

        //$encryptdedData = encrypt($request->input($userLoginInfo));


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
