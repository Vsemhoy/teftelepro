<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
  function login(){
    return view('auth.login');
  }

  function registration(){
    return view('auth.registration');
  }

  function save(Request $request){
    //return $request->input();
    // Validate requests
    $request->validate([
      'username'=>'required|min:3|max:32',
      'email'=>'required|email',
      'password'=>'required|min:5|max:32',
      'checkpassword'=>'required',
    ]);

  }
}