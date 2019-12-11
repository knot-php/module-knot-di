<?php
declare(strict_types=1);

namespace KnotModule\KnotDi\Test;

use PHPUnit\Framework\TestCase;

use KnotLib\Kernel\Di\DiContainerInterface;
use KnotLib\Kernel\NullObject\NullDi;
use KnotModule\KnotDi\KnotDiModule;

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