<?php

namespace Prodemmi\RouteGenius\Registradores;

use Prodemmi\RouteGenius\Contracts\IGetKey;

#[\Attribute]
class RouteNamespace implements IGetKey
{
    public function __construct(private string $namespace){}

    public function getRouteNamespace(): string
    {
        return $this->namespace;
    }

    public function getKey(){
        return 'namespace';
    }
}
