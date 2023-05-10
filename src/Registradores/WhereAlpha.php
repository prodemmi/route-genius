<?php

namespace Prodemmi\RouteGenius\Registradores;

use Prodemmi\RouteGenius\Contracts\IGetKey;

#[\Attribute]
class WhereAlpha implements IGetKey
{
    public function __construct(private array|string $parameters) { }

    public function getParameters() : string
    {
        return $this->parameters;
    }

    public function getKey(){
        return 'whereAlpha';
    }
}
