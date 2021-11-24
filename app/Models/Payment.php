<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'invoice_id',
        'total_payment',
        'net_payment',
        'payment_type',
        'account_number',
        'date',
        'from',
        'to',
        'status'
    ];
}
