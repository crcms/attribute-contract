<?php

namespace CrCms\AttributeContract\Commands;

use Illuminate\Console\Command;

/**
 * Class AttributeCommand
 * @package CrCms\AttributeContract\Commands
 */
class AttributeCommand extends Command
{
    protected $name = 'make:attribute {action}';


    public function handle()
    {
        $name = $this->ask('Please Input constant name');

        $value = $this->ask('Please Input constant value');

        $appAsk = $this->confirm('Is it set to APP private attribute?');//$this->ask('Is confirm private app?',['Yes','No']);
        $app = $appAsk === 'Yes' ? config('attribute.app') : null;
        if (empty($app)) {
            $this->error("Please configure the constant application");
            exit();
        }

        if ($this->confirm('Are you sure you want to add this constant?')) {

        }
    }
}