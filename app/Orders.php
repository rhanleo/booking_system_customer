<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public $table = 'orders';

    protected $fillable = [
        'order_uuid', 'vendor_uuid', 'customer_uuid', 'payment_method', 'billing_name','billing_email', 'billing_address', 'order_quantities','order_status','order_amount'
    ];
}
