<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Room;
use App\Service\GuestExistChecker;

class TelExist extends GuestExistChecker
{
    public function check($tel) : bool
    {
        $room = $this->rooms->findOneBy(['guestTel' => $tel]);
        if($room) {
            return true;
        }
        else {
            return false;
        }
    }
}