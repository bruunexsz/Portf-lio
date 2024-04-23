<?php

namespace App\Http\Controllers;

use App\Models\Equipes;
use App\Models\Instituicoes;
use App\Models\Competicoes;
use App\Models\Inscricao;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class HomeController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function home()
    {
        // Recupera o último registro de Competicoes
        $ultimaCompeticao = Competicoes::latest()->first();
    
        // Verifica se existe uma competição
        if ($ultimaCompeticao) {
            // Recupera o ID da última competição
            $ultimaCompeticaoId = $ultimaCompeticao->id;
    
            // Conta o número de inscrições que correspondem à última competição
            $quantidadeInscricoes = Inscricao::where('competicao', $ultimaCompeticaoId)->count();
            $quantidadeAtletasUnicos = Inscricao::where('competicao', $ultimaCompeticaoId)->distinct('atleta')->count('atleta');
            // Retorna a view home com os dados da última competição e a quantidade total de inscrições
            return view('home', [
                'nomeCompeticao' => $ultimaCompeticao->nome,
                'inicioCompeticao' => $ultimaCompeticao->inicio_inscricao,
                'fimCompeticao' => $ultimaCompeticao->fim_inscricao,
                'quantidadeInscricoes' => $quantidadeInscricoes,
                'quantidadeAtletasUnicos' => $quantidadeAtletasUnicos,
                'ultimaCompeticaoId' => $ultimaCompeticaoId,

            ]);
        } else {
            // Se não houver competições registradas, retorna a view home sem dados
            return view('home');
        }
    }
}
