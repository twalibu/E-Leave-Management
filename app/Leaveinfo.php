<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leaveinfo extends Model
{
    protected $table='leaveinfo';
    protected $guarded = [];

    protected $hidden = [];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
