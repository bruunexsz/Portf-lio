<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FiliacaoAtletas extends Model
{
    protected $table = 'cadastrofiliadosfiliacaodeatleta';
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
        'NRegistroFKP',
        'NomeDoAtleta',
        'Endereco',
        'NEndereco',
        'Bairro',
        'Telefone',
        'Cidade',
        'Estado',
        'CEP',
        'NomeDoPai',
        'NomeDaMae',
        'DtNascimento',
        'RG',
        'GraduacaoAtual',
        'DtGraduacaoAtual',
        'AssosiacaoFiliada',
        'ProfessorResponsavel',
        'FichaLida',
        'imagem_filiado',
        'pdf_arquivo',
       
    ];
}