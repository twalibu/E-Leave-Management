<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rejected extends Model
{
    protected $table='rejected';
    protected $guarded = [];


    protected $hidden = [];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
