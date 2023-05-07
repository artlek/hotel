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
    private ?int $typeId = null;

    #[ORM\Column]
    private ?bool $availability = null;

    #[ORM\Column(nullable: true)]
    private ?int $guestId = null;

    #[ORM\Column]
    private ?int $no = null;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeId(): ?int
    {
        return $this->typeId;
    }

    public function setTypeId(int $typeId): self
    {
        $this->typeId = $typeId;

        return $this;
    }

    public function isAvailability(): ?bool
    {
        return $this->availability;
    }

    public function setAvailability(bool $availability): self
    {
        $this->availability = $availability;

        return $this;
    }

    public function getGuestId(): ?int
    {
        return $this->guestId;
    }

    public function setGuestId(int $guestId): self
    {
        $this->guestId = $guestId;

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
}
