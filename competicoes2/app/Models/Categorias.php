<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    protected $table = 'categorias';
    
    protected $fillable = [
        'created_at',
        'updated_at',
        'deleted_at',
        'nome',
        'idade_minima',
        'idade_maxima',
        'sexo',
        'tipo',
        'sistema',
        'altura_minima',
        'altura_maxima',
        'peso_minimo',
        'peso_maximo',
        'equipe',
    ];

    public function getTipoDescricaoAttribute() {
        if ($this->tipo == 1) {
            return 'Kata Básico';
        } elseif ($this->tipo == 2) {
            return 'Kata Tokuy';
        } else{
            return 'Kumite';
        }
    }
    public function categorias_faixas() {
        //        return $this->belongsToMany('App\CategoriasFaixa', 'categorias_faixas', 'id', 'categoria');
                return $this->hasMany('App\Models\CategoriasFaixas', 'categoria');
            }		public function getTipoDescAttribute() {        if ($this->tipo == 1) {			return "Kata";		} elseif ($this->tipo == 2) {			return "Kata Tokuy";		} else {			return "Kumite";		}    }		public function getSexoDescAttribute() {        if ($this->sexo == 1) {			return "Masculino";		} else {			return "Feminino";		}    }
}
