<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'pagina_web'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Evento que se ejecuta cuando un usuario es creado
    protected static function boot()
    {
        parent::boot();

        //asignar perfil una vez se haya creado un usuario nuevo
        static::created(function ($user){
            $user->perfil()->create();
        });
    }


    //relacion de 1:n de usuario a recetas
    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    //Relacion 1 a 1
    public function perfil()
    {
        return $this->hasOne(Perfil::class);
    }

    //recetas a las que el usuario le ha dado me gusta
    public function meGusta()
    {
        return $this->belongsToMany(Receta::class, 'likes_receta');
    }
}

