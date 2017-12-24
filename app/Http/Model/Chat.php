<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function shop(){
        return $this->belongsTo('App\Http\Model\Shop');
    }
    public function user(){
        return $this->belongsTo('App\Http\Model\User');
    }
}
