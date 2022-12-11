<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    //AUTENTICACION DEL USUARIO
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        //modificar el username para que sea unico
        $request->request->add(['username' => Str::slug($request->username)]);

        //VALIDANDO LOS DATOS DEL NOMBRE DE USUARIO
        $this->validate($request, [ //OTRA FORMA DE VALIDACION EN ARREGLO
            'username' =>  ['required', 'unique:users,username,' . auth()->user()->id, 'min:3' . 'max:30', 'not_in:twitter,editar-perfil']
        ]);

        if ($request->imagen) {
            $imagen = $request->file('imagen'); //NOMBRE DEL INPUT

            $nombreImagen = Str::uuid() . "." . $imagen->extension(); //encriptando la imagen con su extension

            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }

        //GUARDAR CAMBIOS EN LA BASE DE DATOS
        $usuario = User::find(auth()->user()->id);  //buscamos el usuario por id
        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;  //valida si hay contenido en la imagen
        $usuario->save(); //guardamos los datos en la base de datos

        //REDIRECCIONAR
        return redirect()->route('posts.index', $usuario->username);
    }
}
