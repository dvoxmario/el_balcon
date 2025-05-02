<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Importa la clase correctamente
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'identifiers',
        'responsible',
        'password',
        'identification_type_id',




    ];

    // Métodos necesarios para JWTSubject

    public function getJWTIdentifier()
    {
        return $this->getKey(); // Devuelve la clave primaria del usuario
    }

    public function getJWTCustomClaims()
    {
        return [];  // Aquí puedes agregar información adicional si lo deseas
    }
}
