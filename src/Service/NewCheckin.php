<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Checkin;
use App\Service\SaveToDatabase;
use App\Service\IsGuestChecked;

class NewCheckin extends AbstractController
{
    public function __construct(private SaveToDatabase $save, private IsGuestChecked $guestChecked, private RequestStack $requestStack)
    {
    }

    // passes data from the form to checkin object and room object, saves it to database
    public function add($room, $form)
    {
        $data = $form->getData();
        if($this->guestChecked->check($data->getGuestName(), $data->getGuestSurname(), $data->getGuestTel()))
        {
            $checkin = new Checkin();
            $checkin
                ->setCheckIn(date("Y-m-d H:i:s"))
                ->setPrice($room->getPrice())
                ->setGuestName($data->getGuestName())
                ->setGuestSurname($data->getGuestSurname())
                ->setGuestTel($data->getGuestTel())
                ->setRoomNo($room->getNo())
                ->setRoomType($room->getType())
                ->setIfCheckedOut(false)
            ;
            $room
                ->setAvailability(TRUE)
                ->setGuestTel($data->getGuestTel())
                ->setGuestName($data->getGuestName())
                ->setGuestSurname($data->getGuestSurname())
            ;
            
            $this->save->save($checkin);
            $this->save->save($room);
            return true;
        }
        else {
            $session = $this->requestStack->getSession();
            $session->getFlashBag()->add('negative', 'Guest is already checked in with this data');
            return false;
        }
    }
}