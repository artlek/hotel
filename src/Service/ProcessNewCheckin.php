<?php

namespace App\Service;

use App\Entity\Checkin;
use App\Service\SaveToDatabase;

class ProcessNewCheckin 
{
    public function __construct(private SaveToDatabase $save)
    {
    }

    // passes data from the form to checkin object and room object, saves it to database
    public function process($room, $form)
    {
        $data = $form->getData();
        $checkin = new Checkin();
        $checkin
            ->setCheckIn(date("Y-m-d H:i:s"))
            ->setRate($room->getRate())
            ->setGuestName($data['name'])
            ->setGuestSurname($data['surname'])
            ->setGuestTel($data['telephone'])
        ;
        $room
            ->setAvailability(TRUE)
            ->setGuestTel($data['telephone'])
            ->setGuestName($data['name'])
            ->setGuestSurname($data['surname'])
        ;
        
        $this->save->save($checkin);
        $this->save->save($room);
    }
}