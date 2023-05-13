<?php

namespace App\Service;

class ComputeDatePeriod
{
    private $firstDate;
    private $secondDate;

    public function compute(string $firstDate, string $secondDate) : int
    {
        $this->firstDate = date_create($firstDate);
        $this->secondDate = date_create($secondDate);
        if($this->firstDate AND $this->secondDate AND $this->firstDate < $this->secondDate ) {
            return intval(date_diff($this->firstDate, $this->secondDate)->format('%a'));
        }
        else {
            return 0;
        }
    }
}