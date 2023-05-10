<?php

namespace Prodemmi\RouteGenius\Routes;

use Prodemmi\RouteGenius\Contracts\IRoute;

#[\Attribute]
class RouteMatch implements IRoute
{
    public function __construct(private array $methods, private string $route) { }

    public function getMethod() : array
    {
        return $this->methods;
    }

    public function getRoute() : string
    {
        return $this->route;
    }

    public function getKey() : string
    {
        return 'match';
    }
}
