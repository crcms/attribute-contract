<?php

namespace CrCms\AttributeContract;

use CrCms\AttributeContract\Commands\AttributeCommand;
use CrCms\AttributeContract\Commands\CreateCommand;
use Illuminate\Support\ServiceProvider;

/**
 * Class AttributeContractServiceProvider
 * @package CrCms\AttributeContract
 */
class AttributeContractServiceProvider extends ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @var string
     */
    protected $namespaceName = 'attribute';

    /**
     * @var string
     */
    protected $packagePath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

    /**
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            $this->packagePath . 'config/config.php' => config_path($this->namespaceName . '.php'),
        ]);
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //merge config
        $configFile = $this->packagePath . "config/config.php";
        $this->mergeConfigFrom($configFile, $this->namespaceName);
    }
}