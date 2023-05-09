<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?string $type = null;

    #[ORM\Column]
    private ?bool $availability = null;

    #[ORM\Column(nullable: true)]
    private ?string $guestName = null;

    #[ORM\Column]
    private ?int $no = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $guestSurname = null;

    #[ORM\Column(nullable: true)]
    private ?int $guestTel = null;

    #[ORM\Column]
    private ?float $rate = null;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function isAvailability(): ?bool
    {
        return $this->availability;
    }

    public function getAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getGuestName(): ?string
    {
        return $this->guestName;
    }

    public function setGuestName(string $guestName): self
    {
        $this->guestName = $guestName;

        return $this;
    }

    public function getNo(): ?int
    {
        return $this->no;
    }

    public function setNo(int $no): self
    {
        $this->no = $no;

        return $this;
    }

    public function getGuestSurname(): ?string
    {
        return $this->guestSurname;
    }

    public function setGuestSurname(?string $guestSurname): self
    {
        $this->guestSurname = $guestSurname;

        return $this;
    }

    public function getGuestTel(): ?int
    {
        return $this->guestTel;
    }

    public function setGuestTel(?int $guestTel): self
    {
        $this->guestTel = $guestTel;

        return $this;
    }

    public function getRate(): ?float
    {
        return $this->rate;
    }

    public function setRate(float $rate): self
    {
        $this->rate = $rate;

        return $this;
    }
}
