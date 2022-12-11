<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    //VALIDAR EL LOGEO DEL USUARIO
    public function store(Request $request)
    {
       //Validacion de los campos y alerta el mensaje en la vista de login 
       $this->validate($request, [
          'email' => 'required|email',
          'password' => 'required'
       ]);

       /*Con en 'back' retornamos a la misma pagina y mostramos el error*/
       if(!auth()->attempt($request->only('email','password') , $request->remember)){
        /*La variable 'mensaje' se imprime en la vista de logeo como una session*/
           return back()->with('mensaje','Credenciales Incorrectas');
       }

       //Usuario correcto viajamos al controllador PostController y al metodo index
       //ademas le pasamos la variable username : auth()->user()->username
       return redirect()->route('posts.index', auth()->user()->username);
    }
}
