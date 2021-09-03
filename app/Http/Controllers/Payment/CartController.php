<?php

namespace App\Http\Controllers\Payment;

use PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exceptions\Payment\CartException;
use App\Interfaces\Payment\CartInterface;

class CartController extends Controller
{

    private $carts;

    public function __construct(CartInterface $cartContract)
    {
        $this->carts = $cartContract;
    }

    public function addItem(Request $request)
    {


        try {

            $this->carts->addItem($request->all());
            session()->flash('success_cart', __('cart.item_added'));
            return redirect()->route('cart.list', ['cart' => $this->carts->show()]);


        } catch (CartException $e) {

            session()->flash('error_cart', $e->getMessage());
            return redirect()->route('cart.list');

        }


    }


    public function deleteItem($id)
    {


        $this->carts->removeItem($id);
        $cart = $this->carts->show();

        $cartHasNotItems = count($cart['items']) === 0;

        if ($cartHasNotItems) {
            $this->carts->empty();
            request()->session()->flash('success_cart',  __('cart.empty_now'));
        }

        request()->session()->flash('success_cart', __('cart.item_deleted'));


        return redirect()->route('cart.list', ['cart' => $cart]);

    }


    public function show()
    {

        return view('web.cart', [
            'cart' => $this->carts->show()
        ]);
    }

    public function empty()
    {

        $this->carts->empty();
        session()->flash('success_cart',  __('cart.empty_now'));

        return redirect()->route('cart.list', ['cart' => $this->carts->show()]);


    }

}
