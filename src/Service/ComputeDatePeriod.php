<?php

namespace App\Service;

class ComputeDatePeriod
{
    private $firstDate;
    private $secondDate;

    public function compute(Checkin $checkin) : int
    {
        $this->firstDate = date_create($checkin->getCheckIn());
        $this->secondDate = date_create($checkin->getChecoOut());
        return 1 + intval(date_diff($this->firstDate, $this->secondDate)->format('%a'));
    }
}