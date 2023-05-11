<?php

namespace App\Service;

use App\Service\NameExist;
use App\Service\SurnameExist;
use App\Service\TelExist;

class IsGuestChecked
{
    public function __construct(private NameExist $nameExist, private SurnameExist $surnameExist, private TelExist $telExist)
    {
    }

    public function check($name, $surname, $tel) : bool
    {
        if(($this->nameExist->check($name) AND $this->surnameExist->check($surname)) OR $this->telExist->check($tel)) {
            return false;
        }
        else {
            return true;
        }
    }
}