<?php

namespace App\Adapter;

use App\DesignPattern\CacheInterface;
use Doctrine\Common\Cache\Cache;

/**
 * Modifies outsider class returns, that is, Doctrine\Common\Cache\Cache,
 * by implementing App\DesignPattern\CacheInterface\CacheInterface
 * Class DoctrineCacheAdapter
 * @package App\Adapter
 */
class DoctrineCacheAdapter implements CacheInterface
{
    private $cache;

    public function __construct(Cache $cache) // Get outsider class Doctrine\Common\Cache\Cache
    {
        $this->cache = $cache;
    }

    public function get($key)
    {
        return $this->cache->fetch($key); // Adapt outsider methods to my interface adapter
    }

    public function has($key)
    {
        return $this->cache->contains($key);
    }

    public function set($key, $value, $expire = 3600)
    {
        return $this->cache->save($key, $value, $expire);
    }
}