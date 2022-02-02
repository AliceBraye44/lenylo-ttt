<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'string', length: 500, nullable: true)]
    private $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $photo;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $updated_at;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Flash::class)]
    private $flashes;

    public function __construct()
    {
        $this->flashes = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection|Flash[]
     */
    public function getFlashes(): Collection
    {
        return $this->flashes;
    }

    public function addFlash(Flash $flash): self
    {
        if (!$this->flashes->contains($flash)) {
            $this->flashes[] = $flash;
            $flash->setCategory($this);
        }

        return $this;
    }

    public function removeFlash(Flash $flash): self
    {
        if ($this->flashes->removeElement($flash)) {
            // set the owning side to null (unless already changed)
            if ($flash->getCategory() === $this) {
                $flash->setCategory(null);
            }
        }

        return $this;
    }
}
