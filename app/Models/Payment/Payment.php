<?php

namespace App\Models\Payment;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    protected $fillable = [
        'buyer_id',
        'payment_uuid',
        'payment_method',
        'currency_id',
        'subtotal',
        'discount',
        'tax',
        'total',
        'status'
    ];


    public function buyer()
    {

        return $this->belongsTo(User::class, 'buyer_id', 'id')->withTrashed();
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(PaymentDetail::class, 'payment_id', 'id');
    }

}
