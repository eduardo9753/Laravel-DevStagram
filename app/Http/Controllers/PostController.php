<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    //AUTENTICACION 'este metodo se ejecuta primero' DE ELLO INGRESAMOS AL MURO
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index');
    }

    //DESPUES QUE SE AUTENTICO VIAJA A ESTE METODO
    public function index(User $user)
    {
        //Data de los posts registrados por los usuarios
        $posts = Post::where('user_id', $user->id)->latest()->paginate(4);

        //PASANDO LA VARIABLE 'user y posts' A LA VISTA PARA IMPRIMIR
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts
        ]);
    }

    //METODO PARA CREAR POST DE LOS USUARIOS "reotorna una vista"
    public function create()
    {
        return view('posts.create');
    }

    //METODO PARA GUADAR LOS POSTS DE LOS USUARIOS
    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        /*Post::create([
        'titulo' => $request->titulo,
        'descripcion'=> $request->decripcion,
        'imagen' => $request->imagen,
        'user_id' => auth()->user()->id
       ]);*/

        /*otra forma
       $post = new Post;
       $post->titulo = $request->titulo;
       $post->descripcion = $request->descripcion;
       $post->imagen = $request->imagen;
       $post->user_id = auth()->user()->id;
       $post->save(); */

        //GUARDANDO LOS DATOS YA RELACIONADOS EN LOS MODELOS "Models/User.php - Models/Post.php"
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->decripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);


        //REDIRECCIONAMOS A LA LISTA DE POST
        return redirect()->route('posts.index', auth()->user()->username);
    }


    //PARA VER UNA PUBLICACION
    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'user' => $user,
            'post' => $post
        ]);
    }

    public function destroy(Post $post)
    {
        //ELIMINANDO DE LA BASE DE DATOS
        $this->authorize('delete', $post);
        $post->delete();

        //ELIMINANDO LA IMAGEN DEL SERVIDOR
        $imagen_path = public_path('uploads/' . $post->imagen);

        //use Illuminate\Support\Facades\File;
        if (File::exists($imagen_path)) {
            unlink($imagen_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
