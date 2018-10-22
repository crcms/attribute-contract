<?php

namespace CrCms\AttributeContract\Tests;

use CrCms\AttributeContract\Attribute;
use CrCms\DataCenter\DataContract;
use CrCms\Tests\CreatesApplication;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Support\Str;

/**
 * Class AttributeTest
 * @package CrCms\AttributeContract\Tests
 */
class AttributeTest extends TestCase
{
    use CreatesApplication;

    public function testTablePut()
    {
        /* @var DataContract $connection */
        $connection = $this->app->make('data-center.manager')->connection(config('attribute.connection', 'attribute'));
        $value = Str::random(10);
        config('data-center.database.refresh',0);
        $connection->put('user.abc', $value);
        $this->assertEquals($value,$connection->get('user.abc'));
        return $value;
    }

    /**
     * @depends testTablePut
     */
    public function testTableGet(string $value)
    {
        $attribute = Attribute::get('user', 'abc');
        $this->assertEquals($value, $attribute);
    }

    /**
     * @depends testTablePut
     * @param string $value
     */
    public function testEqual(string $value)
    {
        $result = Attribute::equal('user','abc', $value);
        $this->assertEquals(true, $result);
    }


//    public function testModelGet()
//    {
//
//    }
//
//    public function testModelInstanceGet()
//    {
//
//    }
//
//    public function testEqual()
//    {
//
//    }
}