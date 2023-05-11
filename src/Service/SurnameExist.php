<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Room;

class SurnameExist
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function check($surname) : bool
    {
        $room = $this->em->getRepository(Room::class)->findOneBy(['guestSurname' => $surname]);
        if($room) {
            return true;
        }
        else {
            return false;
        }
    }
}