<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = 'usuarionewsletter';
    public $timestamps = false;

    protected $fillable = [
        'ID',
        'AtivacaoDosDestinatarios',
        'CodigoDesativacaoDosDestinatarios',
        'NomesDosDestinatarios',
        'EmailsDosDestinatarios',
        'DataDeCadastroDosDestinatarios',
       
    ];
}