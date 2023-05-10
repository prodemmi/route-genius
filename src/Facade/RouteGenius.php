<?php

namespace Prodemmi\RouteGenius\Facade;

use Illuminate\Support\Facades\Facade;

class RouteGenius extends Facade
{
    protected static function getFacadeAccessor() : string
    {
        return 'routeGenius';
    }
}