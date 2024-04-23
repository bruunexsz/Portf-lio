<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    public function isAdmin()
    {
        // Verifica se existe uma entrada na tabela 'role_user' com role_id igual a 1
        return $this->roles()->where('role_id', 1)->exists();
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    }

    public function hasRole($roleId)
    {
        return $this->roles()->where('id', $roleId)->exists();
    }
}
