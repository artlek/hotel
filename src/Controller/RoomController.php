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
use App\Form\CheckoutForm;
use App\Form\AddRoomForm;
use App\Service\NewCheckin;
use App\Service\NewCheckout;
use App\Service\SaveToDatabase;

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
    public function show(EntityManagerInterface $em, int $no, Request $request, NewCheckin $checkin, NewCheckout $checkout): Response
    {
        $room = $em->getRepository(Room::class)->findOneBy(['no' => $no]);

        if(!$room) {
            $this->addFlash('negative', 'Room does not exist');
            return $this->redirectToRoute('rooms');
        }
        
        if($room->getAvailability() == 0){
            $form = $this->createForm(CheckinForm::class, $room)->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()) {
                if($checkin->add($room, $form)) {
                    $this->addFlash('positive', 'Checkin was successful');
                    return $this->redirect('/room/' . $room->getNo());
                }
            }
            return $this->render('room.html.twig', [
                'form' => $form,
                'room' => $room
            ]);
        }
        else {
            $checkoutForm = $this->createForm(CheckoutForm::class)->handleRequest($request);
            if ($checkoutForm->isSubmitted() && $checkoutForm->isValid()) {
                $cost = $checkout->checkout($room);
                $this->addFlash('positive', 'Guest has been checked out of the room. ' . $cost . ' to be paid.');
                return $this->redirect('/room/' . $room->getNo());
            }
            return $this->render('room.html.twig', [
                'room' => $room,
                'checkoutForm' => $checkoutForm
            ]);
        }
    }

    #[Route('/rooms/add', name: 'add-room')]
    public function addRoom(Request $request, SaveToDatabase $save): Response
    {
        $room = new Room();
        $form = $this->createForm(AddRoomForm::class, $room)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $room->setAvailability(0);
            $save->save($room);
            $this->addFlash('positive', 'Room no ' . $room->getNo() . ' was added');
            return $this->redirectToRoute('rooms');
        }
        return $this->render('add-room.html.twig', [
            'form' => $form
        ]);
    }
}
