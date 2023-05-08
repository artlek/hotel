<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Type;

class GetRoomTypes
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function get() : array
    {
        $typesRepo = $this->em->getRepository(Type::class);
        $types = $typesRepo->findAll();
        $arrayTypes = [];
        for ($i = 0; $i < count($types); $i++) {
            $arrayTypes[$types[$i]->getType()] = $types[$i]->getRate();
        }
        return $arrayTypes;
    }
}