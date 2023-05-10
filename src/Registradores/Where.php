<?php

namespace Prodemmi\RouteGenius\Registradores;

use Prodemmi\RouteGenius\Contracts\IGetKey;

#[\Attribute]
class Where implements IGetKey
{
    public function __construct(private string $where, private string $values) { }

    public function getParameters() : string
    {
        return $this->where;
    }

    public function getValues() : string
    {
        return $this->values;
    }

    public function getKey()
    {
        return 'where';
    }
}
