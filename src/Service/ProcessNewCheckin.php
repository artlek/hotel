<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Checkin;
use App\Service\SaveToDatabase;
use App\Service\IsGuestChecked;

class ProcessNewCheckin extends AbstractController
{
    public function __construct(private SaveToDatabase $save, private IsGuestChecked $guestChecked, private RequestStack $requestStack)
    {
    }

    // passes data from the form to checkin object and room object, saves it to database
    public function process($room, $form)
    {
        $data = $form->getData();
        if($this->guestChecked->check($data['name'], $data['surname'], $data['telephone']))
        {
            $checkin = new Checkin();
            $checkin
                ->setCheckIn(date("Y-m-d H:i:s"))
                ->setPrice($room->getPrice())
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
            return true;
        }
        else {
            $session = $this->requestStack->getSession();
            $session->getFlashBag()->add('success', 'Guest is already checked in');
            return false;
        }
    }
}