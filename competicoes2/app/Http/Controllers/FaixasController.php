<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Equipes;
use App\Models\Instituicoes;
use App\Models\Atletas;
use App\Models\Faixas;
use App\Models\User;
use App\Models\Categorias;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Routing\Controller as BaseController;

class FaixasController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function showFaixas()
    {
        $faixas = Faixas::all();


        return view('faixas.show', [
            'faixas' => $faixas,

        ]);
    }
    public function showFormCreate()
    {
     
        return view('faixas.create_form');
    }

    public function store(Request $request)
    {
        // Valide os dados do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
        ]);
    
        // Crie a faixa com os dados fornecidos
        Faixas::create([
            'nome' => $validatedData['nome'],
        ]);
    
        // Redirecione de volta com uma mensagem de sucesso
        return redirect()->route('faixas.create-form')->with('success', 'Faixa criada com sucesso!');
    }
    

    
}
