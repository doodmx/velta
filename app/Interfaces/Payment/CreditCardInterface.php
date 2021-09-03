<?php

namespace App\Interfaces\Payment;

interface CreditCardInterface
{

    public function saveCard($customerId, $cardId);

    public function updateDefaultCard($customerId, $cardId);

    public function deleteCard($id);

    public function allCards($customerId);


}
