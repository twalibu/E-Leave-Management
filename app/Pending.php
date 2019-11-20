<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pending extends Model
{
    protected $table='pending';
    protected $guarded = [];


    protected $hidden = [];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
