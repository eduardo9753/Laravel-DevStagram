<?php

namespace App\Models;

use App\Http\Controllers\LikeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /*SON LOS DATOS QUE EL USUARIO NOS MANDA Y QUE SE ENCUENTRA EN LA BASE DE DATOS*/
    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    //UN POST PERTENECE A UN USUARIO "ESTA FUNCION ME RETORNA EL 'name','username','email' del usuario"
    //y se esta aplicando en la vista home.blade.php
    public function user()
    {
        return $this->belongsTo(User::class)->select(['name','username','email']);
    }

    //RELACION EN LARAVAL
    public function comentarios()
    {
        //UN POST CON MULTIPLES COMENTARIOS
        return $this->hasMany(Comentario::class);
    }

    //RELACION EN LARAVEL
    public function likes()
    {
        //UN POST PUEDE TENER MUCHOS LIKE
        return $this->hasMany(Like::class);
    }

    //VERIFICACION PARA QUE NO SE DUPLIQUE UN LIKE
    public function checkLike(User $user)
    {
        //VA REVISAR SI CONTIENE ESTE USUARIO DE ESTE POST
        return $this->likes->contains('user_id', $user->id);
    }
}