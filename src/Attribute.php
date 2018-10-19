<?php

namespace CrCms\AttributeContract;

use CrCms\DataCenter\DataContract;
use Illuminate\Database\Eloquent\Model;
use RangeException;

/**
 * Class Attribute
 * @package CrCms\AttributeContract
 */
class Attribute
{
    /**
     * @var DataContract
     */
    protected static $connection;

    /**
     * @return array
     */
    public static function getAttribute($model, string $key)
    {
        if ($model instanceof Model) {
            $table = $model->getTable();
        } elseif (class_exists($model)) {
            $table = (new $model)->getTable();
        } else {
            $table = $model;
        }

        $key = "{$table}.{$key}";

        if (!static::connection()->has($key)) {
            throw new RangeException("The key:{$key} not found");
        }

        return static::connection()->get($key);
    }

    /**
     * @param string $key
     * @param $value
     * @return bool
     */
    public static function equal(string $key, $value): bool
    {
        return static::attribute($key) === $value;
    }

    /**
     * @return DataContract
     */
    protected static function connection(): DataContract
    {
        if (is_null(static::$connection)) {
            static::$connection = app('data-center.manager')->connection(config('attribute.connection'));
        }

        return static::$connection;
    }
}