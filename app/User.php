<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table='users';
    protected $guarded = [];


    protected $hidden = [];

    public function accepts(){
        return $this->hasMany('App\Accepted');
    }

    public function rejects(){
        return $this->hasMany('App\Rejected');
    }
    public function pendings(){
        return $this->hasMany('App\Pending');
    }

    public function notifications(){
        return $this->hasMany('App\Notification');
    }

    public function infos(){
        return $this->belongsTo('App\Leaveinfo');
    }
}
