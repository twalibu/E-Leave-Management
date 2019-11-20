<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table='notification';
    protected $guarded = [];


    protected $hidden = [];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
