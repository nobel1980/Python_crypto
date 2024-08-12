<?php

namespace App\Helpers;

//use MNC\Fernet;

use MNC\Fernet;

class FernetHelper
{
    protected $fernet;

    public function __construct()
    {
        $this->fernet = Fernet::create('cw_0x689RpI-jtRR7oE8h_eQsKImvJapLeSbXpwF4e4=');
      }

    public function encode($data)
    {
        return $this->fernet->encode($data);
    }

    public function decode($data)
    {
        return $this->fernet->decode($data);
    }
}