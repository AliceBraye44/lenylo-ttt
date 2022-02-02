<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 255)]
    private $pronoun;

    #[ORM\Column(type: 'boolean')]
    private $major;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $firstTatoo;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $location;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $size;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $date;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $accepted;

    #[ORM\ManyToOne(targetEntity: Flash::class, inversedBy: 'reservations')]
    private $flash;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPronoun(): ?string
    {
        return $this->pronoun;
    }

    public function setPronoun(string $pronoun): self
    {
        $this->pronoun = $pronoun;

        return $this;
    }

    public function getMajor(): ?bool
    {
        return $this->major;
    }

    public function setMajor(bool $major): self
    {
        $this->major = $major;

        return $this;
    }

    public function getFirstTatoo(): ?bool
    {
        return $this->firstTatoo;
    }

    public function setFirstTatoo(?bool $firstTatoo): self
    {
        $this->firstTatoo = $firstTatoo;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAccepted(): ?bool
    {
        return $this->accepted;
    }

    public function setAccepted(?bool $accepted): self
    {
        $this->accepted = $accepted;

        return $this;
    }

    public function getFlash(): ?Flash
    {
        return $this->flash;
    }

    public function setFlash(?Flash $flash): self
    {
        $this->flash = $flash;

        return $this;
    }
}
