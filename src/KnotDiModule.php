<?php
declare(strict_types=1);

namespace KnotPhp\Module\KnotDi;

use Throwable;

use KnotLib\Di\Container;
use KnotLib\Kernel\Module\AbstractModule;
use KnotLib\Kernel\Exception\ModuleInstallationException;
use KnotLib\Kernel\Kernel\ApplicationInterface;
use KnotLib\Kernel\EventStream\Channels;
use KnotLib\Kernel\EventStream\Events;
use KnotLib\Kernel\Module\ComponentTypes;

use KnotPhp\Module\KnotDi\Adapter\KnotDiContainerAdapter;

class KnotDiModule extends AbstractModule
{
    /**
     * Declare dependent on components
     *
     * @return array
     */
    public static function requiredComponents() : array
    {
        return [
            ComponentTypes::EVENTSTREAM,
            ComponentTypes::LOGGER,
        ];
    }

    /**
     * Declare component type of this module
     *
     * @return string
     */
    public static function declareComponentType() : string
    {
        return ComponentTypes::DI;
    }

    /**
     * Install module
     *
     * @param ApplicationInterface $app
     *
     * @throws  ModuleInstallationException
     */
    public function install(ApplicationInterface $app)
    {
        try{
            $di = new KnotDiContainerAdapter(new Container);
            $app->di($di);

            // fire event
            $app->eventstream()->channel(Channels::SYSTEM)->push(Events::DI_ATTACHED, $di);
        }
        catch(Throwable $e)
        {
            throw new ModuleInstallationException(self::class, $e->getMessage(), 0, $e);
        }
    }
}