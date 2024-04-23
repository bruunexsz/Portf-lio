<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Descricao; 
use App\Models\Noticias; 
use App\Models\Galeria;
use App\Models\Resultados;
use App\Models\Eventos;
class SiteController extends BaseController
{
    public function index()
    {
        return view('index'); // ou qualquer outra coisa que você queira retornar
    }
    public function karatedo()
    {
        return view('karatedo');
    }
    public function fkp()
    {
        // Recupere o TextoConteudoDaDescricao da tabela descricao
        $textoDescricao = Descricao::pluck('TextoConteudoDaDescricao')->first();

        // Envie o dado para a view 'fkp'
        return view('fkp', compact('textoDescricao'));
    }
    public function noticias()
    {
        // Recupere os dados da tabela noticia com a condição especificada
        $noticias = Noticias::where('Ativacao', 1)
                            ->orderBy('DataDeCadastro', 'desc')
                            ->get();
    
        // Envie os dados para a view 'noticias'
        return view('noticias', compact('noticias'));
    }
    public function fotos()
    {
       
        
        // Retorna a view 'fotos' passando as galerias como parâmetro
        return view('fotos');
    }
    
    public function resultados()
    {
        // Aqui você pode incluir a lógica para buscar os resultados do banco de dados
        $resultados = Resultados::where('AtivacaoDoResultado', 1)
            ->orderByDesc('DataDoResultado')
            ->get();
    
        // Retorna a view 'resultados' passando os resultados como parâmetro
        return view('resultados', ['resultados' => $resultados]);
    }
    public function eventos()
    {
        $eventos = Eventos::where('AtivacaoDoEvento', 1)->get();
        return view('eventos', compact('eventos'));
    }
    public function contato()
    {
        return view('contato');
    }
}
