<?php

namespace App\Http\Controllers;
use Crypt;
use Illuminate\Http\Request;
use App\Http\Model\User;
use App\Http\Requests;
use \Exception;
use App\Http\Model\Shop;
class AdminController extends Controller
{
    public function login(Request $request){
        $user=new user;
        $user->email=$request['id'];
        $user->password=$request['password'];
        
        try{
            $ans=$user->where('email',$user->email)->first();
            $pas=Crypt::decrypt($ans['password']);
            $active=$ans['active'];
            if($active==1&&$pas==$user->password){
                return response()->json(['success' => '1']);
            }
        }
        catch(\Exception $e){
                return response()->json(['success' => '0']);
        }
        
    }
    public function storelogin(Request $request){
        $shop=new Shop;
        $shop->email=$request['id'];
        $shop->password=$request['password'];
        try{
            $ans=$shop->where('email',$shop->email)->first();
            #echo $shop;
            $pas=Crypt::decrypt($ans['password']);
            $active=$ans['active'];
            if($active==1&&$pas==$shop->password){
                return response()->json(['success' => '1']);
            }
        }catch(\Exception $e){
            return response()->json(['success' => '0']);
        }
    }

    public function register(Request $request){
        try{
            $user=new User;
            $user->email=$request['id'];
            $user->password=Crypt::encrypt($request['password']);
            $user->city=$request['city'];
            $user->address=$request['address'];
            $user->active=1;
            $user->shop=0;
            $user->disturb=0;
            $user->recommend=0;
            $user->save();
        }catch(\Exception $e){
            return response()->json(['success' => '0']);
        }
        return response()->json(['success' => '1']);
    }
    public function setting(Request $request){
        try{
            $user=new User;
            $user->email=$request['id'];
            $ans=$user->where('email',$user->email)->first();
            $output=array(
                'success'=>'1',
                'content'=>array(
                    'shop'=>$ans['shop'],
                    'disturb'=>$ans['disturb'],
                    'recommend'=>$ans['recommend']
                )
                );
            return response()->json($output);
        }catch(\Exception $e){
            return response()->json(['success'=>'0']);
        }

    }
    public function recommend(Request $request){
        try{
            $user=new user;
            $user=$user->where('email',$request['id'])->first();
            $user->recommend=$request['recommend'];
            $user->save();
        }catch(\Exception $e){
            return response()->json(['success' => '0']);
        }
        return response()->json(['success' => '1']);
    }
    public function disturb(Request $request){
        try{
            $user=new user;
            $user=$user->where('email',$request['id'])->first();
            $user->disturb=$request['disturb'];
            $user->save();
        }catch(\Exception $e){
            return response()->json(['success' => '0']);
        }
        return response()->json(['success' => '1']);
    }
    public function shop(Request $request){
        try{
            $user=new user;
            $user=$user->where('email',$request['id'])->first();
            $shop=new Shop;
            $shop->email=$user->email;
            $shop->password=$user->password;
            $shop->city=$user->city;
            $shop->address=$user->address;
            $shop->active=1;
            $shop->save();
            $user->shop=1;
            $user->save();
        }catch(\Exception $e){
            return response()->json(['success' => '0']);
        }
        return response()->json(['success' => '1']);
    }
    
}
