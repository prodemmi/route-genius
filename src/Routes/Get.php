<?php

namespace Prodemmi\RouteGenius\Routes;

use Prodemmi\RouteGenius\Contracts\IRoute;

#[\Attribute]
class Get implements IRoute
{
    public function __construct(private string $route) { }

    public function getMethod() : string
    {
        return 'get';
    }

    public function getRoute() : string
    {
        return $this->route;
    }


    public function getKey() : string
    {
        return 'get';
    }
}
