<?php

namespace CrCms\AttributeContract\Contracts;

use Illuminate\Support\Collection;

/**
 * Interface ConnectionContract
 * @package CrCms\AttributeContract\Connections
 */
interface ConnectionContract
{
    public function exists(string $key): bool;

    public function get(string $key);

    public function put(string $key, $value): bool;

    public function remove(string $key): bool;

    public function all(string $key);
}