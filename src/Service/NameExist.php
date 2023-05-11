<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Room;

class NameExist
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function check($name) : bool
    {
        $room = $this->em->getRepository(Room::class)->findOneBy(['guestName' => $name]);
        if($room) {
            return true;
        }
        else {
            return false;
        }
    }
}