<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AddCheckinForm;
use App\Entity\Checkin;

class CheckinController extends AbstractController
{
    #[Route('/checkin', name: 'add_checkin')]
    public function add(Request $request): Response
    {
        $checkin = new Checkin();
        $form = $this->createForm(AddCheckinForm::class, $checkin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return new Response('ok');
            // todo: insert code to save data to database
        }
        return $this->render('checkin.html.twig', [
            'form' => $form
        ]);
    }
}
