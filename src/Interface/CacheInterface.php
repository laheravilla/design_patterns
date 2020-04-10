<?php

namespace App\DesignPattern;
/**
 * Interface created from App\Controller\Cache
 * Interface CacheInterface
 * @package App\DesignPattern
 */
interface CacheInterface
{
    public function get($key);

    public function has($key);

    public function set($key, $value, $expire = 3600);
}