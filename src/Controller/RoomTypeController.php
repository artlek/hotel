<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\SaveToDatabase;
use App\Form\AddRoomTypeForm;
use App\Entity\Type;

class RoomTypeController extends AbstractController
{
    #[Route('/rooms/room-types', name: 'room-types')]
    public function showRoomTypeList(EntityManagerInterface $em, Request $request, SaveToDatabase $save): Response
    {
        $type = new Type();
        $form = $this->createForm(AddRoomTypeForm::class, $type)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $save->save($type);
            $this->addFlash('positive', 'Room type ' . $type->getType() . ' was added');
            return $this->redirectToRoute('room-types');
        }

        $types = $em->getRepository(Type::class)->findAll();
        return $this->render('room-types.html.twig', [
            'types' => $types,
            'form' => $form
        ]);
    }

    #[Route('/rooms/delete-room-type', name: 'delete-room-type')]
    public function deleteRoomType(EntityManagerInterface $em, Request $request, SaveToDatabase $save): Response
    {
        if(isset($_POST['room-type-id'])) {
            $type = $em->getRepository(Type::class)->find($_POST['room-type-id']);
            if($type) {
                $typeName = $type->getType();
                $save->delete($type);
                $this->addFlash('positive', 'Room type "' . $typeName . '" was deleted');
            }
        }
        return $this->redirectToRoute('room-types');
    }

    #[Route('/rooms/add-room-type', name: 'add-room-type')]
    public function addRoomType(Request $request, SaveToDatabase $save): Response
    {
        $type = new Type();
        $form = $this->createForm(AddRoomTypeForm::class, $type)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $save->save($type);
            $this->addFlash('positive', 'Room type ' . $type->getType() . ' was added');
            return $this->redirectToRoute('add-room-type');
        }
        return $this->render('add-room-type.html.twig', [
            'form' => $form
        ]);
    }
}
