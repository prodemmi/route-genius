<?php

namespace Prodemmi\RouteGenius\Registradores;

use Prodemmi\RouteGenius\Contracts\IGetKey;

#[\Attribute]
class Domain implements IGetKey
{
    public function __construct(private string $domain) { }

    public function getDomain() : string
    {
        return $this->domain;
    }

    public function getKey(){
        return 'domain';
    }
}
