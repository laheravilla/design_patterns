<?php

namespace App\Entity;

use App\Composition\Giftable;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FinalTestRepository")
 */
class FinalTest extends AbstractTest {
    use Giftable;
}
