<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filiacao extends Model
{
    protected $table = 'cadastrofiliadosfiliacaodeassociacao';
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
        'NomeDoRepresentante',
        'RG',
        'CPF',
        'DtNascimento',
        'CidadeDeNascimento',
       'EstadoDeNascimento',
       'NomeDaAssociacao',
        'EnderecoDaAssociacao',
        'BairroDaAssociacao',
        'TelefoneDaAssociacao',
        'CepDaAssociacao',
        'CidadeDaAssociacao',
        'EstadoDaAssociacao',
        'CnpjDaAssociacao',
        'ProfessorInstrutor',
        'GraduacaoProfessorInstrutor',
        'ProfessorDirecaoTecnica',
        'GraduacaoProfessorDirecaoTecnica',
        'NomeDaAssociacaoPlaca',
        'FichaLida',
       
    ];
}