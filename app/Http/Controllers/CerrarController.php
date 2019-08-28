<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;  

class CerrarController extends Controller
{
    public function cerrar(){
        session()->flush();
        return redirect("/");
    }
}
