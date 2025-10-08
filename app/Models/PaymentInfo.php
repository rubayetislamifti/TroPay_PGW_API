<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentInfo extends Model
{
    protected $fillable = [
        'paymentID', 'amount' , 'invoiceID', 'trxID' , 'customer_number', 'status',
    ];
}
