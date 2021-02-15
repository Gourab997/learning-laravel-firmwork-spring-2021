<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;



class LoginController extends Controller
{
 public function index(){
return view('login.index');

    }

  public  function verify(Request $req){

     $user =User::where('password', $req->password)
                 ->where('username',$req->username)
              ->get(); 
     // return view('login.test');

       if($req->username == "" || $req->password == ""){
          $req->session()->flash('msg','Invalid');
          return redirect('/login');
       }elseif(count($user) > 0 ){
      //echo "valid user";
 
     
// // $req->session()->get('name');
//      $req->session()->forget('name');
//      $req->session()->flush();
//      $req->session()->has();

// $req->session()->flash('msg','invalid');
// $req->session()->get('msg');
// $req->session()->keep('msg')
     //$req->session()->reflash();
     //$req->session()->pull();

     $req->session()->put('username',$req->username);
     return redirect('/home');

            } else{

               $req->session()->flash('msg','Invalid');
                 return redirect('/login');

            }

}
}
