<?php

namespace App\Interfaces\Investment;

interface InvestmentInterface
{

    public function allByStatus($userId, $status = null);

    public function show($investmentId);

    public function showTransactions($userId, $investmentId);

}
