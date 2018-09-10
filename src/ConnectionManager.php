<?php

namespace CrCms\AttributeContract;

use Illuminate\Foundation\Application;

/**
 * Class ConnectionManager
 * @package CrCms\AttributeContract
 */
class ConnectionManager
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var ConnectionFactory
     */
    protected $factory;

    /**
     * @var array
     */
    protected $connections = [];

    /**
     * ConnectionManager constructor.
     * @param Application $app
     * @param ConnectionFactory $factory
     */
    public function __construct(Application $app, ConnectionFactory $factory)
    {
        $this->app = $app;
        $this->factory = $factory;
    }

    /**
     * @param null|string $driver
     */
    public function makeConnection(?string $driver = null)
    {
        return $this->factory::factory($this->configure($driver));
    }

    /**
     * @param null|string $driver
     * @return mixed
     */
    public function connection(?string $driver = null)
    {
        if (!isset($this->connections[$driver])) {
            $this->connections[$driver] = $this->makeConnection($driver);
        }

        return $this->connections[$driver];
    }

    /**
     * @param null|string $driver
     * @return mixed
     */
    protected function configure(?string $driver = null)
    {
        if (!$driver) {
            $driver = $this->app->make('config')->get('attribute.default');
        }

        return $this->app->make('config')->get("attribute.connections.{$driver}");
    }

    /**
     * @param string $name
     * @param array $arguments
     * @return mixed
     */
    public function __call(string $name, array $arguments)
    {
        return $this->connection()->$name(...$arguments);
    }
}