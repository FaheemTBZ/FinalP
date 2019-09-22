<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Picture extends Model
{
    use Notifiable;
    
    protected $guarded = [];

}
