<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faixas extends Model
{
    protected $table = 'faixas';
    
    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'nome',
       
    ];
}
