<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Session;
use App\Exceptions\Payment\CartException;
use App\Interfaces\Payment\CartInterface;

class CartRepository implements CartInterface
{


    private function computeTotals($cart)
    {

        return [
            'subtotal' => array_sum(array_column($cart['items'], 'subtotal')),
            'tax'      => array_sum(array_column($cart['items'], 'tax')),
            'total'    => array_sum(array_column($cart['items'], 'total'))
        ];
    }

    public function addItem($item)
    {

        $cart = $this->show();

        if (!empty($cart)) {

            $items = array_filter($cart['items'], function ($cartItem) use ($item) {
                return $cartItem['currency_id'] !== $item['currency_id'];
            });


            if (count($items) > 0) {
                throw new CartException(__('cart.currency_error'));
            }

        }

        $cart['items'][] = $item;
        $cart['totals'] = $this->computeTotals($cart);


        Session::put('cart', $cart);


    }

    public function removeItem($id)
    {

        $cart = $this->show();
        array_splice($cart['items'], $id);
        $cart['totals'] = $this->computeTotals($cart);
        Session::put('cart', $cart);

    }

    public function show()
    {
        return Session::get('cart');
    }

    public function empty()
    {
        Session::forget('cart');
    }


}
