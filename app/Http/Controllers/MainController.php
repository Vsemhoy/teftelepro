<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
//use App\Models\Admin;
use App\Models\User;

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
      'name'=>'required|min:3|max:32',
      'email'=>'required|email|unique:users',
      'password'=>'required|min:5|max:32',
      'checkpassword'=>'required'
    ]);
    
    $check = DB::select('select name from users where name = :name', ['name' => $request->name]);
    if ($check != null)
    {
      return back()->with('fail', 'This username is already taken');
    };

    // if ($request->password != $request->checkpassword){
    //   return back()->with('fail', 'Check password do not match');
    // };
    //Insert data into database
    $user =  new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $save = $user->save();

    if ($save)
    {
      return back()->with('success', 'New user has been successfully added to database');
    }
    else 
    {
      return back()->with('fail', 'Something went wrong, try again later');
    }
  }

  function check(Request $request){
    //return $request->input();
    $request->validate([
      'email' => 'required|email',
      'password' => 'required|min:5|max:32'
    ]);

    $userInfo = User::where('email', '=', $request->email)->first();

    if (!$userInfo){
      return back()->with('fail', 'We do not recognize your email address');
    } else {
      // check password
      if (Hash::check($request->password, $userInfo->password)){
        $request->session()->put('LoggedUser', $userInfo->id);
        return redirect('home');
      } else {
        return back()->with('fail', 'Incorrect password');
      }
    }
  }

  function logout(){
    if (session()->has('LoggedUser')){
      session()->pull('LoggedUser');
      return redirect('login');
    }
  }

  function home(){
    $data = ['LoggedUserInfo' => User::where('id', '=', session('LoggedUser'))->first()];
    return view('home', $data);
  }
}