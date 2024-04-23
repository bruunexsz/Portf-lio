<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompeticoesCategorias extends Model
{
    protected $table = 'competicoes_categorias';
    
    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'competicao',
        'categoria',
       
    ];

    public function scopeCategoriasHabilitadas($query, $atleta) {
        return $query->whereHas('competicoes_categorias', function ($query) use ($atleta) {

            return $query->where('sexo', $atleta->sexo)
                ->where('idade_minima', '<=', intval($atleta->idade))
                ->where('idade_maxima', '>=', intval($atleta->idade))
                ->where('peso_minimo', '<=', floatval($atleta->peso))
                ->where('peso_maximo', '>=', floatval($atleta->peso))
                ->where('altura_minima', '<=', floatval($atleta->altura))
                ->where('altura_maxima', '>=', floatval($atleta->altura))
                ->whereHas('categorias_faixas', function ($query) use ($atleta) {
                    $query->where('faixa', $atleta->faixa);
                });
        });
    }

    public function competicoes_categorias() {
        return $this->belongsTo('App\Models\Categorias', 'categoria');
    }
}
