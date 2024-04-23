<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kuy extends Model
{
    protected $table = 'cadastrofiliadospromocaodekyu';
    public $timestamps = false; // Desativa a atualização automática de created_at e updated_at

    // Se você estiver usando uma versão mais recente do Laravel e precisar 
    // definir o campo de data manualmente, você pode fazer isso usando a propriedade $dates
    protected $dates = [
        'DataPreenchimento',
    ];

    protected $fillable = [
        'ID',
        'IDUsuarioFiliado',
        'DataPreenchimento',
        'NomeDaAssociacao',
        'Professor',
        'DDDTelefone',
        'DtDoExame',
        'Examinador',
        'NomesAtletasInformacoes',
        'NPromocoes',
        'Valor',

    ];
}
