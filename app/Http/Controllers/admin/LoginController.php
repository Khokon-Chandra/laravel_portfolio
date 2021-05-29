<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    function login()
    {
        return view('admin/login');
    }

    
    
    function onLogin(Request $request)
    {
       $user = DB::table('users')->where('email',$request->input('email'))->get()[0]??false;
       if($user){
           if(password_verify($request->input("password"),$user->password)){
                $request->session()->put('user', $user->id);
                return true;
           }
           return json_encode(['password'=>"Incorrect Password"]);
       }
       return json_encode(['email'=>"User not Found"]);
     
    }


    function onLogout(Request $request)
    {
        $request->session()->forget('user');
        return true;
    }






    function register()
    {
        return view('admin/register');
    }





    function onRegister(Request $request)
    {
        $password = password_hash($request->input('password'),PASSWORD_DEFAULT);

        if(!DB::table('users')->where('email','=',$request->input('email'))->get()->count()){
            
            if(DB::table('users')->insert([
                'fname'=>$request->input('fname'),
                'lname'=>$request->input('lname'),
                'email'=>$request->input('email'),
                'password'=>$password,
            ])){
                return true;
            }
            return json_encode(['error'=>'Registration Faild! try again!']);
        }

        return json_encode(['error'=>'Already has an Account!']);
    }






}
