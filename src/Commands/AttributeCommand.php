<?php

namespace CrCms\AttributeContract\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

/**
 * Class AttributeCommand
 * @package CrCms\AttributeContract\Commands
 */
class AttributeCommand extends Command
{
    protected $signature = 'make:attribute {action : list create update delete}';


    public function handle()
    {
        $action = $this->argument('action');

        $class = 'CrCms\AttributeContract\Services\Command\\'.Str::ucfirst($action).'Command';
        (new $class(app(),$this))->handle();
    }
}