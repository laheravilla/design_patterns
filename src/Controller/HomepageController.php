<?php

namespace App\Controller;

use App\Adapter\DoctrineCacheAdapter;
use App\Decorator\TextDecorator;
use App\Entity\PrintText;
use App\Entity\TestFactory;
use App\Controller\Hello;
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
    public function adapterPattern()
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
    public function decoratorPattern()
    {
        $text = new PrintText();
        $content = 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium
        voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate
        non provident, similique sunt in culpa qui officia deserunt mollitia animi';
        $text->setText($content);

        $textDecorated = new TextDecorator($text); // Accept object to be decorated

        dump($text->getText());
        dd($textDecorated->textToUppercase());
    }

    /**
     * Example of object instantiation with Factory Design Pattern
     * @return Response
     */
    public function factoryPattern(): Response
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
    public function trait()
    {
        $finalTest = TestFactory::getTest('Final');
        $finalTest->setGift(true);
        dd($finalTest);
    }
}