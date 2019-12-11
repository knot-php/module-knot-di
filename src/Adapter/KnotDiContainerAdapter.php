<?php
declare(strict_types=1);

namespace KnotPhp\Module\KnotDi\Adapter;

use KnotLib\Di\ContainerInterface;
use KnotLib\Di\Exception\ContainerException;
use KnotLib\Kernel\Di\DiContainerInterface;
use KnotLib\Kernel\Exception\DiContainerException;

class KnotDiContainerAdapter implements DiContainerInterface
{
    /** @var ContainerInterface */
    private $container;

    /**
     * CalgamoDiContainerAdapter constructor.
     *
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     *  Get component
     *
     * @param mixed $id
     *
     * @return mixed
     *
     * @throws DiContainerException
     */
    public function get($id)
    {
        try{
            return $this->container->get($id);
        }
        catch(ContainerException $e)
        {
            throw new DiContainerException('Getting component failed:' . $e->getMessage(), 0, $e);
        }
    }

    /**
     *  Check if key exists
     *
     * @param string $id
     *
     * @return bool
     */
    public function has($id) : bool
    {
        return $this->container->has($id);
    }

    /**
     *  ArrayAccess interface : offsetGet() implementation
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function offsetGet($id)
    {
        return $this->container->offsetGet($id);
    }

    /**
     *  ArrayAccess interface : offsetSet() implementation
     *
     * @param mixed $id
     * @param mixed $value
     */
    public function offsetSet($id, $value)
    {
        $this->container->offsetSet($id, $value);
    }

    /**
     *  ArrayAccess interface : offsetExists() implementation
     *
     * @param mixed $id
     *
     * @return bool
     */
    public function offsetExists($id)
    {
        return $this->container->offsetExists($id);
    }

    /**
     *  ArrayAccess interface : offsetUnset() implementation
     *
     * @param mixed $id
     */
    public function offsetUnset($id)
    {
        $this->container->offsetUnset($id);
    }

    /**
     * {@inheritDoc}
     */
    public function extend(string $id, callable $extend_callback)
    {
        try{
            $this->container->extend($id, $extend_callback);
        }
        catch(ContainerException $e)
        {
            throw new DiContainerException('Extending component failed:' . $e->getMessage(), 0, $e);
        }
    }
}