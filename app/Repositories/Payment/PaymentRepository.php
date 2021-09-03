<?php

namespace App\Repositories\Payment;

use DB;
use App\Models\Payment\Payment;
use App\Models\Partner\PartnerCourse;
use Illuminate\Database\QueryException;
use App\Models\Partner\PartnerResource;
use App\Exceptions\Payment\PaymentException;
use App\Interfaces\Payment\PaymentInterface;
use App\Exceptions\Helpers\DatabaseException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class PaymentRepository implements PaymentInterface
{


    private $payment;

    public function __construct()
    {
        $this->payment = app()->make(Payment::class);
    }


    public function paginate($filter)
    {

        $payments = $this->payment
            ->select('payment.id', DB::raw('CONCAT(profile.lastname," ",profile.name) as buyer'),'user.email',
                'payment_method', 'payment_uuid', 'total', 'iso_code', 'payment.status', 'payment.created_at')
            ->join('user', 'user.id', '=', 'payment.buyer_id')
            ->join('profile', 'user.id', '=', 'profile.user_id')
            ->join('currency', 'currency.id', '=', 'payment.currency_id');

        if (isset($filter['currency_id'])) {
            $payments->where('currency_id', $filter['currency_id']);
        }

        if (isset($filter['status'])) {
            $payments->where('payment.status', $filter['status']);
        }


        return $payments;
    }

    public function store($cart, $payment)
    {

        try {

            DB::beginTransaction();


            $payment = $this->payment->create([
                'buyer_id'       => $payment['partner_id'],
                'payment_uuid'   => $payment['uuid'],
                'currency_id'    => $payment['currency_id'],
                'payment_method' => $payment['payment_method'],
                'subtotal'       => $cart['totals']['subtotal'],
                'tax'            => $cart['totals']['tax'],
                'total'          => $cart['totals']['total'],
                'status'         => $payment['status']
            ]);


            $partnerResource = new PartnerResource(new PartnerCourse());

            foreach ($cart['items'] as $cartItem) {

                $payment->details()->create([
                    'description' => $cartItem['description'],
                    'quantity'    => $cartItem['quantity'],
                    'price'       => $cartItem['price'],
                    'subtotal'    => $cartItem['subtotal'],
                    'tax'         => $cartItem['tax'],
                    'total'       => $cartItem['total'],
                ]);

                $partnerResource->enable([
                    'partner_id'  => auth()->user()->id,
                    'resource_id' => $cartItem['resource_id']
                ]);

            }


            DB::commit();

            return $payment;

        } catch (QueryException $e) {

            DB::rollBack();
            throw new DatabaseException();

        }
    }


    public function show($id)
    {

        try {

            $payment = $this->payment->findOrFail($id);

            return $payment;

        } catch (ModelNotFoundException $e) {

            throw new PaymentException('El pago no fue encontrado', 404);
        }
    }

}
