<?php

namespace Prodemmi\RouteGenius\Tests;

use Illuminate\Support\Arr;
use Prodemmi\RouteGenius\RouteGeniusServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp() : void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app) : array
    {
        return [
            RouteGeniusServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }

    protected function getAttribute($classOrMethod, $attribute)
    {
        $reflection = new \ReflectionClass($classOrMethod);
        $attributes = $reflection->getAttributes();
        $attr       = Arr::first($attributes, function ($attr) use ($attribute) {
            return class_basename($attr->getName()) === $attribute;
        });

        return $attr ? $attr->newInstance() : $attr;
    }

    protected function getMethod($classOrMethod, $method) : \ReflectionMethod
    {
        $reflection = new \ReflectionClass($classOrMethod);
        return $reflection->getMethod($method);
    }

    protected function getAttributeFromController($controller, $attribute)
    {
        $controller = app()->make($controller);
        return $this->getAttribute($controller, $attribute);
    }

    protected function getControllerMethodByName($controller, $method, $attribute)
    {
        $controller = app()->make($controller);
        $reflectionMethod = $this->getMethod($controller, $method);

        $attributes = $reflectionMethod->getAttributes();
        $attr       = Arr::first($attributes, function ($attr) use ($attribute) {
            return class_basename($attr->getName()) === $attribute;
        });

        return $attr ? $attr->newInstance() : $attr;
    }
}