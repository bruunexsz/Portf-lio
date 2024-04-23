<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    protected $table = 'cadastroevento';

    protected $fillable = [
        'ID',
        'AtivacaoDoEvento',
        'DataInicial',
        'DataFinal',
        'SeparadorData',
        'TituloDoEvento',
        'LocalDoEvento',
        'TextoConteudoDoEvento',
        'CartazDoEvento',
        'UrlAmigavel', // Este campo foi adicionado, pois é utilizado na cláusula WHERE da sua consulta SQL
    ];
    
    
}