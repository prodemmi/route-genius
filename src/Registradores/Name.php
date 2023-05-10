<?php

namespace Prodemmi\RouteGenius\Registradores;

use Prodemmi\RouteGenius\Contracts\IGetKey;

#[\Attribute]
class Name implements IGetKey
{
    public function __construct(private string $name) { }

    public function getName() : string
    {
        return $this->name;
    }

    public function getKey(){
        return 'name';
    }
}
