<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TestResultRepository")
 */
class TestResult
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $result;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPassed;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getResult(): ?bool
    {
        return $this->result;
    }

    public function setResult(bool $result): self
    {
        $this->result = $result;

        return $this;
    }

    public function getIsPassed(): ?bool
    {
        return $this->isPassed;
    }

    public function setIsPassed(bool $isPassed): self
    {
        $this->isPassed = $isPassed;

        return $this;
    }
}
