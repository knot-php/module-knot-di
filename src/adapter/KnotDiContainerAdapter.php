<?php /** @noinspection PhpMissingReturnTypeInspection */
declare(strict_types=1);

namespace knotphp\module\knotdi\adapter;

use knotlib\di\ContainerInterface;
use knotlib\di\exception\ContainerException;
use knotlib\kernel\di\DiContainerInterface;
use knotlib\kernel\exception\DiContainerException;

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
        catch(ContainerException $ex)
        {
            throw new DiContainerException('Getting component failed:' . $ex->getMessage(), $ex);
        }
    }

    /**
     *  Check if key exists
     *
     * @param string $id
     *
     * @return bool
     */
    public function has(string $id) : bool
    {
        return $this->container->has($id);
    }

    /**
     *  ArrayAccess interface : offsetGet() implementation
     *
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->container->offsetGet($offset);
    }

    /**
     *  ArrayAccess interface : offsetSet() implementation
     *
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->container->offsetSet($offset, $value);
    }

    /**
     *  ArrayAccess interface : offsetExists() implementation
     *
     * @param mixed $offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return $this->container->offsetExists($offset);
    }

    /**
     *  ArrayAccess interface : offsetUnset() implementation
     *
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        $this->container->offsetUnset($offset);
    }

    /**
     * {@inheritDoc}
     */
    public function extend(string $id, callable $extend_callback)
    {
        try{
            $this->container->extend($id, $extend_callback);
        }
        catch(ContainerException $ex)
        {
            throw new DiContainerException('Extending component failed:' . $ex->getMessage(), $ex);
        }
    }
}