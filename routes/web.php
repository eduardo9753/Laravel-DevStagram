<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*VISTA PRINCIPAL - CUANDO CARGA LA PAGINA*/
Route::get('/', HomeController::class)->name('home');





/*NOMBRE DE LA RUTA - LLAMADO DEL CONTROLADOR Y SU METODO - ''*/
Route::get('/register', [RegisterController::class, 'index'])->name('register'); /*VISTA: CREAR CUENTA*/
Route::post('/register', [RegisterController::class, 'store']);



/*LOGIN*/
Route::get('/login', [LoginController::class, 'index'])->name('login'); /*VISTA: LOGIN*/
Route::post('/login', [LoginController::class, 'store']);



/*PERFIL*/
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');



/*POST: MURO DESPUES DE LOGIARSE CON URL´S AMIGABLES PARA QUE APAREZCA TU NOMBRE */
Route::get('/{user:username}', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');



/*COMENTARIOS*/
Route::post('/{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');



/*LOGOUT*/
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');



/*SUBIDA DE IMAGENES*/
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');



/*LIKE*/
Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');



/*SEGUIMIENTO DE USUARIO*/
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/follow', [FollowerController::class, 'destroy'])->name('users.unfollow');
