<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;        
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
            $email = $request->input("email");
            $password = $request->input("password");

            $credentials = $request->only('email','password','tipo');

            if($email == "administrador@gmail.com" && $password == "123"){
                Session::put("adminsession",$email);
                if(Session::has("adminsession")){
                    return redirect("admin");
                }
                else{
                    return view("index");
                }   
            }
            elseif(Auth::attempt($credentials)){
                Session::put("clientesession",$email);
                return redirect("cliente");
            }else{
                return back()->withErrors(['password' => "El Usuario no existe o la Informacion es Incorrecta"]);
            }
    
    }

}
