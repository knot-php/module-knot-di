<?php
declare(strict_types=1);

namespace knotphp\module\knotdi\test\classes;

use knotlib\kernel\filesystem\FileSystemInterface;
use knotlib\kernel\filesystem\AbstractFileSystem;
use knotlib\kernel\filesystem\Dir;

final class TestFileSystem extends AbstractFileSystem implements FileSystemInterface
{
    /** @var string */
    private $base_dir;

    /** @var bool */
    private $no_plugin_dir;

    public function __construct(string $base_dir, bool $no_plugin_dir = false)
    {
        $this->base_dir = $base_dir;
        $this->no_plugin_dir = $no_plugin_dir;
    }

    public function getDirectory(int $dir): string
    {
        $map = [
            Dir::DATA      => $this->base_dir . '/data',
            Dir::COMMAND   => $this->base_dir . '/command',
            Dir::PLUGIN    => $this->no_plugin_dir ? $this->base_dir : $this->base_dir . '/plugin',
            Dir::CACHE     => $this->base_dir . '/cache',
            Dir::CONFIG    => $this->base_dir . '/config',
            Dir::LOGS      => $this->base_dir . '/logs',
            Dir::INCLUDE   => $this->base_dir . '/include',
        ];
        return $map[$dir] ?? parent::getDirectory($dir);
    }
}