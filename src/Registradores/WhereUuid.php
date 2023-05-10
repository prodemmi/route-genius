<?php

namespace Prodemmi\RouteGenius\Registradores;

use Prodemmi\RouteGenius\Contracts\IGetKey;

#[\Attribute]
class WhereUuid implements IGetKey
{
    public function __construct(private array|string $parameters) { }

    public function getParameters() : array|string
    {
        return $this->parameters;
    }

    public function getKey(){
        return 'whereUuid';
    }
}
