<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use \Exception;
use App\Http\Model\Foodlist;
use App\Http\Model\Shop;
use App\Http\Model\Orderlist;
use App\Http\Model\Flowchart;
use App\Http\Model\User;
use App\Http\Model\Lists;

class BuyController extends Controller
{
    public function getTime(){
        date_default_timezone_set('Asia/Taipei');
        return date("Y-m-d H:i:s");
    }
    public function getUser($email){
        $user=new User;
        $user=$user::where('email',$email)->first();
        return $user['id'];

    }
    public function get_goods(Request $request,Foodlist $food,Shop $shop){
        $all=$request['Shop'];
        try{
            for($i=0;$i<count($all);$i++){
                $ans=$food::where("food_id",$all[$i])->first();
                $data[]=array("food_id"=>$ans->food_id,"amount"=>$ans->amount,"food"=>$ans->food,"money"=>$ans->money);
                $s=$ans->shop_id;
            }
            $time=$shop::find($s)->first();
            $reserve[]=array('morning'=>$time['moring'],'afternoon'=>$time['afternoon'],'night'=>$time['night'],'midnight'=>$time['midnight']);
              
            
            
        }catch(\Exception $e){
            #echo $e;
            return response()->json(['success' => '0']);
        }
        return response()->json(['success'=>'1','data'=>$data,'time'=>$reserve]);
    }
    public function checkout(Request $request,Orderlist $order,Foodlist $foodlist){
        #service 0=>內用 1=>外送  2=>外帶
        
        try{
            $shop=$request['shop'];
            $goods=$request['goods'];
            $user=$request['user'];
            $service=$request['service'];
            $reserve_time=$request['reserve_time'];
            $money=$request['money'];
            $flow=new Flowchart;
            $flow->flowchart_set=1;
            $flow->flowchart_make=0;
            $flow->flowchart_way=0;
            $flow->flowchart_done=0;
            $flow->exception="-1";
            $flow->time_set=$this->getTime();
            
            $flow->save();
            $order->user_id=$this->getUser($request['user']);
            $order->shop_id=$shop;
            $order->total_money=$money;
            $order->reserve=$service;
            $order->time=$reserve_time;
            
            $order->flowchart_id=$flow['id'];
            $order->save();
            for($i=0;$i<count($goods);$i++){
                $lists=new Lists;
                $lists->orderlists_id=$order['id'];
                $lists->amount=$goods[$i]['amount'];
                $lists->food_id=$goods[$i]['shopcart'];
                $foodlist=$foodlist::where('food_id',$goods[$i]['shopcart'])->first();
                $lists->money=$foodlist['money']*$goods[$i]['amount'];
                $lists->save();
            }
        }catch(\Exception $e){
            
            return response()->json(['success' => '0']);
        }
        
       
        return response()->json(['success' => '1']);
    }
}
