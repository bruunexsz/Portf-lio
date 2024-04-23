<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipes extends Model
{
    protected $table ='equipes';
    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'nome',
        'instituicao',
    ];

    public function equipe_instituicao() {
        return $this->belongsTo('App\Models\Instituicoes', 'instituicao');
    }
    
    public function equipe_inscricoes() {
        return $this->hasMany('App\Models\Inscricoes', 'equipe');
    }
}
