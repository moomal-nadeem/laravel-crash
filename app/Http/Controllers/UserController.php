<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class UserController extends Controller
{
    //
    public function show()
    {
      $data = Http::withoutVerifying()
          ->get("https://reqres.in/api/users?page=1");
  
      return view('dashboard', ['collection'=>$data['data']]);
  }
     public function vueReturn(){
        return view('welcome');
     }


     public function addUser(Request $req)
     {
         $validatedData = $req->validate([
             'email' => 'required|email|unique:users',
             'password' => 'required|string|min:3'
         ]);
     
         $data = $req->input('email');
         
         // Flash a session message
         $req->session()->flash('email', $data);
     
         return redirect('login');
     }
     


     public function deleteUser(){
      return "delete user";
     }
     public function editUser(){
      return "edit user";
     }

     public function getUser(){
      return "view user";
     }
}


