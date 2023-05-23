<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['type'], message: 'Room type already exist')]
#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\Regex('/^[a-zA-Z0-9)(,\s-]{3,20}$/', 
        message: 'Invalid data. Only digits, letters and bracket, comma and dash mark. Min. 3 and max. 20 characters.')]
    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
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
