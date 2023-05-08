<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Room;

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

    #[Route('/room/{id}', name: 'show_room')]
    public function show(EntityManagerInterface $em, int $id): Response
    {
        $room = $em->getRepository(Room::class)->find($id);

        if (!$room) {
            return new Response('Room does not exist');
        }
        return new Response('Room number '.$room->getNo());
    }
}
