<?php

namespace Prodemmi\RouteGenius\Registradores;

use Prodemmi\RouteGenius\Contracts\IGetKey;

#[\Attribute]
class WhereIn implements IGetKey
{
    public function __construct(private array|string $parameters, private array $values) { }

    public function getParameters() : array|string
    {
        return $this->parameters;
    }

    public function getValues() : array
    {
        return $this->values;
    }

    public function getKey(){
        return 'whereIn';
    }
}
