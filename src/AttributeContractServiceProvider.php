<?php

namespace CrCms\AttributeContract;

use CrCms\AttributeContract\Commands\CreateCommand;
use Illuminate\Support\ServiceProvider;

/**
 * Class AttributeContractServiceProvider
 * @package CrCms\AttributeContract
 */
class AttributeContractServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * @var string
     */
    protected $namespaceName = 'attribute';

    /**
     * @var string
     */
    protected $packagePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;


    public function boot(): void
    {
        $this->loadMigrationsFrom($this->packagePath . '/database/migrations');

        $this->publishes([
            $this->packagePath . 'config' => config_path(),
        ]);
    }

    public function register(): void
    {
        //merge config
        $configFile = $this->packagePath . "config/{$this->namespaceName}.php";
        $this->mergeConfigFrom($configFile, $this->namespaceName);

        $this->registerAlias();

        $this->registerConnectionServices();

        $this->registerCommands();
    }

    /**
     * @return void
     */
    protected function registerCommands(): void
    {
        $this->commands([
            'attribute.make'
        ]);
    }

    /**
     * @return void
     */
    protected function registerConnectionServices(): void
    {
        $this->app->singleton('attribute.factory', function ($app) {
            return new ConnectionFactory($app, new Value);
        });

        $this->app->singleton('attribute.manager', function ($app) {
            return new ConnectionManager($app, $this->app->make('attribute.factory'));
        });
    }

    /**
     * @return void
     */
    protected function registerAlias(): void
    {
        $this->app->alias(ConnectionManager::class, 'attribute.manager');
        $this->app->alias(ConnectionFactory::class, 'attribute.factory');
        $this->app->alias(CreateCommand::class, 'attribute.make');
    }
}