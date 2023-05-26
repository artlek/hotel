<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Type;

class AnyRoomTypeExist
{
    public function __construct(private EntityManagerInterface $em)
    {

    }

    public function check() : bool
    {
        $types = $this->em->getRepository(Type::class)->findAll();
        if($types) {
            return true;
        }
        else {
            return false;
        }
    }
}