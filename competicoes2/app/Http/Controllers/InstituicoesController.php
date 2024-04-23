<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Equipes;
use App\Models\Instituicoes;
use App\Models\Atletas;
use App\Models\Faixas;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class InstituicoesController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function showInstituicoes()
    {
        $instituicoes = Instituicoes::all();


        return view('instituicoes.show', [
            'instituicoes' => $instituicoes,

        ]);
    }
    public function showFormCreate()
    {
      
        $usuarios = User::all(); // Obtém todos os usuários do banco de dados
        
        return view('instituicoes.create_form', [
        
            'usuarios' => $usuarios, // Passa os usuários para a view
        ]);
    }
    public function store(Request $request)
    {
        // Validação dos dados recebidos do formulário
        $validatedData = $request->validate([
            'nome' => 'required|string',
            'responsavel' => 'nullable|string',
            'usuario' => 'required|exists:users,id', // Certifique-se de ajustar o modelo e a tabela de usuários conforme necessário
            'email' => 'nullable|email',
            'telefone' => 'nullable|string',
            'logradouro' => 'nullable|string',
            'numero' => 'nullable|string',
            'bairro' => 'nullable|string',
            'complemento' => 'nullable|string',
            'estado' => 'nullable|string',
            'cidade' => 'nullable|string',
            'status' => 'required|boolean',
            // Adicione outras regras de validação conforme necessário para os outros campos
        ]);

        // Criação da nova instituição
        $instituicao = Instituicoes::create($validatedData);

        // Redirecionamento após o cadastro da instituição
        return redirect()->route('instituicoes.create-form')->with('success', 'Instituição cadastrada com sucesso.');
    }

    public function showFormEdit($id)
    {
        $instituicoes = Instituicoes::findOrFail($id);
        $usuarioSelecionado = User::find($instituicoes->usuario); // Encontra o usuário com base no ID armazenado na instituição
        $usuarios = User::all(); // Obter todos os usuários
    
        return view('instituicoes.edit', compact('instituicoes', 'usuarioSelecionado', 'usuarios'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'nome' => 'required'
		]);
        $requestData = $request->all();
        
        $instituico = Instituicoes::findOrFail($id);
        $instituico->update($requestData);

        return redirect()->route('instituicoes.edit-form', ['id' => $id])->with('success', 'Instituição editada com sucesso.');
    }
    
    
}
