<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instituicoes extends Model
{
    protected $table = 'instituicoes';
    
    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'nome',
        'responsavel',
        'usuario',
        'email',
        'telefone',
        'logradouro',
        'numero',
        'bairro',
        'complemento',
        'estado',
        'cidade',
        'status',
    ];
}
