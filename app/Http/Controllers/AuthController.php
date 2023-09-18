<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //proses login
    /*
        $pass = 123;
        echo Hash::make($pass);
        */
    public function proseslogin(Request $request)
    {
        if (Auth::guard('pendidik')->attempt(['nik' => $request->nik, 'password' => $request->password])) { 
            return redirect('/dashboard');
        }else{
            return redirect('/')->with(['warning'=>'NIK / Password Salah']);
        }
    }

    public function proseslogout()
    {
        if(Auth::guard('pendidik')->check()) {
            Auth::guard('pendidik')->logout();
            return redirect('/');
        }
    }

    public function proseslogoutadmin()
    {
        if(Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }

    public function prosesloginadmin(Request $request)
    {
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) { 
            return redirect('/panel/dashboardadmin');
        }else{
            return redirect('/panel')->with(['warning'=>'Username atau Password Salah']);
        }
    }

}
