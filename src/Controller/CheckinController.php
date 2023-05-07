<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckinController extends AbstractController
{
    #[Route('/checkin', name: 'checkin')]
    public function index(): Response
    {
        return $this->render('checkin.html.twig');
    }
}
