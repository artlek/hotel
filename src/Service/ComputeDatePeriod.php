<?php

namespace App\Service;

use App\Entity\Checkin;

class ComputeDatePeriod
{
    private $firstDate;
    private $secondDate;

    public function compute(Checkin $checkin) : int
    {
        $this->firstDate = date_create($checkin->getCheckIn());
        $this->secondDate = date_create($checkin->getCheckOut());
        if(intval(date_diff($this->firstDate, $this->secondDate)->format('%a') == 0)) {
            return 1;
        }
        else{
            return intval(date_diff($this->firstDate, $this->secondDate)->format('%a'));
        }
    }
}