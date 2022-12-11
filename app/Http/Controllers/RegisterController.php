<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //METODO QUE MUESTRA LA VISTA 'auth.register'
    public function index()
    {
        return view('auth.register');
    }



    //METODO PARA GUARDAR LA INFORMACION DEL USUARIO QUE SE REGISTRA EN LA BD
    public function store(Request $request)
    {
       //modificar el username para que sea unico
       $request->request->add(['username' => Str::slug($request->username)]);
       
       //validaciones de los campos
       $this->validate($request,[
        'name' => 'required|max:30',
        'username' => 'required|unique:users|min:3|max:30',
        'email' => 'required|unique:users|max:60',
        'password' => 'required|confirmed|min:6'
       ]);

       //INPORTANDO EL MODELO PARA CREAR REGISTRO
       User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password) //encriptando el password
       ]);

       //AUTENTICAR UN USUARIO
       auth()->attempt([
        'email' => $request->email,
        'password' => $request->password
       ]);

       //OTRA FORMA DE AUTENTICAR
       //auth()->attempt($request->only('email','password'));

       //Redireccionar ruta posts y mandando en nombre del usuario
       return redirect()->route('posts.index', auth()->user()->username);

    }
}
