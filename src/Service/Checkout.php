<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Checkin;
use App\Service\ComputeDatePeriod;
use App\Service\ComputeCost;
use App\Entity\Room;
use App\Service\SaveToDatabase;

class Checkout
{
    public function __construct(
        private EntityManagerInterface $em,
        private SaveToDatabase $save,
        private ComputeDatePeriod $period,
        private ComputeCost $cost
    ){
    }

    public function checkout(Room $room)
    {
        $checkin = $this->em->getRepository(Checkin::class)->findOneBy(['guestTel' => $room->getGuestTel()]);
        $checkin
            ->setCheckOut(date("Y-m-d H:i:s"))
            ->setPeriod($this->period->compute($checkin))
            ->setCost($this->cost->compute($checkin))
            ->setIfCheckedOut(true)
        ;

        $room
        ->setAvailability(0)
        ->setGuestTel(null)
        ->setGuestName(null)
        ->setGuestSurname(null)
        ;

        $this->save->save($room);
        $this->save->save($checkin);

        return $checkin->getCost();
    }
}