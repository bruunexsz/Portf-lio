<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoriasFaixas;
use App\Models\Equipes;
use App\Models\Instituicoes;
use App\Models\Atletas;
use App\Models\Faixas;
use App\Models\User;
use App\Models\Categorias;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class CategoriasController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function showCategorias()
    {
        $categorias = Categorias::all();


        return view('categorias.show', [
            'categorias' => $categorias,

        ]);
    }
    public function showFormCreate()
    {

        $faixas = Faixas::all();


        return view('categorias.create_form', [

            'faixas' => $faixas,

        ]);
    }

    public function store(Request $request)
    {
        // Validação dos dados recebidos do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string',
            'idade_minima' => 'required|integer',
            'idade_maxima' => 'required|integer',
            'sexo' => 'required|string',
            'tipo' => 'required|string',
            'sistema' => 'required|string',
            'altura_minima' => 'required|numeric',
            'altura_maxima' => 'required|numeric',
            'peso_minimo' => 'required|numeric',
            'peso_maximo' => 'required|numeric',
            'equipe' => 'required|string',
            // Adicione outras regras de validação conforme necessário para os outros campos
        ]);

        // Criação da nova categoria
        $categoria = Categorias::create($validatedData);

        // Verifica se foram selecionadas faixas no formulário
        if ($request->has('faixas')) {
            // Itera sobre as faixas selecionadas
            foreach ($request->input('faixas') as $faixaId) {
                // Criação da entrada na tabela pivot categorias_faixas
                CategoriasFaixas::create([
                    'categoria' => $categoria->id,
                    'faixa' => $faixaId,
                ]);
            }
        }

        // Redirecionamento após a criação da categoria
        return redirect()->route('categorias.create-form')->with('success', 'Categoria criada com sucesso.');
    }

    public function showFormEdit($id)
    {
        $categoria = Categorias::findOrFail($id);


        $faixas = Faixas::select('id', 'nome')->get();

        $faixas_categorias = CategoriasFaixas::where('categoria', $categoria->id)->get()->pluck('faixa')->toArray();

        return view('categorias.edit', compact('categoria', 'faixas', 'faixas_categorias'));
    }

    public function update(Request $request, $id)
{
    // Validação dos dados recebidos do formulário
    $validatedData = $request->validate([
        'nome' => 'required|string',
        'idade_minima' => 'required|integer',
        'idade_maxima' => 'required|integer',
        'sexo' => 'required|in:1,2', // Assuming 1 is for Masculino and 2 for Feminino
        'tipo' => 'required|in:1,2,3',
        'sistema' => 'required|in:1,2,3',
        'altura_minima' => 'required|numeric',
        'altura_maxima' => 'required|numeric',
        'peso_minimo' => 'required|numeric',
        'peso_maximo' => 'required|numeric',
        'equipe' => 'required|boolean',
        'faixas' => 'array', // Verifica se o campo faixas é um array
    ]);

    // Encontra a categoria pelo ID
    $categoria = Categorias::findOrFail($id);

    // Atualiza os campos da categoria
    $categoria->update($validatedData);

    // Verifica se foram selecionadas faixas no formulário
    if ($request->has('faixas')) {
        // Remove as faixas existentes associadas a esta categoria
        CategoriasFaixas::where('categoria', $categoria->id)->delete();

        // Adiciona as novas faixas selecionadas
        foreach ($request->input('faixas') as $faixaId) {
            CategoriasFaixas::create([
                'categoria' => $categoria->id,
                'faixa' => $faixaId,
            ]);
        }
    }

    // Redirecionamento após a atualização da categoria
    return redirect()->route('categorias.edit-form', ['id' => $categoria->id])->with('success', 'Categoria atualizada com sucesso.');
}

}
