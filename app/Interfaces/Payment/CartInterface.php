<?php

namespace App\Interfaces\Payment;

interface CartInterface
{


    public function addItem($item);

    public function removeItem($id);

    public function show();

    public function empty();


}
