<?php

namespace Prodemmi\RouteGenius\Tests\Unit\Http\Controllers\V2;

use Illuminate\Routing\Controller as BaseController;
use Prodemmi\RouteGenius\Registradores\Domain;
use Prodemmi\RouteGenius\Registradores\Middleware;
use Prodemmi\RouteGenius\Registradores\Prefix;
use Prodemmi\RouteGenius\Registradores\WithoutMiddleware;
use Prodemmi\RouteGenius\Routes\Get;

#[Middleware( 'web' ), Prefix( 'api/v2' ), Domain('api.example.com')]
#[WithoutMiddleware('web')]
class AppController extends BaseController
{
    #[Get( '/' )]
    public function index($subdomain)
    {
        return 'index v2';
    }

    #[Get( '/{uuid}' )]
    public function single($uuid)
    {
        return "V2 $uuid";
    }
}
