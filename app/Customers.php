<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customers extends Authenticatable
{
    public $table = 'customers';

    protected $guard = 'customer';

    protected $fillable = [
        'uuid', 'created_at', 'updated_at','name', 'email', 'password','api_token','is_live'
    ];
}
