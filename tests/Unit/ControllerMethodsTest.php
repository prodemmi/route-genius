<?php

namespace Prodemmi\RouteGenius\Tests;

use Prodemmi\RouteGenius\Tests\Unit\Http\Controllers\V1\AppController as V1;

class ControllerMethodsTest extends TestCase
{
    public function test_controller_v1_index_method_has_get_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'index', 'Get');

        $this->assertNotNull($attr);
        $this->assertEquals('get', $attr->getKey());
    }

    public function test_controller_v1_single_method_has_withoutMiddleware_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'single', 'WithoutMiddleware');

        $this->assertNotNull($attr);
        $this->assertEquals('withoutMiddleware', $attr->getKey());
        $this->assertEquals('api', $attr->getMiddleware());
    }

    public function test_controller_v1_single_method_has_whereUuid_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'single', 'WhereUuid');

        $this->assertNotNull($attr);
        $this->assertEquals('whereUuid', $attr->getKey());
        $this->assertEquals('uuid', $attr->getParameters());
    }

    public function test_controller_v1_update_method_has_whereNumber_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'update', 'WhereNumber');

        $this->assertNotNull($attr);
        $this->assertEquals('whereNumber', $attr->getKey());
        $this->assertEquals([ 'id' ], $attr->getParameters());
    }

    public function test_controller_v1_categories_method_has_whereIn_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'categories', 'WhereIn');

        $this->assertNotNull($attr);
        $this->assertEquals('whereIn', $attr->getKey());
        $this->assertEquals([ 'cats', 'dogs' ], $attr->getValues());
    }

    public function test_controller_v1_store_method_has_post_and_name_attribute()
    {
        $postAttr = $this->getControllerMethodByName(V1::class, 'store', 'Post');
        $nameAttr = $this->getControllerMethodByName(V1::class, 'store', 'Name');

        $this->assertNotNull($postAttr);
        $this->assertEquals('post', $postAttr->getKey());
        $this->assertEquals('post', $postAttr->getMethod());
        $this->assertEquals('/', $postAttr->getRoute());

        $this->assertNotNull($nameAttr);
        $this->assertEquals('name', $nameAttr->getKey());
        $this->assertEquals('store', $nameAttr->getName());
    }

    public function test_controller_v1_destroy_method_has_delete_and_whereAlphaNumeric_attribute()
    {
        $deleteAttr            = $this->getControllerMethodByName(V1::class, 'destroy', 'Delete');
        $whereAlphaNumericAttr = $this->getControllerMethodByName(V1::class, 'destroy', 'WhereAlphaNumeric');

        $this->assertNotNull($deleteAttr);
        $this->assertEquals('delete', $deleteAttr->getKey());
        $this->assertEquals('delete', $deleteAttr->getMethod());
        $this->assertEquals('/{uuid}', $deleteAttr->getRoute());

        $this->assertNotNull($whereAlphaNumericAttr);
        $this->assertEquals('whereAlphaNumeric', $whereAlphaNumericAttr->getKey());
        $this->assertEquals('uuid', $whereAlphaNumericAttr->getParameters());
    }

    public function test_controller_v1_update_method_has_put_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'update', 'Put');

        $this->assertNotNull($attr);
        $this->assertEquals('put', $attr->getKey());
        $this->assertEquals('put', $attr->getMethod());
        $this->assertEquals('/{id}', $attr->getRoute());
    }

    public function test_controller_v1_ulid_method_has_whereUlid_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'ulid', 'WhereUlid');

        $this->assertNotNull($attr);
        $this->assertEquals('whereUlid', $attr->getKey());
        $this->assertEquals([ 'ulid' ], $attr->getParameters());
    }

    public function test_controller_v1_updateWithPatch_method_has_patch_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'updateWithPatch', 'Patch');

        $this->assertNotNull($attr);
        $this->assertEquals('patch', $attr->getKey());
        $this->assertEquals('patch', $attr->getMethod());
        $this->assertEquals('/{uuid}', $attr->getRoute());
    }

    public function test_controller_v1_updateWithPatch_method_has_whereAlpha_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'updateWithPatch', 'WhereAlpha');

        $this->assertNotNull($attr);
        $this->assertEquals('whereAlpha', $attr->getKey());
        $this->assertEquals('uuid', $attr->getParameters());
    }

    public function test_controller_v1_options_method_has_options_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'options', 'Options');

        $this->assertNotNull($attr);
        $this->assertEquals('options', $attr->getKey());
        $this->assertEquals('options', $attr->getMethod());
        $this->assertEquals('/', $attr->getRoute());
    }

    public function test_controller_v1_redirect_method_has_redirect_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'redirect', 'Redirect');

        $this->assertNotNull($attr);
        $this->assertEquals('redirect', $attr->getKey());
        $this->assertEquals('redirect', $attr->getMethod());
        $this->assertEquals('/v1', $attr->getRoute());
        $this->assertEquals('/v2', $attr->getDestination());
        $this->assertEquals(false, $attr->isPermanent());
    }

    public function test_controller_v1_any_method_has_any_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'any', 'Any');

        $this->assertNotNull($attr);
        $this->assertEquals('any', $attr->getKey());
        $this->assertEquals('any', $attr->getMethod());
        $this->assertEquals('/', $attr->getRoute());
    }

    public function test_controller_v1_match_method_has_routeMatch_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'match', 'RouteMatch');

        $this->assertNotNull($attr);
        $this->assertEquals('match', $attr->getKey());
        $this->assertEquals([ 'post', 'get' ], $attr->getMethod());
        $this->assertEquals('/match', $attr->getRoute());
    }

    public function test_controller_v1_redirectPermanent_method_has_redirect_attribute_with_permanent()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'redirectPermanent', 'Redirect');

        $this->assertNotNull($attr);
        $this->assertEquals('redirect', $attr->getKey());
        $this->assertEquals('redirect', $attr->getMethod());
        $this->assertEquals('/v1', $attr->getRoute());
        $this->assertEquals('/v2', $attr->getDestination());
        $this->assertEquals(true, $attr->isPermanent());
    }

    public function test_controller_v1_view_method_has_view_attribute()
    {
        $attr = $this->getControllerMethodByName(V1::class, 'view', 'View');

        $this->assertNotNull($attr);
        $this->assertEquals('view', $attr->getMethod());
        $this->assertEquals(null, $attr->getRoute());
        $this->assertEquals('welcome', $attr->getView());
        $this->assertEquals([ 'name' => 'Ali' ], $attr->getData());
        $this->assertEquals('view', $attr->getKey());
    }
}