<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Atletas extends Model
{
    protected $table = 'atletas';

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'nome',
        'apelido',
        'instituicao',
        'data_de_nascimento',
        'peso',
        'faixa',
        'status',
        'sexo',
        'altura',
    ];
    public function instituicao()
    {
        return $this->belongsTo(Instituicoes::class, 'instituicao');
    }

    public function atleta_instituicao() {
        return $this->belongsTo('App\Models\Instituicoes', 'instituicao');
    }
    
    public function atleta_inscricoes() {
        return $this->hasMany('App\Models\Inscricao', 'atleta');
    }

    public function getIdadeAttribute() {
        return Carbon::parse($this->data_de_nascimento)->age;
    }
    
  
}
