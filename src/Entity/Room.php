<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['no'], message: 'There is already room with this number')]
#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Assert\Regex('/^[a-zA-Z0-9)(,\s-]{3,20}$/', 
        message: 'Invalid data. Only digits, letters and bracket, comma and dash mark. Min. 3 and max. 20 characters.')]
    private ?string $type = null;

    #[ORM\Column]
    private ?bool $availability = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Regex('/^[a-zA-Z0-9\.,\s-]{3,50}$/', message: 'Invalid data. Only digits, letters and dot, comma and dash mark. Min. 3 and max. 50 characters.')]
    private ?string $guestName = null;

    #[ORM\Column(unique: true)]
    #[Assert\GreaterThan(0)]
    #[Assert\LessThan(1000)]
    private ?int $no = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Regex('/^[a-zA-Z0-9\.,\s-]{3,50}$/', message: 'Invalid data. Only digits, letters and dot, comma and dash mark allowed. Min. 3 and max. 50 characters.')]
    private ?string $guestSurname = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Regex('/^[0-9-]{9,15}$/', message: 'Invalid data. Only digits and dash mark allowed. Min. 9 and max. 15 characters.')]
    private ?string $guestTel = null;

    #[ORM\Column]
    #[Assert\Type(
        type: 'float',
        message: 'Invalid value',
    )]
    #[Assert\GreaterThan(0)]
    #[Assert\LessThan(1000000)]
    private ?float $price = null;
    
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

    public function setGuestName(?string $guestName): self
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

    public function getGuestTel(): ?string
    {
        return $this->guestTel;
    }

    public function setGuestTel(?string $guestTel): self
    {
        $this->guestTel = $guestTel;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
