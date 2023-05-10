<?php

namespace Prodemmi\RouteGenius\Registradores;

use Prodemmi\RouteGenius\Contracts\IGetKey;

#[\Attribute]
class WithoutMiddleware implements IGetKey
{
    public function __construct(private array|string $middleware) { }

    public function getMiddleware() : array|string|null
    {
        return $this->middleware;
    }

    public function getKey(){
        return 'withoutMiddleware';
    }
}
