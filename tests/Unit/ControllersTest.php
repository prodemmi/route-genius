<?php

namespace Prodemmi\RouteGenius\Tests;

use Prodemmi\RouteGenius\Tests\Unit\Http\Controllers\V1\AppController as V1;
use Prodemmi\RouteGenius\Tests\Unit\Http\Controllers\V2\AppController as V2;

class ControllersTest extends TestCase
{
    public function test_controller_v1_has_api_middleware()
    {
        $attr = $this->getAttributeFromController(V1::class, 'Middleware');

        $this->assertEquals('middleware', $attr->getKey());
        $this->assertEquals('api', $attr->getMiddleware());
    }

    public function test_controller_v1_has_prefix()
    {
        $attr = $this->getAttributeFromController(V1::class, 'Prefix');

        $this->assertEquals('prefix', $attr->getKey());
        $this->assertEquals('api/v1', $attr->getPrefix());
    }

    public function test_controller_v1_has_namespace()
    {
        $attr = $this->getAttributeFromController(V1::class, 'RouteNamespace');

        $this->assertEquals('namespace', $attr->getKey());
        $this->assertEquals('App\\Http\\Controllers\\V1\\', $attr->getRouteNamespace());
    }

    public function test_controller_v1_has_name()
    {
        $attr = $this->getAttributeFromController(V1::class, 'Name');

        $this->assertEquals('name', $attr->getKey());
        $this->assertEquals('v1', $attr->getName());
    }

    public function test_controller_v2_has_prefix()
    {
        $attr = $this->getAttributeFromController(V2::class, 'Prefix');

        $this->assertEquals('prefix', $attr->getKey());
        $this->assertEquals('api/v2', $attr->getPrefix());
    }

    public function test_controller_v2_has_web_middleware()
    {
        $attr = $this->getAttributeFromController(V2::class, 'Middleware');

        $this->assertEquals('middleware', $attr->getKey());
        $this->assertEquals('web', $attr->getMiddleware());
    }

    public function test_controller_v2_has_domain()
    {
        $attr = $this->getAttributeFromController(V2::class, 'Domain');

        $this->assertEquals('domain', $attr->getKey());
        $this->assertEquals('api.example.com', $attr->getDomain());
    }

    public function test_controller_v2_has_not_web_middleware()
    {
        $attr = $this->getAttributeFromController(V2::class, 'WithoutMiddleware');

        $this->assertEquals('withoutMiddleware', $attr->getKey());
        $this->assertEquals('web', $attr->getMiddleware());
    }
}