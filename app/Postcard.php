<?php

namespace App;

use Illuminate\Support\Facades\Facade;

class Postcard extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Postcard'; // This should match the binding key in the service container
    }
}
