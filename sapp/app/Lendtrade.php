<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lendtrade extends Model
{
    protected $guarded = [];
    protected $table = "lend_offers_trade";


    public  function  user(){
        return $this->belongsTo('App\User','user_id');
    }

}
