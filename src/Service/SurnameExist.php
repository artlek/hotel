<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Room;
use App\Service\GuestExistChecker;

class SurnameExist extends GuestExistChecker
{
    public function check($surname) : bool
    {
        $room = $this->rooms->findOneBy(['guestSurname' => $surname]);
        if($room) {
            return true;
        }
        else {
            return false;
        }
    }
}