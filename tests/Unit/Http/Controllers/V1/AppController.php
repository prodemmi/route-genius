<?php

namespace Prodemmi\RouteGenius\Tests\Unit\Http\Controllers\V1;

use Illuminate\Routing\Controller as BaseController;
use Prodemmi\RouteGenius\Registradores\Middleware;
use Prodemmi\RouteGenius\Registradores\Name;
use Prodemmi\RouteGenius\Registradores\Prefix;
use Prodemmi\RouteGenius\Registradores\RouteNamespace;
use Prodemmi\RouteGenius\Registradores\WhereAlpha;
use Prodemmi\RouteGenius\Registradores\WhereAlphaNumeric;
use Prodemmi\RouteGenius\Registradores\WhereIn;
use Prodemmi\RouteGenius\Registradores\WhereNumber;
use Prodemmi\RouteGenius\Registradores\WhereUlid;
use Prodemmi\RouteGenius\Registradores\WhereUuid;
use Prodemmi\RouteGenius\Registradores\WithoutMiddleware;
use Prodemmi\RouteGenius\Routes\Any;
use Prodemmi\RouteGenius\Routes\Delete;
use Prodemmi\RouteGenius\Routes\Get;
use Prodemmi\RouteGenius\Routes\Options;
use Prodemmi\RouteGenius\Routes\Patch;
use Prodemmi\RouteGenius\Routes\Post;
use Prodemmi\RouteGenius\Routes\Put;
use Prodemmi\RouteGenius\Routes\Redirect;
use Prodemmi\RouteGenius\Routes\RouteMatch;
use Prodemmi\RouteGenius\Routes\View;

#[Middleware( 'api' ), Prefix( 'api/v1' ), RouteNamespace('App\\Http\\Controllers\\V1\\')]
#[Name('v1')]
class AppController extends BaseController
{
    #[Get( '/' )]
    public function index(){}

    #[Get( '/{uuid}' ), WithoutMiddleware( 'api' ), WhereUuid('uuid')]
    public function single($uuid){}

    #[Get( '/categories/{category}' ), WhereIn( 'category', ['cats', 'dogs'] )]
    public function categories($category){}

    #[Post( '/' ), Name( 'store' )]
    public function store() {}

    #[Put( '/{id}' ), WhereNumber(['id'])]
    public function update($id){}

    #[Get( '/ulid/{ulid}' ), WhereUlid(['ulid'])]
    public function ulid($uuid){}

    #[Patch( '/{uuid}' ), WhereAlpha('uuid')]
    public function updateWithPatch($uuid){}

    #[Options( '/' )]
    public function options(){}

    #[Any( '/' )]
    public function any(){}

    #[RouteMatch( ['post', 'get'], '/match' )]
    public function match(){}

    #[Redirect( '/v1', '/v2' )]
    public function redirect(){}

    #[Redirect( '/v1', '/v2', true)]
    public function redirectPermanent(){}

    #[Delete( '/{uuid}' ), WhereAlphaNumeric('uuid')]
    public function destroy($uuid){}

    #[View( 'welcome', ['name' => 'Ali'] )]
    public function view($uuid){}
}
