<?php

namespace App\Controller;

use App\Adapter\DoctrineCacheAdapter;
use App\Decorator\CaramelDecorator;
use App\Decorator\ChocolateDecorator;
use App\Decorator\Decaf;
use App\Entity\TestFactory;
use App\Controller\Hello;
use App\Observer\Message;
use App\Observer\TestResultEvent;
use App\Strategy\Context;
use App\Strategy\OperationAdd;
use App\Strategy\OperationMultiply;
use App\Strategy\OperationSubstract;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

class HomepageController extends AbstractController
{
    private $em;
    private $registry;
    private $kernel;

    public function __construct(EntityManagerInterface $em, ManagerRegistry $registry, KernelInterface $kernel)
    {
        $this->em = $em;
        $this->registry = $registry;
        $this->kernel = $kernel;
    }

    /**
     * Adapter design pattern
     * Adapt an outsider class
     */
    public function adapterPatternIndex()
    {
        //$cache = new Cache(); // My cache logic

        $cache = new FilesystemCache($this->kernel->getProjectDir() . '\my_cache'); // Instance of outsider class
        $adapter = new DoctrineCacheAdapter($cache); // Pass instance of outsider class to adapter: Doctrine\Common\Cache\FilesystemCache

        $hello = new Hello();
        dd($hello->sayHello($adapter)); // Pass instance of adapter
    }

    /**
     * Decorator design pattern
     * Add functionality to another class
     */
    public function decoratorPatternIndex()
    {
        $beverage = new Decaf();
        $withCaramel = new CaramelDecorator($beverage);
        $withChoco = new ChocolateDecorator($beverage);
        dump($withCaramel->getName());
        dump($withCaramel->getCost());

        dump($withChoco->getName());
        dump($withChoco->getCost());
        die;
    }

    /**
     * Example of object instantiation with Factory Design Pattern
     * @return Response
     */
    public function factoryPatternIndex(): Response
    {
        // No need to inject repositories
        $startTests = TestFactory::getTestRepository('start', $this->registry)->findAll();
        dump($startTests);

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

    /**
     * Show trait functioning
     */
    public function traitIndex()
    {
        $finalTest = TestFactory::getTest('Final');
        $finalTest->setGift(true);
        //dd($finalTest);

        return $this->render('base.html.twig', ['finalTest' => $finalTest]);
    }

    /**
     * Observer Design Pattern
     * Composed by two subjects: the observable and the observer
     */
    public function observerIndex()
    {
        $test= new TestResultEvent(); // Observable
        $message = new Message($test); // Observer

        $test->setStatus(5);
        $test->setStatus(2);
        die;
    }

    public function strategyIndex()
    {
        $context = new Context(new OperationAdd(10, 5));
        dump('10 + 5 = ' . $context->executeStrategy());

        $context = new Context(new OperationSubstract(10, 5));
        dump('10 - 5 = ' . $context->executeStrategy());

        $context = new Context(new OperationMultiply(10, 5));
        dump('10 * 5 = ' . $context->executeStrategy());
        die;
    }
}