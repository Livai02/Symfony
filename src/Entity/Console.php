<?php

namespace App\Entity;

use App\Repository\ConsoleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConsoleRepository::class)
 */
class Console
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $console;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConsole(): ?string
    {
        return $this->console;
    }

    public function setConsole(string $console): self
    {
        $this->console = $console;

        return $this;
    }
}
