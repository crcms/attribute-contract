<?php

namespace CrCms\AttributeContract\Services\Command;

use CrCms\AttributeContract\Services\AbstractCommand;
use Illuminate\Console\Command;

/**
 * Class CreateCommand
 * @package CrCms\AttributeContract\Services\Command
 */
class CreateCommand extends AbstractCommand
{
    public function handle()
    {
        /*$name = $params[0];
        $value = $params[1];
        $app = $params[2];
        $remark = $params[3];*/

        $key = $this->command->ask('Please Input constant name');

        $value = $this->command->ask('Please Input constant value');

        $appAsk = $this->command->confirm('Is it set to APP private attribute?');//$this->ask('Is confirm private app?',['Yes','No']);
        $app = $appAsk === 'yes' ? config('attribute.app') : null;
//        if (empty($app)) {
//            $this->command->error("Please configure the constant application");
//            exit();
//        }

        $remark = $this->command->ask('Please Input remark');



        if ($this->command->confirm('Are you sure you want to add this attribute?')) {
            $this->connection->put($key,$value,$app,$remark);
        }
    }


}