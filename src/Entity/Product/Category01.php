<?php

namespace App\Entity\Product;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Product\Category01Repository")
 * @ORM\Table(name="category01")
 */
class Category01
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product\Post01", mappedBy="category")
     */
    private $post01s;

    public function __construct()
    {
        $this->post01s = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Post01[]
     */
    public function getPost01s(): Collection
    {
        return $this->post01s;
    }

    public function addPost01(Post01 $post01): self
    {
        if (!$this->post01s->contains($post01)) {
            $this->post01s[] = $post01;
            $post01->setCategory($this);
        }

        return $this;
    }

    public function removePost01(Post01 $post01): self
    {
        if ($this->post01s->contains($post01)) {
            $this->post01s->removeElement($post01);
            // set the owning side to null (unless already changed)
            if ($post01->getCategory() === $this) {
                $post01->setCategory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
