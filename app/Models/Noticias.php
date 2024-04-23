<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    protected $table = 'noticia';

    protected $fillable = [
        'ID',
        'Ativacao',
        'DataDeCadastro',
        'Titulo',
        'UrlAmigavel',
        'ImagemDestaque',
        'Chamada',
    ];
    
}