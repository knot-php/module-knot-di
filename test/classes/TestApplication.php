<?php
declare(strict_types=1);

namespace knotphp\module\knotdi\test\classes;

use knotlib\kernel\kernel\AbstractApplication;
use knotlib\kernel\kernel\ApplicationInterface;
use knotlib\kernel\kernel\ApplicationType;

final class TestApplication extends AbstractApplication
{
    public static function type(): ApplicationType
    {
        return ApplicationType::of(ApplicationType::CLI);
    }

    public function install(): ApplicationInterface
    {
        foreach($this->getRequiredModules() as $module)
        {
            $this->installModule($module);
        }
        return $this;
    }

    public function installModule(string $module_class) : ApplicationInterface
    {
        $this->addInstalledModule($module_class);
        return $this;
    }
}