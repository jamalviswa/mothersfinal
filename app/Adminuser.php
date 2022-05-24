<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Adminuser extends Model {

    use Notifiable;

    public $timestamps = false;
    protected $primaryKey = 'admin_id';

}
