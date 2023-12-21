<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    // Esto es un separador de codigo
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'alias', 'web', 'password',
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

    // $user->theme
    public function themes() {
        return $this->hasMany(Theme::class);
    }

    // $user->articles
    public function articles() {
        return $this->hasMany(Article::class);
    }

    public function roles() {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    // public function getNameAttribute($valor) {
    //     return ucfirst(strtolower($valor));
    // }

    public function setNameAttribute($valor) {
        // $this->attributes['name'] = ucfirst(strtolower($valor));
        $this->attributes['name'] = ucfirst(mb_strtolower($valor, 'UTF-8'));
    }

    public function getUsuarioRolesAttribute() {
        $roles = $this->roles;
        foreach($roles as $role) {
            echo $role->nombre."<br>";
        }
    }

    public function getUsuarioBloqueadoAttribute() {
        $bloqueado = $this->bloqueado;
        if(!$bloqueado)
            return "No bloqueado";
        return "Bloqueado";
    }

    public function hasRole($role)
    {
        $roles=$this->roles;
        foreach ($roles as $suRole)
        {
            if($suRole->nombre==$role)  // no se pueden llamar las dos variables iguales
                return true;
        }
        return false;  
    }
}
