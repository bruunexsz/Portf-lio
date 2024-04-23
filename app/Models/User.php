<?php
namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Passwords\CanResetPassword; // Importe o trait CanResetPassword

class User extends AuthenticatableUser implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword; // Adicione o trait CanResetPassword

    protected $table = 'users';

    protected $fillable = [
        'DataCadastroUsuario',
        'id',
        'email',
        'LoginUsuario',
        'password',
        'AtivacaoUsuario',
        'CadastradoPor',
        'permissao',
    ];

    protected $hidden = [
        'password',
       
    ];

    // Este método é necessário para o login do usuário
    public function getAuthPassword()
    {
        return $this->password;
    }
}
