<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Videogame", mappedBy="cat")
     */
    private $videogames;

    public function __construct()
    {
        $this->videogames = new ArrayCollection();
    }

    public function getId()
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

    /**
     * @return Collection|Videogame[]
     */
    public function getVideogames(): Collection
    {
        return $this->videogames;
    }

    public function addVideogame(Videogame $videogame): self
    {
        if (!$this->videogames->contains($videogame)) {
            $this->videogames[] = $videogame;
            $videogame->setCat($this);
        }

        return $this;
    }

    public function removeVideogame(Videogame $videogame): self
    {
        if ($this->videogames->contains($videogame)) {
            $this->videogames->removeElement($videogame);
            // set the owning side to null (unless already changed)
            if ($videogame->getCat() === $this) {
                $videogame->setCat(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getTitle();
    }
}
