<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MensagemFiliados extends Model
{
    protected $table = 'cadastromensagemfiliado';
    protected $primaryKey = 'ID'; // Definindo o nome da chave primária

    public $timestamps = false;

    protected $fillable = [
        'ID',
        'AtivacaoDaMensagem',
        'DataDeCadastroDaMensagem',
        'TituloDaMensagem',
        'PastaDeConteudoDaMensagem',
       'TextoConteudoDaMensagem',
    ];
}