<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Foodlist extends Model
{
    public function shop(){

        return $this->belongsTo('App\Http\Model\Shop');
    }
    
}
