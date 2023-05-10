<?php

namespace Prodemmi\RouteGenius\Routes;

use Prodemmi\RouteGenius\Contracts\IRoute;

#[\Attribute]
class View implements IRoute
{
    public function __construct(private string $view, private array|null $data = null)
    {
    }

    public function getMethod(): string
    {
        return 'view';
    }

    public function getRoute()
    {
        return null;
    }

    public function getView()
    {
        return $this->view;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getKey(): string
    {
        return 'view';
    }
}
