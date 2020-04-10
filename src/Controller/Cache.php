<?php

namespace App\Controller;

use App\DesignPattern\CacheInterface;

class Cache implements CacheInterface
{
    public function get($key)
    {
        return false;
    }

    public function has($key)
    {
        return false;
    }

    public function set($key, $value, $expire = 3600)
    {
        return false;
    }
}