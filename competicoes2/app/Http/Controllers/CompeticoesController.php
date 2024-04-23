<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Equipes;
use App\Models\Instituicoes;
use App\Models\Competicoes;
use App\Models\Categorias;
use App\Models\CompeticoesCategorias;
use App\Models\Faixas;
use App\Models\Inscricao;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Carbon\Carbon; // Importe a classe Carbon para trabalhar com datas

class CompeticoesController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function showCompeticoes()
    {
        $user = auth()->user();

        // Verifica se o usuário é um administrador
        if ($user->isAdmin()) {
            // Se o usuário for um administrador, mostra todas as competições
            $competicoes = Competicoes::all();
        } else {
            $today = now()->toDateString();

            // Filtra as competições com base na data de hoje e nas datas de início e fim de inscrição
            $competicoes = Competicoes::where('inicio_inscricao', '<=', $today)
                ->where('fim_inscricao', '>=', $today)
                ->get();
        }

        return view('competicoes.show', ['competicoes' => $competicoes]);
    }


    public function showFormCreate()
    {
        $categorias = Categorias::all();

        return view('competicoes.create_form', [
            'categorias' => $categorias,

        ]);
    }

    public function store(Request $request)
    {
        // Validação dos dados recebidos do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'data' => 'required|date',
            'local' => 'required|string|max:255',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:255',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'inicio_inscricao' => 'required|date',
            'fim_inscricao' => 'required|date',
            'taxa_inscricao' => 'required|numeric',
            'status' => 'required|boolean',
        ]);

        $competicao = Competicoes::create($validatedData);

        // Verifica se foram selecionadas categorias no formulário
        if ($request->has('categorias')) {
            // Itera sobre as categorias selecionadas
            foreach ($request->input('categorias') as $categoriaId) {
                // Criação da entrada na tabela pivot competicoes_categorias
                CompeticoesCategorias::create([
                    'competicao' => $competicao->id,
                    'categoria' => $categoriaId,
                ]);
            }
        }

        // Redirecionamento após a criação da categoria
        return redirect()->route('competicoes.create-form')->with('success', 'Competição criada com sucesso.');
    }
    public function showFormEdit($id)
    {
        $competicao = Competicoes::findOrFail($id);

        $categorias = Categorias::select('id', 'nome')->orderBy('nome')->get();
        $categorias = $categorias->pluck('nome', 'id');

        $categorias_competicao = CompeticoesCategorias::where('competicao', $competicao->id)->get()->pluck('categoria')->toArray();

        return view('competicoes.edit', compact('competicao', 'categorias', 'categorias_competicao'));
    }
    public function updated(Request $request, $id)
{
    $this->validate($request, [
        'nome' => 'required',
        'tipo' => 'required',
        'data' => 'required',
        'local' => 'required',
        'cidade' => 'required',
        'estado' => 'required',
        'inicio_inscricao' => 'required',
        'fim_inscricao' => 'required',
        'status' => 'required'
    ]);
    
    $requestData = $request->all();

    $competicao = Competicoes::findOrFail($id);
    $competicao->update($requestData);
    
    CompeticoesCategorias::where('competicao', $competicao->id)->delete();
    
    foreach ($request->categorias as $categoria) {
        $cat = new CompeticoesCategorias();
        $cat->competicao = $competicao->id;
        $cat->categoria = $categoria;
        $cat->save();
    }

    // Redireciona de volta para a página de edição da competição atualizada
    return redirect()->route('competicoes.edit-form', ['id' => $competicao->id])->with('success', 'Competição atualizada com sucesso.');
}

    public function showRelatorioComp(Request $request)
    {
        $inscricoes = Inscricao::selectRaw("
                IF(instituicoes_atletas.nome IS NOT NULL, instituicoes_atletas.nome, instituicoes_equipes.nome) as instituicao,
                IF(instituicoes_atletas.nome IS NOT NULL, 'Individual', 'Equipe') as tipo_inscricao,
                COUNT(inscricoes.id) as qtd_inscritos
            ")
            ->leftJoin('atletas', 'inscricoes.atleta', '=', 'atletas.id')
            ->leftJoin('equipes', 'inscricoes.equipe', '=', 'equipes.id')
            ->leftJoin('instituicoes as instituicoes_atletas', 'atletas.instituicao', '=', 'instituicoes_atletas.id')
            ->leftJoin('instituicoes as instituicoes_equipes', 'equipes.instituicao', '=', 'instituicoes_equipes.id')
            ->where('inscricoes.competicao', $request->competicao)
            ->where(function ($query) {
                $query->whereNotNull('atletas.id')->whereNotNull('instituicoes_atletas.id')
                    ->orWhere(function ($query) {
                        $query->whereNotNull('equipes.id')->whereNotNull('instituicoes_equipes.id');
                    });
            })
            ->whereNull('inscricoes.deleted_at')
            ->where(function ($query) {
                $query->whereNull('atletas.deleted_at')->orWhereNull('equipes.deleted_at');
            })
            ->groupBy('instituicao', 'tipo_inscricao') // Adicionando essas colunas ao GROUP BY
            ->orderBy('instituicao')
            ->get();

        return view('competicoes.relatorio', compact('inscricoes'));
    }
}
