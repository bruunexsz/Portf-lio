<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CampeonatoInscricao extends Model
{
    protected $table = 'cadastrofiliadosinscricaocampeonatos';
    public $timestamps = false; // Desativa a atualização automática de created_at e updated_at

    // Se você estiver usando uma versão mais recente do Laravel e precisar 
    // definir o campo de data manualmente, você pode fazer isso usando a propriedade $dates
    protected $dates = [
        'DataPreenchimento',
    ];

    protected $fillable = [
       
        'DataPreenchimento',
        'NomeCampeonato',
        'NomeAssociacao',
        'Professor',
       'DDDTelefone',
        'NAtletaKataKumite',
        'NAtletas',
        'TotalKata',
        'Valor',
        'Arbitro',
        'Mesario',
        'ProfessorResponsavel',
        
    ];
}