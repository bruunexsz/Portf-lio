<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipes;
use App\Models\Instituicoes;
use App\Models\Atletas;
use App\Models\Faixas;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class AtletasController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function showAtletas()
    {
        $user = auth()->user();

        // Verifica se o usuário é um administrador
        if ($user->isAdmin()) {
            // Se o usuário for um administrador, mostra todos os atletas
            $atletas = Atletas::whereNull('deleted_at')->get();
        } else {
            // Se não for um administrador, mostra apenas os atletas da instituição do usuário
            $atletas = Atletas::whereHas('instituicao', function ($query) use ($user) {
                $query->where('usuario', $user->id);
            })->whereNull('deleted_at')->get();
        }

        return view('atletas.show', ['atletas' => $atletas]);
    }
    public function showFormEdit($id)
    {
        $atleta = Atletas::findOrFail($id); // Encontra o atleta com o ID fornecido

        // Obtém as instituições do usuário logado
        $user = auth()->user();
        $instituicoes = Instituicoes::where('usuario', $user->id)->get();

        // Obtém as faixas do atleta
        $faixas = Faixas::where('id', $atleta->faixa)->get();
        $allFaixas = Faixas::all();

        // Aqui você pode adicionar lógica adicional, como verificar se o usuário tem permissão para editar este atleta

        return view('atletas.edit', compact('atleta', 'instituicoes', 'faixas', 'allFaixas'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            // Aqui você pode definir as regras de validação para os campos do formulário de edição
            'nome' => 'required|string|max:255',
            'apelido' => 'nullable|string|max:255',
            'data_de_nascimento' => 'required|date',
            'peso' => 'required|numeric',
            'faixa' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'sexo' => 'required|integer|in:1,2', // Aceita apenas os valores 1 ou 2
            'altura' => 'required|numeric',
            // Adicione regras de validação adicionais conforme necessário
        ]);

        $atleta = Atletas::findOrFail($id); // Encontra o atleta com o ID fornecido

        // Atualiza os dados do atleta com base nos dados do formulário
        $atleta->update($request->all());

        // Redireciona de volta para a página de detalhes do atleta ou qualquer outra página desejada
        return redirect()->route('show-atletas', ['id' => $atleta->id])->with('success', 'Atleta atualizado com sucesso.');
    }



    public function showFormCreate()
    {
        $user = auth()->user();

        // Verifica se o usuário é um administrador
        if ($user->isAdmin()) {
            // Se o usuário for um administrador, mostra todas as instituições
            $instituicoes = Instituicoes::all();
        } else {
            // Se não for um administrador, mostra apenas as instituições do usuário
            $instituicoes = Instituicoes::where('usuario', $user->id)->get();
        }

        $faixas = Faixas::all();

        return view('atletas.create_form', [
            'instituicoes' => $instituicoes,
            'faixas' => $faixas,
        ]);
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'apelido' => 'nullable|string|max:255',
            'instituicao' => 'required|integer|exists:instituicoes,id',
            'data_de_nascimento' => 'nullable|date',
            'peso' => 'nullable|numeric',
            'faixa' => 'nullable|integer|exists:faixas,id',
            'status' => 'required|boolean',
            'sexo' => 'required|integer|in:1,2', // Aceita apenas os valores 1 ou 2
            'altura' => 'nullable|numeric',
        ]);
        // Criação do novo atleta
        $atleta = Atletas::create($validatedData);

        // Redirecionamento após a criação do atleta
        return redirect()->route('atletas.create-form', $atleta->id)->with('success', 'Atleta cadastrado com sucesso.');
    }


    public function destroy($id)
    {
        $atleta = Atletas::findOrFail($id);

        // Adicione aqui a lógica para verificar se o usuário tem permissão para excluir o atleta

        $atleta->delete();

        return redirect()->route('show-atletas')->with('success', 'Atleta excluído com sucesso.'); // Redireciona para onde desejar após a exclusão
    }
}
