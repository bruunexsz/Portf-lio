<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competicoes extends Model
{
    protected $table = 'competicoes';
    
    protected $fillable = [
                'id',
                'created_at',
                'updated_at',
                'deleted_at',
                'nome',
                'tipo',
                'data',
                'local',
               'logradouro',
                'numero',
                'complemento',
               'bairro',
               'cidade',
                'estado',
                'inicio_inscricao',
                'fim_inscricao',
                'taxa_inscricao',
                'status',
    ];
    public function scopeInscricoesAbertas($query)
    {
        return $query->where('inicio_inscricao', '<=', Carbon::now())->where('fim_inscricao', '>=', Carbon::now());
    }	
}
