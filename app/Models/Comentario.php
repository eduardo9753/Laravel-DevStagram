<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'comentario'
    ];

    //RELACION EN LARAVAL
    public function user()
    {
        //CADA COMENTARIO TIENE UN USUARIO QUE LO ESTA CREANDO
        return $this->belongsTo(User::class);
    }
}
