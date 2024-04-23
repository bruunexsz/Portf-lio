<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Confrontos extends Model
{
    protected $table = 'confrontos';
    
    protected $fillable = ['competicao', 'categoria', 'atleta1', 'atleta2', 'vencedor', 'confronto_filho_vencedor', 'confronto_filho_perdedor'];
    
    public function getDescriptionForEvent($eventName)
    {
        return __CLASS__ . " model has been {$eventName}";
    }		
    public function primeiro_atleta() {        return $this->belongsTo('App\Models\Atleta', 'atleta1');    }		public function segundo_atleta() {        return $this->belongsTo('App\ModelsAtletas', 'atleta2');    }		public function confronto_competicao() {		return $this->belongsTo('App\Models\Competicoes', 'competicao');	}		public function confronto_categoria() {		return $this->belongsTo('App\Models\Categoria', 'categoria');	}

}

