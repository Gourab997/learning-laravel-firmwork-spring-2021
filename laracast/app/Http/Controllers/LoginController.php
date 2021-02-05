<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;





class LoginController extends Controller
{
 public function index(){
return view('login.index');

    }

  public  function verify(){
       // return view('login.test');
       echo "posted";
            }
}
