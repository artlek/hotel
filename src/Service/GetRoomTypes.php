<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Type;

class GetRoomTypes
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    // Gets table of room types
    public function getRoomTypes() : array
    {
        $type = new Type();
        $types = $this->em->getRepository(Type::class)->findAll();
        $typeArray = [];
        for ($i = 0; $i < count($types); $i++)
        {
            $typeArray += [$types[$i]->getType() => ($types[$i]->getType() . '-separator-' . $types[$i]->getPrice())];
        }
        return $typeArray;
    }
}