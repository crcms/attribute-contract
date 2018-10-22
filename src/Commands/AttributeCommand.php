<?php

namespace CrCms\AttributeContract\Commands;

use CrCms\DataCenter\Commands\DataCenterCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

/**
 * Class AttributeCommand
 * @package CrCms\AttributeContract\Commands
 */
class AttributeCommand extends DataCenterCommand
{
    /**
     * @var string
     */
    protected $signature = 'make:attribute {action : Method of execution. Supports the all get put flush delete method} {table : Table name or Model name}';

    /**
     * @var string
     */
    protected $description = 'Set data table properties';

    /**
     * @return string
     */
    protected function key(): string
    {
        $table = $this->argument('table');
        if (class_exists($table)) {
            $table = (new $table)->getTable();
        }

        return $table . '_' . parent::key();
    }

    /**
     * @return string
     */
    protected function connection(): string
    {
        return config('attribute.connection');
    }
}