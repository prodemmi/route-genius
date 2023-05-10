<?php

namespace Prodemmi\RouteGenius\Routes;

use Prodemmi\RouteGenius\Contracts\IRoute;

#[\Attribute]
class Redirect implements IRoute
{
    public function __construct(private string $source, private string $destination, private bool $permanent = false) { }

    public function getMethod() : string
    {
        return 'redirect';
    }

    public function getRoute() : string
    {
        return $this->source;
    }

    public function getDestination() : string
    {
        return $this->destination;
    }

    public function isPermanent() : bool
    {
        return $this->permanent;
    }

    public function getKey() : string
    {
        return 'redirect';
    }
}
