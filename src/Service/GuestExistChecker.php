<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Room;

abstract class GuestExistChecker
{
    protected $rooms;

    public function __construct(private EntityManagerInterface $em)
    {
        $this->rooms = $this->em->getRepository(Room::class);
    }
}