<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store(User $user, Request $request)
    {
        //ESTO VA LEER EL USUARIO QUE ESTAMOS VISITANDO SU MURO
        //Y VA AGREGAR QUE ESTA PERSONA LO ESTA SIGUIENDO
        //QUE ES LA PERSONA QUE ESTA AUTENTICADA
        $user->followers()->attach(auth()->user()->id);
        return back();
    }

    public function destroy(User $user, Request $request)
    {
        //DEJAR DE SEGUIR UN USUARIO
        $user->afollowers()->detach(auth()->user()->id);
        return back();
    }
}
