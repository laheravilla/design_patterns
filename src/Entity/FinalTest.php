<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FinalTestRepository")
 */
class FinalTest extends AbstractTest {
    use Giftable;
}
