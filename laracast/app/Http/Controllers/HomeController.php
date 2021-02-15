<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $req){
$id="123";
$name="g";
   if($req->session()->has('username')){
    return view('home.index',compact('id','name') );
   }else{
       $req->session()->flash('msg','invalid request');
       return redirect('/login');
   }
   
        
        // return view('home.index') ->with('name')
        // ;
    }

    public function create(){
        return view('home.create');
    }


public function store(Request $req){

   
    return redirect('/home/userlist');
    echo $req->username;
}

public function edit($id,Request $req){
$userlist = $this->getUserlist();
$user =[];
foreach($userlist as $u){
     if($u['id'] == $id){
         $user = $u;
         break;
     }
}

    return view('home.edit')->with('user',$user);
}

public function update($id,Request $req){
    $user = ['id'=> $id, 'name'=>$req->name, 'email'=>$req->email, 'password'=>$req->passwrod  ];
    return redirect('/home/userlist');

}
public function userlist(){
    $userlist =$this->getUserlist();
    return view('home.list')->with('userlist',$userlist);
}

    public function getUserlist(){

        return  [
           ['id'=>1 , 'name' => 'Gourab', 'email' => 'ads@gmail.com' , 'password' => '123' ],
           ['id'=>2 , 'name' => 'xyz', 'email' => 'asd@gmail.com' , 'password' => '123' ],
           ['id'=>3 , 'name' => 'abc', 'email' => 'ffg@gmail.com' , 'password' => '123' ],
        ];


      
    }
}
