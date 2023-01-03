<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //PROTEGIENDO LA VISTA HOME 
    public function __construct()
    {
        $this->middleware('auth');
    }

    //VIENDO LAS PUBLICACIONES DE MIS SEGUIDORES
    public function __invoke()
    {
        //PERSONAS QUE ESTOY SIGUIENDO
        $ids = auth()->user()->following->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
 
        return view('home', [
            'posts' => $posts
        ]);
    }
}
