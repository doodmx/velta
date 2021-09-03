<?php

namespace App\Models\Payment;


use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    protected $table = 'payment_detail';

    protected $fillable = [
        'payment_id',
        'resource_type',
        'description',
        'quantity',
        'price',
        'subtotal',
        'discount',
        'tax',
        'total'
    ];

    public function cart()
    {
        return $this->belongsTo(Payment::class, 'payment_id', 'id');
    }


}

