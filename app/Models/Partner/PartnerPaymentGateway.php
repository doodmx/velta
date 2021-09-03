<?php

namespace App\Models\Partner;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class PartnerPaymentGateway extends Model
{
    protected $table = 'partner_payment_gateway';

    protected $fillable = [
        'partner_id',
        'gateway',
        'uuid'
    ];

    public function partner()
    {
        return $this->belongsTo(User::class, 'partner_id', 'id ')->withTrashed();
    }

    public function paymentMethods()
    {
        return $this->hasMany(PartnerPaymentMethod::class, 'partner_payment_gateway', 'id');
    }
}
