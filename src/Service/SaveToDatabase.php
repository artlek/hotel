<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class SaveToDatabase
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function save($object) : void
    {
        $this->em->persist($object);
        $this->em->flush();
    }

    public function delete($object) : void
    {
        $this->em->remove($object);
        $this->em->flush();
    }
}