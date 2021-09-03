<?php

namespace App\Interfaces\Investment;

interface TransactionInterface
{
    public function paginate($investmentId);

    public function create($data);
}
