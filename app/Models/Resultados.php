<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resultados extends Model
{
    protected $table = 'cadastroresultado';
    protected $fillable = [
        'ID',
        'AtivacaoDoResultado',
        'DataDoResultado',
        'TituloDoResultado',
        'LocalDoResultado',
        'IDGaleriaDeFotos',
        'UrlAmigavel'
    ];
    
}