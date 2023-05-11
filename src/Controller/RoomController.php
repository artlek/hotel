<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Room;
use App\Entity\Checkin;
use App\Entity\Guest;
use App\Form\CheckinForm;
use App\Service\NewCheckin;

class RoomController extends AbstractController
{
    #[Route('/rooms', name: 'rooms')]
    public function getRoomList(EntityManagerInterface $em): Response
    {
        $rooms = $em->getRepository(Room::class)->findAll();
        return $this->render('rooms.html.twig', [
            'rooms' => $rooms
        ]);
    }

    #[Route('/room/{no}', name: 'room')]
    public function show(EntityManagerInterface $em, int $no, Request $request, NewCheckin $newCheckin): Response
    {
        $room = $em->getRepository(Room::class)->findOneBy(['no' => $no]);

        if(!$room) {
            $this->addFlash('success', 'Room does not exist');
            return $this->redirectToRoute('rooms');
        }
        
        if($room->getAvailability() == 0){
            $form = $this->createForm(CheckinForm::class);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                if($newCheckin->add($room, $form)) {
                    $this->addFlash('success', 'Checkin was successful');
                    return $this->redirectToRoute('rooms');
                }
            }
            return $this->render('room.html.twig', [
                'form' => $form,
                'room' => $room
            ]);
        }
        else {
            return $this->render('room.html.twig', [
                'room' => $room,
            ]);
        }
    }
}
