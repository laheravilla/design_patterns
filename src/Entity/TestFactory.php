<?php

namespace App\Entity;

use Doctrine\Common\Persistence\ManagerRegistry;

class TestFactory
{
    /**
     * @param string $type
     * @return mixed
     */
    public static function getTest(string $type)
    {
        $className = 'App\\Entity\\' . ucfirst($type) .'Test'; // Output: StartTest || MiddleTest || FinalTest
        return new $className();
    }

    /**
     * @param string $name
     * @param ManagerRegistry $registry
     * @return mixed
     */
    public static function getTestRepository(string $name, ManagerRegistry $registry)
    {
        $className = 'App\\Repository\\' . ucfirst($name) .'TestRepository'; // Output: StartTestRepository || MiddleTestRepository || FinalTestRepository
        return new $className($registry);
    }
}
