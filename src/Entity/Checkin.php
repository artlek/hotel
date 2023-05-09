<?php

namespace App\Entity;

use App\Repository\CheckinRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Type;

#[ORM\Entity(repositoryClass: CheckinRepository::class)]
class Checkin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $checkIn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $checkOut = null;

    #[ORM\Column(nullable: true)]
    private ?int $period = null;

    #[ORM\Column]
    private ?float $rate = null;

    #[ORM\Column(nullable: true)]
    private ?float $cost = null;

    #[Assert\Type(type: Type::class)]
    #[Assert\Valid]
    protected $type;

    #[ORM\Column(length: 255)]
    private ?string $guestName = null;

    #[ORM\Column(length: 255)]
    private ?string $guestSurname = null;

    #[ORM\Column]
    private ?int $guestTel = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheckIn(): ?string
    {
        return $this->checkIn;
    }

    public function setCheckIn(string $checkIn): self
    {
        $this->checkIn = $checkIn;

        return $this;
    }

    public function getCheckOut(): ?string
    {
        return $this->checkOut;
    }

    public function setCheckOut(string $checkOut): self
    {
        $this->checkOut = $checkOut;

        return $this;
    }

    public function getPeriod(): ?int
    {
        return $this->period;
    }

    public function setPeriod(?int $period): self
    {
        $this->period = $period;

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

    public function getCost(): ?float
    {
        return $this->cost;
    }

    public function setCost(?float $cost): self
    {
        $this->cost = $cost;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type)
    {
        $this->type = $type;
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

    public function getGuestSurname(): ?string
    {
        return $this->guestSurname;
    }

    public function setGuestSurname(string $guestSurname): self
    {
        $this->guestSurname = $guestSurname;

        return $this;
    }

    public function getGuestTel(): ?int
    {
        return $this->guestTel;
    }

    public function setGuestTel(int $guestTel): self
    {
        $this->guestTel = $guestTel;

        return $this;
    }
}
