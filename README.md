![Laravel Route Genius](./assets/banner.png)

Laravel Route Genius is a package for defining your routes in controllers.

```php
<?php

namespace App\Http\Controllers\V1;

use Illuminate\Routing\Controller as BaseController;
use Prodemmi\RouteGenius\Registradores\Middleware;
use Prodemmi\RouteGenius\Registradores\Name;
use Prodemmi\RouteGenius\Registradores\Prefix;
use Prodemmi\RouteGenius\Registradores\WhereUlid;
use Prodemmi\RouteGenius\Registradores\WithoutMiddleware;
use Prodemmi\RouteGenius\Routes\Get;
use Prodemmi\RouteGenius\Routes\Post;

#[Middleware( 'api' ), Prefix( 'api/v1' )]
class AppController extends BaseController
{
    #[Get( '/' )]
    public function index()
    {
        return 'index';
    }

    #[Get( '/{uuid}' ), WithoutMiddleware( 'api' )]
    public function single($uuid)
    {
        return $uuid;
    }

    #[Get( '/categories/{category}' ), WhereUlid( 'category' )]
    public function categories($category)
    {
        return $category;
    }

    #[Post( '/' ), Name( 'store' )]
    public function store()
    {
        return "Store";
    }
}

```
See [WIKI](https://github.com/prodemmi/route-genius/wiki) for more information.