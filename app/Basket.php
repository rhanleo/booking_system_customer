<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    public $table = 'basket';

    protected $fillable = [
        'basket_uuid', 'customer_uuid','vendor_uuid', 'package_uuid', 'package_quantities', 'package_rates','package_rates_total'
    ];
}
