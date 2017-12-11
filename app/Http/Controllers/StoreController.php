<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Exception;
use App\Http\Requests;


class StoreController extends Controller
{
    //
    public function index(){
        return view('shop_index');
    }
    public function goods_management(){
        return view('shop_management');
    }
    public function goods_update(){
        return view('shop_edit');
    }
    public function talk(){

        return view("talk2");
    }
    public function setting(){
        return view('shop_setting');
    }
    public function check(){
        return view('shop_check');
    }
}
