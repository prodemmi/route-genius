<?php

namespace Prodemmi\RouteGenius\Contracts;

interface IRoute {
    public function getMethod();
    public function getRoute();
    public function getKey();
}