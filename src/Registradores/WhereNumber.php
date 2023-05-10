<?php

namespace Prodemmi\RouteGenius\Registradores;

use Prodemmi\RouteGenius\Contracts\IGetKey;

#[\Attribute]
class WhereNumber implements IGetKey
{
    public function __construct(private array|string $parameters) { }

    public function getParameters() : string|array
    {
        return $this->parameters;
    }

    public function getKey(){
        return 'whereNumber';
    }
}
