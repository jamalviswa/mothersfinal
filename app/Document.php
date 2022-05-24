<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Document extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    protected $primaryKey = 'document_id';
}

