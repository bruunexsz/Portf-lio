<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriasFaixas extends Model
{
    protected $table = 'categorias_faixas';
    
    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'categoria',
        'faixa',
       
    ];
}
