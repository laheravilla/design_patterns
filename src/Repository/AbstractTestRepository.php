<?php

namespace App\Repository;

use App\Entity\FinalTest;
use App\Entity\MiddleTest;
use App\Entity\StartTest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StartTest|MiddleTest|FinalTest|null find($id, $lockMode = null, $lockVersion = null)
 * @method StartTest|MiddleTest|FinalTest|null findOneBy(array $criteria, array $orderBy = null)
 * @method StartTest[]|MiddleTest[]|FinalTest[] findAll()
 * @method StartTest[]|MiddleTest[]|FinalTest[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
abstract class AbstractTestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        $className = 'App\\Entity\\' . preg_replace('/(App|Repository|\\\)/', '', get_class($this));
        parent::__construct($registry, $className);
    }
}
