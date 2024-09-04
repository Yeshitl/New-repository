<?php

namespace LatestArifSdk\Php\Models;

class Beneficiary
{
    public $accountNumber;
    public $bank;
    public $amount;

    public function __construct($accountNumber, $bank, $amount)
    {
        $this->accountNumber = $accountNumber;
        $this->bank = $bank;
        $this->amount = $amount;
    }
}