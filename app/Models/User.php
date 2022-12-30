<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    /*SON LOS DATOS QUE EL USUARIO NOS MANDA Y QUE SE ENCUENTRA EN LA BASE DE DATOS*/
    protected $fillable = [
        'name',
        'email',
        'password',
        'username'  //agregando el nuenvo campo creado para que no marque error
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    //RELACIONES USUARIO CON MULTIPLES POST
    public function posts()
    {
        return $this->hasMany(Post::class);
        //SI ROMPES LA CONVENCION DE LARAVEL
        //return $this->hasMany(Post::class, 'autor_id');
    }

    //RELACIONES USUARIO CON MULTIPLES LIKE
    public function likes()
    {
        //UN USUARIO PUEDE TENER MULTIPLES LIKE
        return $this->hasMany(Like::class);
    }

    //SEGUIR DE UN USUARIO
    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    //DEJAR DE SEGUIR UN USUARIO
    public function afollowers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    //PERSONAS A QUIEN SIGO
    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }


    //COMPROBAR SI UN USUARIO YA SIGUE A OTRO
    public function siguiendo(User $user)
    {
        //CON EL METODO DE followers VA COMPROBAR SI UN USUARIO YA ESTA SIGUIENDO A OTRO
        //ESTE METODO RETORNA TRUE O FALSE
        return $this->followers->contains($user->id);
    }
}
