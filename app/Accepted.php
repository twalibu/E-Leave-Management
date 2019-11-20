<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accepted extends Model
{
    protected $table='accepted';
    protected $guarded = [];


    protected $hidden = [];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
