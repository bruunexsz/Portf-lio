<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipes;
use App\Models\Instituicoes;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class EquipesController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function showEquipes()
    {
        $user = auth()->user();
    
        // Verifica se o usuário é um administrador
        if ($user->isAdmin()) {
            // Se o usuário for um administrador, mostra todas as equipes
            $equipes = Equipes::whereNull('deleted_at')->get();
        } else {
            // Se não for um administrador, mostra apenas as equipes das instituições do usuário
            $equipes = Equipes::whereIn('instituicao', function ($query) use ($user) {
                $query->select('id')
                    ->from('instituicoes')
                    ->where('usuario', $user->id);
            })->whereNull('deleted_at')->get();
        }
    
        return view('equipes.show', ['equipes' => $equipes]);
    }
    



    public function showFormCreate()
    {
        // Obtém o ID do usuário autenticado
        $userId = auth()->id();

        // Obtém as instituições associadas ao usuário atual
        $instituicoes = Instituicoes::where('usuario', $userId)->get();

        return view('equipes.create_form', ['instituicoes' => $instituicoes]);
    }


    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'instituicao' => 'required|exists:instituicoes,id', // Verifica se a instituição selecionada existe na tabela 'instituicoes'
        ]);

        // Cria uma nova equipe com os dados fornecidos pelo formulário
        $equipe = new Equipes([
            'nome' => $request->nome,
            'instituicao' => $request->instituicao,
        ]);

        // Salva a nova equipe no banco de dados
        $equipe->save();

        // Redireciona de volta à página de visualização de equipes com uma mensagem de sucesso
        return redirect()->route('equipes.create-form')->with('success', 'Equipe criada com sucesso!');
    }
}
