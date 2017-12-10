<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use \Exception;
use App\Http\Requests;
use Crypt;

class MemberController extends Controller
{
    public function index(){
        return view('admin_index');
        
    }
    public function setting(){
        return view('setting');
    }
    public function talk(){

        return view("talk");
    }

}
