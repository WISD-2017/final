<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/login',function(){
    return view('login');
});
Route::get('/login2',function(){
    return view('login2');
});
#瀏覽店家
Route::get('/stores/{locate}',function($locate){
    return view('stores',['locate'=>$locate]);
});
Route::get('/shop/{id}',function($shopId){
    return view('stores2',['shop'=>$shopId]);
});
Route::get('/checkout',function(){
    return view('checkout');
});
Route::group(['prefix' => 'store/admin'],function(){
    Route::get('/','StoreController@index');
    Route::get('/goods_management','StoreController@goods_management');
    Route::get('goods_update/{id}','StoreController@goods_update');
    Route::get('/setting','StoreController@setting');
    Route::get('/talk','StoreController@talk');
    Route::get('/check','StoreController@check');
    Route::get('check/{id}','StoreController@detailcheck');
});
Route::group(['prefix' => 'member/admin'],function(){
    Route::get('/','MemberController@index');#通知
    Route::get('/setting','MemberController@setting');
    Route::get('/talk','MemberController@talk');
    Route::get('/googleMap','MemberController@map');#訂單ＧＯＯＧＬＥ
    Route::get('/check','MemberController@check');#訂單瀏覽
    Route::get('/check/{id}','MemberController@detailcheck');#詳細資訊

    
});
#會員api＋登入註冊+ 設定
Route::group(['prefix' => 'rest/api'], function () {
    Route::post('/login','AdminController@login');
    Route::post('/register','AdminController@register');
    Route::post('/shop_login','AdminController@storelogin');#except
    Route::post('/setting','AdminController@setting');
    Route::post('/setting/shop','AdminController@shop');
    Route::post('/setting/recommend','AdminController@recommend');
    Route::post('/setting/disturb','AdminController@disturb');
    Route::get('/check','AdminController@check');#得到該會員訂單
    
    
});
 #shop api
Route::group(['prefix'=>'rest/api/shop'],function(){
    Route::get('/get_all','ShopController@get_all');# 商店全部
    Route::post('upload','ShopController@upload');#上架
    Route::post('goods_update','ShopController@goods_update'); # 更新
    Route::get('goods','ShopController@get_goods');#得到貨物
    Route::get('goods_one','ShopController@goods_one');#貨物得到 only_one
    Route::get('setting_time','ShopController@setting_time');
    Route::get('setting_name','ShopController@setting_name');
    Route::get('setting','ShopController@setting');
    Route::post('get_ShopAll_goods','ShopController@get_ShopAll_goods');
    Route::delete('goods_delete','ShopController@goods_delete');#刪除貨物
    Route::get('/check','ShopController@check');
});
Route::group(['prefix'=>'rest/api/buy'],function(){
    Route::post('/get_goods','BuyController@get_goods');//結帳_得到物品
    Route::post('/checkout','BuyController@checkout'); //結帳2
    Route::get('/detail','BuyController@detail');# 顧客細節
    Route::post('/checkdetial','BuyController@checkdetial');#顧客細節2
    Route::get('/shop_detial','BuyController@shop_detial');

});

