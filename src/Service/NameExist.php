<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Room;
use App\Service\GuestExistChecker;

class NameExist extends GuestExistChecker
{
    public function check($name) : bool
    {
        $room = $this->rooms->findOneBy(['guestName' => $name]);
        if($room) {
            return true;
        }
        else {
            return false;
        }
    }
}