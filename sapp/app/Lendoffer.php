<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lendoffer extends Model
{
    protected $guarded = [];
    protected $table = "lend_offers";


    public  function  user(){
        return $this->belongsTo('App\User','user_id');
    }

}
