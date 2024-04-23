<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{
    protected $table = 'cadastrogaleria';
    protected $fillable = [
        'ID',
        'AtivacaoDaGaleria', // Note que os nomes dos campos devem corresponder aos retornados pela consulta SQL
        'DataDeCadastroDaGaleria',
        'TituloDaGaleria',
        'PastaDeConteudoDaGaleria',
        'UrlAmigavelDaGaleria',
    ];
    
}