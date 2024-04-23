<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Descricao extends Model
{
    protected $table = 'cadastrodescricaofkp';

    protected $fillable = [
        'TextoConteudoDaDescricao',
       
    ];
}