<?php

namespace App\Controller;

use App\DesignPattern\CacheInterface;

class Hello
{
    /**
     * Pass CacheInterface instead of App\Controller\Cache.
     * No need to pass outsider class here in order to not change our logic code
     * @param CacheInterface $cache
     * @return bool|string
     */
    public function sayHello(CacheInterface $cache)
    {
        if ($cache->has('hello')) {
            return $cache->get('hello');
        } else {
            sleep(3);
            $content = 'Hello!';
            $cache->set('hello', $content);
            return $content;
        }
    }
}