<?php
declare(strict_types=1);

namespace knotphp\module\knotdi\test;

use PHPUnit\Framework\TestCase;

use knotlib\kernel\di\DiContainerInterface;
use knotlib\kernel\nullobject\NullDi;

use knotphp\module\knotdi\KnotDiModule;
use knotphp\module\knotdi\test\classes\TestApplication;

final class KnotDiModuleTest extends TestCase
{
    /**
     * @throws
     */
    public function testInstall()
    {
        $module = new KnotDiModule();
        $app = new TestApplication();

        $module->install($app);

        $this->assertInstanceOf(DiContainerInterface::class, $app->di());
        $this->assertNotInstanceOf(NullDi::class, $app->di());
    }
}