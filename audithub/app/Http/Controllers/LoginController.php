<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function index(){
        return view('login');
    }

    function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'

        ],
        [
            'email.required' => 'Email Wajib Di Isi',
            'password.required' => 'Password Wajib Di Isi',

        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=> $request->password,
        ];

        if(Auth::attempt($infologin)){
            echo "<script>alert('Welcome')</script>";
            return redirect('/add');
        }else{
            echo "<script>alert('Password Salah')</script>";
            echo "<meta http-equiv='refresh' content='0; url=/'>";;
        }
    }
}
