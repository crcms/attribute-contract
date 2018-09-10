<?php

namespace CrCms\AttributeContract;

use CrCms\AttributeContract\Connections\DatabaseConnection;
use DomainException;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Foundation\Application;

/**
 * Class ConnectionFactory
 * @package CrCms\AttributeContract
 */
class ConnectionFactory
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Value
     */
    protected $value;

    /**
     * ConnectionFactory constructor.
     * @param Application $app
     * @param Value $value
     */
    public function __construct(Application $app, Value $value)
    {
        $this->app = $app;
        $this->value = $value;
    }

    public function factory(string $driver, array $config)
    {
        switch ($driver) {
            case 'database':
                return new DatabaseConnection(
                    $this->app->make(ConnectionInterface::class), $this->value, $config['table']
                );
        }

        throw new DomainException("Driver {$driver} not exists");
    }
}