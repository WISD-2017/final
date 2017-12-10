<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \Exception;
use App\Http\Model\Foodlist;
use App\Http\Model\Shop;

class BuyController extends Controller
{
    public function get_goods(Request $request,Foodlist $food){
        $all=$request['Shop'];
        
        for($i=0;$i<count($all);$i++){
            $ans=$food::where("food_id",$all[$i])->first();
            $data[]=array("food_id"=>$ans->food_id,"amount"=>$ans->amount,"food"=>$ans->food,"money"=>$ans->money);
        }
        return response()->json(['success'=>'1','data'=>$data]);
    }
}
