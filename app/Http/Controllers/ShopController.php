<?php

namespace App\Http\Controllers;
use Storage;
use Illuminate\Http\Request;
use \Exception;
use App\Http\Requests;
use App\Http\Model\Foodlist;
use App\Http\Model\Shop;

class ShopController extends Controller
{
    public function Get_Shop_Id($email){
        $user=new shop;
        $user->email=$email;
        $ans=$user->where('email',$user->email)->first()->id;
        return $ans;
    }
    public function goods_update(Request $request){
        $foodlist=new foodlist;
        $food=$foodlist->where('food_id','=',$request['food_id'])->first();
        $path=$request['url'];
        #echo $path,$food->url;
        if($path==$food->url){
            try{
                $food->where('food_id',$request['food_id'])->update(['money'=>$request['money'],'amount'=>$request['amount'],
                'content'=>$request['content']]);
            }catch(\Exception $e){
                return response()->json(['success' => '0']);
            }
        }else{
            
            try{
                $img=str_replace('data:image/jpeg;base64,', '', $path);
                $img = str_replace(' ', '+', $img);
                $img = base64_decode($img);
                $path2='img_'.time().'.jpg';
                $exists = Storage::disk('local')->exists($path2);
                
                if($exists==1){
                    return response()->json(['success' => '0']);
                }
                else{
                    Storage::disk('local')->put($path2, $img);
                }
                echo $path2;
                $food->where('food_id',$request['food_id'])->update(['money'=>$request['money'],'amount'=>$request['amount'],
                'content'=>$request['content'],'url'=>$path2]);
            }catch(\Exception $e){
                
                return response()->json(['success' => '0']);
            }

        }
        return response()->json(['success' => '1']);
        
    }
    public function upload(Request $request){
        
        $id=$this->Get_Shop_Id($request['email']);
        $url=$request['url'];
        if($url!='0'){
            try{
                $img=str_replace('data:image/jpeg;base64,', '', $url);
                $img = str_replace(' ', '+', $img);
                $img = base64_decode($img);
                $path='img_'.time().'.jpg';
                $exists = Storage::disk('local')->exists($path);
                if($exists==1){
                    return response()->json(['success' => '0']);
                }
                else{
                    Storage::disk('local')->put($path, $img);
                }
                $food=new foodlist;
                $food->food=$request['id'];
                $food->money=$request['money'];
                $food->url=$path;
                $food->content=$request['content'];
                $food->amount=0;
                $food->shop_id=$id;
                $food->save();
                return response()->json(['success' => '1']);
            }
            catch(\Exception $e){
                return response()->json(['success' => '0']);
            }
        }
        else{
            
            try{
                $food=new foodlist;
                $food->food=$request['id'];
                $food->money=$request['money'];
                $food->url=-1;
                $food->amount=0;
                $food->content=$request['content'];
                $food->shop_id=$id;
                $food->save();
                return response()->json(['success' => '1']);
            }
            catch(\Exception $e){
                #echo $e;
                return response()->json(['success' => '0']);
            }

        }
        
    }
    public function get_goods(Request $request){
        $id=$this->Get_Shop_Id($request['email']);
        $ans=new Shop;
        $ans=$ans::find($id);
        #echo $ans;
        foreach($ans->foodlist as $shop){
           
            if($shop->count()>0)
                $data[]=array('id'=>$shop->food_id,'food'=>$shop->food,'money'=>$shop->money,'img'=>$shop->url,'content'=>$shop->content,'amount'=>$shop->amount);
            else{
                return response()->json(['success' => '0']); 
            }
        }

        return response()->json(['success'=>'1','data'=>$data]);
    }
    public function goods_delete(Request $request){
        try{
            $food=new foodlist;
            $ans=$food->where('food_id', '=', $request['id'])->delete();
            
        }catch(\Exception $e){
            return response()->json(['success' => '0']);
        }
        return response()->json(['success' => '1']);
    }
    public function goods_one(Request $request){
        
        try{
            
            $food=new foodlist;
            $ans=$food->where('food_id','=',$request['food_id'])->get();
            
        }catch(\Exception $e){
        
            return response()->json(['success' => '0']);
        }   
        return response()->json(['success' => '1','data'=>$ans]);
        
    }
}
