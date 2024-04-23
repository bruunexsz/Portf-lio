<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscricao extends Model
{
    protected $table = 'inscricoes'; // Corrigido o nome da tabela

    protected $fillable = ['id', 'atleta', 'competicao', 'categoria', 'status', 'equipe'];

    
    public function competicao_inscrito() {
        return $this->belongsTo('App\Models\Competicoes', 'competicao'); // Corrigido o namespace do modelo Competicoes
    }
    
    public function atleta_inscrito() {
        return $this->belongsTo('App\Models\Atletas', 'atleta'); // Corrigido o namespace do modelo Atletas
    }
    
    public function equipe_inscrito() {
        return $this->belongsTo('App\Models\Equipes', 'equipe'); // Corrigido o namespace do modelo Equipes
    }

    
    public function categoria_inscrito() {
        return $this->belongsTo('App\Models\Categorias', 'categoria');
    }
    public function getStatusDescAttribute($value) {
        if ($stats = 0) {
            return 'Pendente';
        } else {
            return 'Confirmado';
        }
    }
}
