<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Receipt extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    protected $primaryKey = 'receipt_id';
}

