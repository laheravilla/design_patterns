<?php

namespace App\Controller;

use App\Entity\TestFactory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AbstractController
{
    private $em;
    private $registry;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry)
    {
        $this->em = $em;
        $this->registry = $registry;
    }

    /**
     * Example of object instantiation with Factory Design Pattern
     * @return Response
     */
    public function homepage(): Response
    {
        // No need to inject repositories
        $startTests = TestFactory::getTestRepository('start', $this->registry)->findAll();

        foreach ($startTests as $key => $s) {
            if ($key === count($startTests) - 1 && $s->getQuestion() !== 'Question # 2') {
                $start = TestFactory::getTest('start');
                $start->setQuestion('Question # 2');
                $start->setValue('true');
                $start->setIsActive(false);

                $this->em->persist($start);
                $this->em->flush();
            }
        }
        die;
    }
}