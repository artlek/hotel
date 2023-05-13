<?php

namespace App\Service;

class ComputeCost
{
    private $period;
    private $price;

    public function compute(Checkin $checkin) : float
    {
        return $checkin->getPeriod() * $checkin->getPrice();
    }
}