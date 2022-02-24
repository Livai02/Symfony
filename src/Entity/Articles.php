<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $intro;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $image;

    /**
     * @ORM\Column(type="date")
     */
    private $date_articles;

    /**
     * @ORM\Column(type="integer")
     */
    private $idcategorie;

    /**
     * @ORM\Column(type="integer")
     */
    private $idconsole;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIntro(): ?string
    {
        return $this->intro;
    }

    public function setIntro(string $intro): self
    {
        $this->intro = $intro;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDateArticles(): ?\DateTimeInterface
    {
        return $this->date_articles;
    }

    public function setDateArticles(\DateTimeInterface $date_articles): self
    {
        $this->date_articles = $date_articles;

        return $this;
    }

    public function getIdCategorie(): ?int
    {
        return $this->idcategorie;
    }

    public function setIdCategorie(int $idcategorie): self
    {
        $this->idcategorie = $idcategorie;

        return $this;
    }

    public function getIdConsole(): ?int
    {
        return $this->idconsole;
    }

    public function setIdConsole(int $idconsole): self
    {
        $this->idconsole = $idconsole;

        return $this;
    }
}