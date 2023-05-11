<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Room;

class TelExist
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function check($tel) : bool
    {
        $room = $this->em->getRepository(Room::class)->findOneBy(['guestTel' => $tel]);
        if($room) {
            return true;
        }
        else {
            return false;
        }
    }
}