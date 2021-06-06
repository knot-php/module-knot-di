<?php
declare(strict_types=1);

namespace knotphp\module\knotdi;

use Throwable;

use knotlib\di\Container;
use knotlib\kernel\module\ModuleInterface;
use knotlib\kernel\exception\ModuleInstallationException;
use knotlib\kernel\kernel\ApplicationInterface;
use knotlib\kernel\eventstream\Channels;
use knotlib\kernel\eventstream\Events;
use knotlib\kernel\module\ComponentTypes;

use knotphp\module\knotdi\adapter\KnotDiContainerAdapter;

class KnotDiModule implements ModuleInterface
{
    /**
     * Declare dependency on another modules
     *
     * @return array
     */
    public static function requiredModules() : array
    {
        return [];
    }

    /**
     * Declare dependent on components
     *
     * @return array
     */
    public static function requiredComponentTypes() : array
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