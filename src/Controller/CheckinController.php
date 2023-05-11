<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\CheckinForm;
use App\Entity\Checkin;

class CheckinController extends AbstractController
{
    #[Route('/checkins', name: 'checkins')]
    public function add(Request $request, EntityManagerInterface $em): Response
    {
        $checkins = $em->getRepository(Checkin::class)->findAll();
        return $this->render('checkins.html.twig', [
            'checkins' => $checkins
        ]);
    }
}
