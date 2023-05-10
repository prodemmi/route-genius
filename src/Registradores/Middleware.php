<?php

namespace Prodemmi\RouteGenius\Registradores;

use Prodemmi\RouteGenius\Contracts\IGetKey;

#[\Attribute]
class Middleware implements IGetKey
{
    public function __construct(private array|string|null $middleware) { }

    public function getMiddleware() : array|string|null
    {
        return $this->middleware;
    }

    public function getKey(){
        return 'middleware';
    }
}
