<?php

namespace App\Models\Partner;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $table = 'payment_method';

    protected $fillable = [
        'partner_payment_gateway_id',
        'uuid'
    ];

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id', 'id')->withTrashed();
    }

    public function paymentGateway()
    {
        return $this->belongsTo(PartnerPaymentGateway::class, 'partner_payment_gateway_id', 'id');
    }
}
