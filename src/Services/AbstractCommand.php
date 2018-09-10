<?php

namespace CrCms\AttributeContract\Services;

use Illuminate\Console\Command;
use Illuminate\Foundation\Application;

/**
 * Class AbstractCommand
 * @package CrCms\AttributeContract\Services
 */
abstract class AbstractCommand
{
    protected $command;

    protected $connection;

    public function __construct(Application $app,Command $command)
    {
        $this->command = $command;
        $this->connection = $app->make('attribute.manager');
    }

//    abstract public function handle(...$params);
}