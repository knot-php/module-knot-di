<?php
declare(strict_types=1);

namespace KnotModule\KnotDi\Test;

use Throwable;

use KnotModule\KnotDi\Adapter\KnotDiContainerAdapter;
use KnotLib\Di\Container;
use PHPUnit\Framework\TestCase;

final class KnotDiContainerAdapterTest extends TestCase
{
    /**
     * @throws
     */
    public function testGet()
    {
        $di = new Container();
        $adapter = new KnotDiContainerAdapter($di);

        $di->set('foo', 'bar');

        $this->assertEquals('bar', $adapter->get('foo'));

        $di->set('car', new Car());

        $this->assertInstanceOf(Car::class, $adapter->get('car'));

        try{
            $ret = $di->get('baz');

            $this->assertNull($ret);
        }
        catch(Throwable $e){
            $this->fail($e->getMessage());
        }
    }
    /**
     * @throws
     */
    public function testHas()
    {
        $di = new Container();
        $adapter = new KnotDiContainerAdapter($di);

        $di->set('foo', 'bar');

        $this->assertTrue($adapter->has('foo'));
        $this->assertFalse($adapter->has('baz'));
    }
    /**
     * @throws
     */
    public function testOffsetGet()
    {
        $di = new Container();
        $adapter = new KnotDiContainerAdapter($di);

        $di->set('foo', 'bar');

        $this->assertEquals('bar', $adapter['foo']);

        $di->set('car', new Car());

        $this->assertInstanceOf(Car::class, $adapter['car']);

        try{
            $ret = $di['baz'];

            $this->assertNull($ret);
        }
        catch(Throwable $e){
            $this->fail($e->getMessage());
        }
    }
    /**
     * @throws
     */
    public function testOffsetSet()
    {
        $di = new Container();
        $adapter = new KnotDiContainerAdapter($di);

        $di['foo'] = 'bar';

        $this->assertEquals('bar', $adapter['foo']);

        $di['car'] = new Car();

        $this->assertInstanceOf(Car::class, $adapter['car']);
    }
    /**
     * @throws
     */
    public function testOffsetExists()
    {
        $di = new Container();
        $adapter = new KnotDiContainerAdapter($di);

        $di['foo'] = 'bar';

        $this->assertTrue(isset($adapter['foo']));

        $di['car'] = new Car();

        $this->assertTrue(isset($adapter['car']));
        $this->assertFalse(isset($adapter['baz']));
    }
    /**
     * @throws
     */
    public function testOffsetUnset()
    {
        $di = new Container();
        $adapter = new KnotDiContainerAdapter($di);

        $di['foo'] = 'bar';
        unset($adapter['foo']);

        $this->assertFalse(isset($adapter['foo']));
    }
    /**
     * @throws
     */
    /*
    public function testExtend()
    {
        $di = new Container();
        $adapter = new CalgamoDiContainerAdapter($di);

        $di['foo'] = 'bar';

        $adapter->extend('foo', function($component){
            return $component . 'baz';
        });

        $this->assertEquals('barbaz', $adapter['foo']);
    }
    */
}