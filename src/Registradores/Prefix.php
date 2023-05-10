<?php

namespace Prodemmi\RouteGenius\Registradores;

use Prodemmi\RouteGenius\Contracts\IGetKey;

#[\Attribute]
class Prefix implements IGetKey
{
    public function __construct(private string $prefix) { }

    public function getPrefix() : string
    {
        return $this->prefix;
    }

    public function getKey(){
        return 'prefix';
    }
}
