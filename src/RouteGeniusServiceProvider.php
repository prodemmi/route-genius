<?php

namespace Prodemmi\RouteGenius;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Prodemmi\RouteGenius\Contracts\IGetKey;
use Prodemmi\RouteGenius\Contracts\IRoute;

class RouteGeniusServiceProvider extends ServiceProvider
{
    public function register() {}

    public function boot()
    {
        $genius = new RouteGenius();
        foreach ( $genius->getRouteData() as $controllerClass => $datum ) {
            $controllerData = data_get($datum, 'controller');
            $methodsData    = data_get($datum, 'methods');
            $attributes     = $this->getControllerAttributes($controllerData);
            Route::group(array_filter($attributes), function () use ($controllerClass, $methodsData) {
                foreach ( $methodsData as $method => $attributes ) {
                    foreach ( $attributes as $attribute ) {
                        $route    = null;
                        $instance = $attribute->newInstance();
                        if ( $instance instanceof IRoute ) {
                            $routeType   = $instance->getKey();
                            $routeMethod = $instance->getMethod();
                            switch ( $routeType ) {
                                case 'redirect':
                                    $route = Route::{$instance->isPermanent() ? 'permanentRedirect' : 'redirect'}($instance->getRoute(), $instance->getDestination());
                                    break;
                                case 'match':
                                    $route = Route::match($routeMethod, $instance->getRoute(), [
                                        $controllerClass, $method
                                    ]);
                                    break;
                                case 'view':
                                    $route = Route::view($instance->getView(), $instance->getData());
                                    break;
                                default:
                                    $route = Route::{$routeMethod}($instance->getRoute(), [
                                        $controllerClass, $method
                                    ]);
                                    break;
                            }
                            $this->getAddAttributes($route, $attributes);
                        }
                    }
                }
            });
        }
    }

    protected function getByKey($data, $key)
    {
        $first = Arr::first($data, function ($d) use ($key) {
            return $d->newInstance()->getKey() === $key;
        });
        if ( $first )
            return $first->newInstance();

        return null;
    }

    protected function getControllerAttributes($data)
    {
        return [
            'prefix'            => $this->getByKey($data, 'prefix')?->getPrefix(),
            'middleware'        => $this->getByKey($data, 'middleware')?->getMiddleware(),
            'withoutMiddleware' => $this->getByKey($data, 'withoutMiddleware')?->getMiddleware(),
            'as'                => $this->getByKey($data, 'name')?->getName(),
            'namespace'         => $this->getByKey($data, 'namespace')?->getNamespace(),
            'domain'            => $this->getByKey($data, 'domain')?->getDomain(),
        ];
    }

    protected function getAddAttributes(&$route, $attributes)
    {
        foreach ( $attributes as $attribute ) {
            $instance = $attribute->newInstance();
            if ( $instance instanceof IGetKey ) {
                $name = $instance->getKey();
                switch ( $name ) {
                    case 'middleware':
                        $route->middleware($instance->getMiddleware());
                        break;
                    case 'withoutMiddleware':
                        $route->withoutMiddleware($instance->getMiddleware());
                        break;
                    case 'where':
                        $route->where($instance->getParameters(), $instance->getValues());
                        break;
                    case 'whereIn':
                        $this->whereIn($route, $instance->getParameters(), $instance->getValues());
                        break;
                    case 'whereAlpha':
                        $this->whereAlpha($route, $instance->getParameters());
                        break;
                    case 'whereNumber':
                        $this->whereNumber($route, $instance->getParameters());
                        break;
                    case 'whereAlphaNumeric':
                        $this->whereAlphaNumeric($route, $instance->getParameters());
                        break;
                    case 'whereUuid':
                        $this->whereUuid($route, $instance->getParameters());
                        break;
                    case 'whereUlid':
                        $this->whereUlid($route, $instance->getParameters());
                        break;
                    case 'name':
                        $route->name($instance->getName());
                        break;
                }
            }
        }
    }

    /**
     * Specify that the given route parameters must be alphabetic.
     *
     * @param array|string $parameters
     *
     * @return $this
     */
    public function whereAlpha($route, $parameters)
    {
        return $this->assignExpressionToParameters($route, $parameters, '[a-zA-Z]+');
    }

    /**
     * Specify that the given route parameters must be alphanumeric.
     *
     * @param array|string $parameters
     *
     * @return $this
     */
    public function whereAlphaNumeric($route, $parameters)
    {
        return $this->assignExpressionToParameters($route, $parameters, '[a-zA-Z0-9]+');
    }

    /**
     * Specify that the given route parameters must be numeric.
     *
     * @param array|string $parameters
     *
     * @return $this
     */
    public function whereNumber($route, $parameters)
    {
        return $this->assignExpressionToParameters($route, $parameters, '[0-9]+');
    }

    /**
     * Specify that the given route parameters must be ULIDs.
     *
     * @param array|string $parameters
     *
     * @return $this
     */
    public function whereUlid($route, $parameters)
    {
        return $this->assignExpressionToParameters($route, $parameters, '[0-7][0-9a-hjkmnp-tv-zA-HJKMNP-TV-Z]{25}');
    }

    /**
     * Specify that the given route parameters must be UUIDs.
     *
     * @param array|string $parameters
     *
     * @return $this
     */
    public function whereUuid($route, $parameters)
    {
        return $this->assignExpressionToParameters($route, $parameters, '[\da-fA-F]{8}-[\da-fA-F]{4}-[\da-fA-F]{4}-[\da-fA-F]{4}-[\da-fA-F]{12}');
    }

    /**
     * Specify that the given route parameters must be one of the given values.
     *
     * @param array|string $parameters
     * @param array        $values
     *
     * @return $this
     */
    public function whereIn($route, $parameters, array $values)
    {
        return $this->assignExpressionToParameters($route, $parameters, implode('|', $values));
    }

    protected function assignExpressionToParameters($route, $parameters, $expression)
    {
        return $route->where(collect(Arr::wrap($parameters))
            ->mapWithKeys(fn ($parameter) => [ $parameter => $expression ])
            ->all());
    }
}
