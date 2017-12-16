<?php

namespace App\Http\Controllers;
use Crypt;
use Illuminate\Http\Request;
use App\Http\Model\Foodlist;
use App\Http\Model\Shop;
use App\Http\Model\Orderlist;
use App\Http\Model\Flowchart;
use App\Http\Model\User;
use App\Http\Model\Lists;
use App\Http\Model\Manager;
use App\Http\Requests;
use \Exception;
class MController extends Controller
{
    //
    public function reg(Request $request){
        $email=$request['email'];
        $pas=$request['password'];
        try{
            $manger=new Manager;
            $manger->email=$email;
            $manger->password=Crypt::encrypt($pas);
            $manger->save();
        }catch(\Exception $e){
            // echo $e;
            return response()->json(['success'=>'0']);
        }
        return response()->json(['success'=>'1']);
    }
    public function login(Request $request){
        $email=$request['email'];
        $pas=$request['password'];
        
        
        try{
            $manager=new Manager;
            $manager=$manager::where('email',$email)->first();
            $pas2=Crypt::decrypt($manager['password']);
            if($pas==$pas2){
                return response()->json(['success' => '1']);
            }
            
        }catch(\Exception $e){
            return response()->json(['success'=>'0']);
        }
    }
}