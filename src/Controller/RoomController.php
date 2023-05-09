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
    public function show(EntityManagerInterface $em, int $no, Request $request, SaveToDatabase $save): Response
    {
        $room = $em->getRepository(Room::class)->findOneBy(['no' => $no]);

        if (!$room) {
            $this->addFlash('success', 'Room does not exist');
            return $this->redirectToRoute('rooms');
        }

        $form = $this->createForm(CheckinForm::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
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

            $save->save($checkin);
            $save->save($room);

            $this->addFlash('success', 'Checkin was successful');
            return $this->redirectToRoute('rooms');
        }

        return $this->render('room.html.twig', [
            'room' => $room,
            'form' => $form
        ]);
    }
}
