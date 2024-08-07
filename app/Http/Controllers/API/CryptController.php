<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use MNC\Fernet;

class CryptController extends Controller
{
    public function encrypt(Request $request)
    {
        $data = $request->all();
        $json_data = json_encode($data);
        /* laravel encrypt default */
        //$encryptdedData = encrypt($request->input($userLoginInfo));

        $fernet = Fernet::create('cw_0x689RpI-jtRR7oE8h_eQsKImvJapLeSbXpwF4e4=');

        // Encode a message
        $ciphertext = $fernet->encode($json_data);

        var_dump($json_data, $ciphertext);
        exit();

    }

    public function decrypt(Request $request)
    {

    }
}
