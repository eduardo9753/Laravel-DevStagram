<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //METODO PARA CERRA SESSION
    public function store()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
