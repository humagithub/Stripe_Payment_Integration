<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StripePayment extends Model
{
    use HasFactory;
    protected $table = 'stripe_payment';

    protected $fillable = [
        'stripe_charge_id',
    ];

}
