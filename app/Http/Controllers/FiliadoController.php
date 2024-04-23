<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect; // Importação do facade Redirect

use App\Models\MensagemFiliados;
use App\Models\Kuy;
use App\Models\RenovaAtleta;
use App\Models\Filiacao;
use App\Models\FiliacaoAtletas;
use App\Models\CampeonatoInscricao;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


use Illuminate\Routing\Controller as BaseController;

class FiliadoController extends BaseController
{
    public function showLogin()
    {
        if (Auth::check()) {
            if (Auth::user()->permissao == 'admin') {
                return redirect()->route('adminDashboard');
            } else {
                return redirect()->route('painel');
            }
        }

        return view('login');
    }
    public function visualizarMensagem($id)
    {
        // Verifique se o usuário está autenticado e se sua permissão é de administrador
        if (Auth::check() && Auth::user()->permissao === 'usuario') {
            try {
                // Encontre a mensagem pelo ID
                $mensagem = MensagemFiliados::findOrFail($id);

                // Retorne a view de detalhes da mensagem, passando a mensagem encontrada
                return view('visualizar-mensagem', ['mensagem' => $mensagem]);
            } catch (\Exception $e) {
                // Em caso de falha, exiba uma mensagem de erro
                return back()->withErrors(['Erro ao visualizar mensagem: ' . $e->getMessage()]);
            }
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado. Essa é uma área restrita para filiados cadastrados.');
        }
    }

    public function login(Request $request)
    {
        $token = $request->input('g-recaptcha-response');

        if (empty($token)) {
            return back()->withErrors(['g-recaptcha-response' => 'Por favor, complete o reCAPTCHA corretamente.'])->withInput();
        }
        // Verificar se o usuário está ativado
        $user = User::where('LoginUsuario', $request->input('LoginUsuario'))->first();

        if ($user && $user->AtivacaoUsuario == 0) {
            return back()->withErrors(['error' => 'Seu usuário está INATIVO no sistema. Entre em contato com o Administrador para reativar seu cadastro de filiado através do email: karate@fkp.com.br.'])->withInput()->with('alert', 'error');
        }

        // Tente autenticar o usuário
        if (Auth::attempt($request->only('LoginUsuario', 'password'))) {
            // Verificar se o usuário tem permissão de admin
            if (Auth::user()->permissao == 'admin') {
                return redirect()->route('adminDashboard');
            } else {
                return redirect()->route('painel');
            }
        } else {
            // As credenciais são inválidas, redirecione de volta com uma mensagem de erro
            return back()->withErrors([
                'login_usuario' => 'Nome de usuário ou senha incorretos. Caso tenha esquecido sua senha de login clique em recuperar senha'
            ])->withInput()->with('alert', 'error');
        }
    }





    public function logout()
    {
        Auth::logout();
        Session::flush(); // Limpa todos os dados da sessão
        return redirect()->route('login');
    }
    public function cadastro()
    {
        // Verifique se o usuário está autenticado e se sua permissão é igual a "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            $user = Auth::user();
            return view('cadastro', ['user' => $user]);
        } else {
            abort(403, 'Acesso negado. Essa é uma área restrita para filiados cadastrados.'); // Ou redirecione para uma página de acesso negado
        }
    }

    public function showUsers()
    {
        // Verifique se o usuário está autenticado e se sua permissão é igual a "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            $usuarios = User::where('permissao', '!=', 'admin')->get(); // Obtém todos os usuários exceto os com permissão 'admin'
            return view('users', ['usuarios' => $usuarios]); // Passa os usuários para a view
        } else {
            abort(403, 'Acesso negado.'); // Ou redirecione para uma página de acesso negado
        }
    }
    public function registerAction(Request $request)
    {
        // Definindo mensagens de erro personalizadas
        $mensagensErro = [
            'LoginUsuario.required' => 'O campo login do usuário é obrigatório.',
            'LoginUsuario.unique' => 'Este login já está em uso.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de email válido.',
            'email.unique' => 'Este email já está em uso.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
        ];

        // Validação dos dados do formulário
        $request->validate([
            'LoginUsuario' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ], $mensagensErro);
        try {
            // Criação de um novo usuário
            $user = new User();
            $user->LoginUsuario = $request->input('LoginUsuario');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->NomeUsuario = $request->input('NomeUsuario');
            $user->CadastradoPor = $request->input('CadastradoPor');
            $user->AtivacaoUsuario = 1; // Definindo AtivacaoUsuario como 1 por padrão
            $user->permissao = 'usuario'; // Definindo permissao como 'usuario' por padrão
            $user->created_at = Carbon::now(); // Definindo a data de criação
            $user->updated_at = Carbon::now(); // Definindo a data de atualização
            $user->save();

            // Redirecionamento para a página de criar conta com a mensagem de sucesso
            return redirect()->route('cadastra-filiado')->with('success', 'Filiado cadastrado com sucesso. A Partir de agora este Filiado pode acessar o sistema com o login e senha cadastrados.');
        } catch (\Exception $e) {
            // Em caso de falha, exibir mensagem de erro
            return back()->withErrors(['Erro ao salvar usuário: ' . $e->getMessage()])->withInput();
        }
    }



















    public function dashboard()
    {
        // Verifique se o usuário está autenticado e se sua permissão é de administrador
        if (Auth::check() && Auth::user()->permissao === 'usuario') {
            // Recupera os registros do modelo MensagemFiliados com paginação
            $mensagens = MensagemFiliados::where('AtivacaoDaMensagem', 1)
                ->orderBy('DataDeCadastroDaMensagem', 'desc')
                ->paginate(4);

            // Recupera o usuário autenticado
            $user = Auth::user();

            // Passa os registros e o usuário para a view do painel
            return view('dashboard', ['mensagens' => $mensagens, 'user' => $user]);
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado. Essa é uma área restrita para filiados cadastrados.');
        }
    }

    public function custos()
    {
        // Verifique se o usuário está autenticado e se sua permissão é de administrador
        if (Auth::check() && Auth::user()->permissao === 'usuario') {
            // Recupera o usuário autenticado
            $user = Auth::user();

            return view('custos');
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado.');
        }
    }

    public function kuy()
    {
        // Verifique se o usuário está autenticado e se sua permissão é de administrador
        if (Auth::check() && Auth::user()->permissao === 'usuario') {
            // Recupera o usuário autenticado
            $user = Auth::user();

            return view('kuy');
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado.');
        }
    }
    public function kuystore(Request $request)
    {
        // Validar os dados do formulário
        $request->validate(
            [
                'NomeDaAssociacao' => 'required',
                'Professor' => 'required',
                'DDDTelefone' => 'required',
                'DtDoExame' => 'required|date',
                'Examinador' => 'required',
                'NPromocoes' => 'required|integer',
                'Valor' => 'required|numeric',
                // Adicione outras regras de validação conforme necessário
            ],
            [
                // Mensagens de erro personalizadas
                'NomeDaAssociacao.required' => 'O campo Nome da Associação é obrigatório.',
                'Professor.required' => 'O campo Professor é obrigatório.',
                'DDDTelefone.required' => 'O campo DDD do Telefone é obrigatório.',
                'DtDoExame.required' => 'O campo Data do Exame é obrigatório.',
                'DtDoExame.date' => 'O campo Data do Exame deve ser uma data válida.',
                'Examinador.required' => 'O campo Examinador é obrigatório.',
                'NPromocoes.required' => 'O campo Número de Promoções é obrigatório.',
                'NPromocoes.integer' => 'O campo Número de Promoções deve ser um número inteiro.',
                'Valor.required' => 'O campo Valor é obrigatório.',
                'Valor.numeric' => 'O campo Valor deve ser um número válido.',
            ]
        );

        // Se a execução chegar aqui, significa que a validação passou

        // Adicionar o ID do usuário aos dados do formulário
        $requestData = $request->all();
        $requestData['IDUsuarioFiliado'] = Auth::id(); // Ajuste para o campo correto

        // Adicionar a data de preenchimento
        $requestData['DataPreenchimento'] = now();

        // Pegar os atletas do formulário e convertê-los em uma string JSON
        $atletas = [];
        for ($i = 0; $i < count($request->nomeAtleta); $i++) {
            $atletas[] = [
                'NomeAtleta' => $request->nomeAtleta[$i],
                'NFKP' => $request->nFkp[$i],
                'Kuy' => $request->kuy[$i],
                'DataNascimento' => $request->dataNascimento[$i],
                'RG' => $request->rg[$i]
            ];
        }
        $requestData['NomesAtletasInformacoes'] = json_encode($atletas);

        // Salvar os dados no banco de dados
        Kuy::create($requestData);

        // Redirecionar de volta com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Dados salvos com sucesso! Todas as Informações foram enviadas para a Administração da Federação de Karatê Paulista');
    }

    public function renovaFiliado()
    {
        // Verifique se o usuário está autenticado e se sua permissão é de administrador
        if (Auth::check() && Auth::user()->permissao === 'usuario') {
            // Recupera o usuário autenticado
            $user = Auth::user();

            return view('renovafiliado');
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado. Essa é uma área restrita para filiados cadastrados.');
        }
    }
    public function renovaFiliadoStore(Request $request)
    {
        // Validar os dados do formulário
        $request->validate(
            [
                'NomeDaAssociacao' => 'required',
                'Professor' => 'required',
                'DDDTelefone' => 'required',
                'NRenovacoes' => 'required|integer',
                'Valor' => 'required|numeric',
                // Adicione outras regras de validação conforme necessário
            ],
            [
                // Mensagens de erro personalizadas
                'NomeDaAssociacao.required' => 'O campo Nome da Associação é obrigatório.',
                'Professor.required' => 'O campo Professor é obrigatório.',
                'DDDTelefone.required' => 'O campo DDD do Telefone é obrigatório.',
                'NRenovacoes.required' => 'O campo Número de Renovações é obrigatório.',
                'NRenovacoes.integer' => 'O campo Número de Renovações deve ser um número inteiro.',
                'Valor.required' => 'O campo Valor é obrigatório.',
                'Valor.numeric' => 'O campo Valor deve ser um número válido.',
            ]
        );

        // Se a execução chegar aqui, significa que a validação passou

        // Adicionar o ID do usuário aos dados do formulário
        $requestData = $request->all();
        $requestData['IDUsuarioFiliado'] = Auth::id();

        // Adicionar a data de preenchimento
        $requestData['DataPreenchimento'] = now();

        // Pegar os atletas do formulário e convertê-los em uma string JSON
        $atletas = [];
        for ($i = 0; $i < count($request->nomeAtleta); $i++) {
            $atletas[] = [
                'NomeAtleta' => $request->nomeAtleta[$i],
                'NFKP' => $request->nFkp[$i],
                'Kuy' => $request->kuy[$i],
                'DataNascimento' => $request->dataNascimento[$i],
                'RG' => $request->rg[$i]
            ];
        }
        $requestData['NomesAtletasInformacoes'] = json_encode($atletas);

        // Salvar os dados no banco de dados
        RenovaAtleta::create($requestData);

        // Redirecionar de volta com uma mensagem de sucesso
        return redirect()->back()->with('success', 'A Renovação do(s) Atletas foram enviadas com sucesso!');
    }
    public function filiacaoStore(Request $request)
    {
        // Validar os dados do formulário
        $validatedData = $request->validate(
            [
                'NomeDoRepresentante' => 'required|string|max:255',
                'RG' => 'required|string|max:20',
                'CPF' => 'required|string|max:14',
                'DtNascimento' => 'required|date',
                'CidadeDeNascimento' => 'required|string|max:255',
                'EstadoDeNascimento' => 'required|string|max:2',
                'NomeDaAssociacao' => 'required|string|max:255',
                'TelefoneDaAssociacao' => 'required|string|max:20',
                'EnderecoDaAssociacao' => 'string',
                'NumeroDaAssociacao' => 'string',
                'BairroDaAssociacao' => 'required|string|max:255',
                'CidadeDaAssociacao' => 'required|string|max:255',
                'EstadoDaAssociacao' => 'required|string|max:2',
                'CepDaAssociacao' => 'required|string|max:10',
                'CnpjDaAssociacao' => 'required|string|max:20',
                'ProfessorInstrutor' => 'required|string|max:255',
                'GraduacaoProfessorInstrutor' => 'required|string|max:255',
                'ProfessorDirecaoTecnica' => 'required|string|max:255',
                'GraduacaoProfessorDirecaoTecnica' => 'required|string|max:255',
                'NomeDaAssociacaoPlaca' => 'required|string|max:255',
            ],
            [
                // Mensagens de erro personalizadas em português
                'NomeDoRepresentante.required' => 'O campo Nome do Representante é obrigatório.',
                'RG.required' => 'O campo RG é obrigatório.',
                'CPF.required' => 'O campo CPF é obrigatório.',
                'DtNascimento.required' => 'O campo Data de Nascimento é obrigatório.',
                'CidadeDeNascimento.required' => 'O campo Cidade de Nascimento é obrigatório.',
                'EstadoDeNascimento.required' => 'O campo Estado de Nascimento é obrigatório.',
                'NomeDaAssociacao.required' => 'O campo Nome da Associação é obrigatório.',
                'TelefoneDaAssociacao.required' => 'O campo Telefone da Associação é obrigatório.',
                'BairroDaAssociacao.required' => 'O campo Bairro da Associação é obrigatório.',
                'CidadeDaAssociacao.required' => 'O campo Cidade da Associação é obrigatório.',
                'EstadoDaAssociacao.required' => 'O campo Estado da Associação é obrigatório.',
                'CepDaAssociacao.required' => 'O campo CEP da Associação é obrigatório.',
                'CnpjDaAssociacao.required' => 'O campo CNPJ da Associação é obrigatório.',
                'ProfessorInstrutor.required' => 'O campo Professor/Instrutor é obrigatório.',
                'GraduacaoProfessorInstrutor.required' => 'O campo Graduação do Professor/Instrutor é obrigatório.',
                'ProfessorDirecaoTecnica.required' => 'O campo Professor Direção Técnica é obrigatório.',
                'GraduacaoProfessorDirecaoTecnica.required' => 'O campo Graduação do Professor Direção Técnica é obrigatório.',
                'NomeDaAssociacaoPlaca.required' => 'O campo Nome da Associação na Placa é obrigatório.',
            ]
        );

        // Se a execução chegar aqui, significa que a validação passou

        // Adicionar o ID do usuário aos dados do formulário
        $validatedData['IDUsuarioFiliado'] = Auth::id();

        // Adicionar a data atual ao campo DataPreenchimento
        $validatedData['DataPreenchimento'] = now();

        // Concatenar o endereço e o número
        $enderecoCompleto = $validatedData['EnderecoDaAssociacao'] . ' - ' . $validatedData['NumeroDaAssociacao'];

        // Atribuir o endereço completo ao campo EnderecoDaAssociacao
        $validatedData['EnderecoDaAssociacao'] = $enderecoCompleto;

        try {
            // Cria um novo objeto de filiação com os dados validados
            $filiacao = new Filiacao();
            $filiacao->fill($validatedData);
            $filiacao->save();

            // Redirecionar de volta com uma mensagem de sucesso
            return redirect()->back()->with('success', 'Cadastro efetuado com sucesso!');
        } catch (QueryException $e) {
            // Se houver um erro durante a inserção, exiba a mensagem de erro
            return redirect()->back()->withErrors(['error' => 'Erro ao inserir o registro: ' . $e->getMessage()]);
        }
    }

    public function filiacao()
    {
        // Verifique se o usuário está autenticado e se sua permissão é de administrador
        if (Auth::check() && Auth::user()->permissao === 'usuario') {
            // Recupera o usuário autenticado
            $user = Auth::user();

            return view('filiacao');
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado. Essa é uma área restrita para filiados cadastrados.');
        }
    }

    public function filiacaoFiliado()
    {
        // Verifique se o usuário está autenticado e se sua permissão é de administrador
        if (Auth::check() && Auth::user()->permissao === 'usuario') {
            // Recupera o usuário autenticado
            $user = Auth::user();

            return view('filiacaofiliado');
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado. Essa é uma área restrita para filiados cadastrados.');
        }
    }
    public function filiacaoFiliadoStore(Request $request)
    {
        // Validar os dados do formulário
        $validatedData = $request->validate([
            'NRegistroFKP' => 'required|string|max:255',
            'NomeDoAtleta' => 'required|string|max:255',
            'DtNascimento' => 'required|date',
            'RG' => 'required|string|max:20',
            'Endereco' => 'required|string|max:255',
            'NEndereco' => 'required|string|max:10',
            'Bairro' => 'required|string|max:255',
            'Telefone' => 'required|string|max:20',
            'Cidade' => 'required|string|max:255',
            'Estado' => 'required|string|max:2',
            'CEP' => 'required|string|max:10',
            'NomeDoPai' => 'required|string|max:255',
            'NomeDaMae' => 'required|string|max:255',
            'GraduacaoAtual' => 'required|string|max:255',
            'DtGraduacaoAtual' => 'required|date',
            'AssosiacaoFiliada' => 'required|string|max:255',
            'ProfessorResponsavel' => 'required|string|max:255',
            'imagem_filiado' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:3072', // Máximo de 3 MB (3072 KB) e tipos de imagem permitidos
            'pdf_arquivo' => 'required|file|mimes:pdf|max:10240', // Máximo de 10 MB (10240 KB) e tipos de arquivo PDF permitidos
        ], [
            // Mensagens de erro personalizadas em português
            'NRegistroFKP.required' => 'O campo Número de Registro FKP é obrigatório.',
            'NomeDoAtleta.required' => 'O campo Nome do Atleta é obrigatório.',
            'DtNascimento.required' => 'O campo Data de Nascimento é obrigatório.',
            'RG.required' => 'O campo RG é obrigatório.',
            'Endereco.required' => 'O campo Endereço é obrigatório.',
            'NEndereco.required' => 'O campo Número do Endereço é obrigatório.',
            'Bairro.required' => 'O campo Bairro é obrigatório.',
            'Telefone.required' => 'O campo Telefone é obrigatório.',
            'Cidade.required' => 'O campo Cidade é obrigatório.',
            'Estado.required' => 'O campo Estado é obrigatório.',
            'CEP.required' => 'O campo CEP é obrigatório.',
            'NomeDoPai.required' => 'O campo Nome do Pai é obrigatório.',
            'NomeDaMae.required' => 'O campo Nome da Mãe é obrigatório.',
            'GraduacaoAtual.required' => 'O campo Graduação Atual é obrigatório.',
            'DtGraduacaoAtual.required' => 'O campo Data da Graduação Atual é obrigatório.',
            'AssosiacaoFiliada.required' => 'O campo Associação Filida é obrigatório.',
            'ProfessorResponsavel.required' => 'O campo Professor Responsável é obrigatório.',
            'imagem_filiado.required' => 'Foto do Atleta Obrigatória',
            'pdf_arquivo.required' => 'Arquivo PDF Obrigatório',
        ]);
        

        if ($request->hasFile('imagem_filiado')) {
            $imagem = $request->file('imagem_filiado');
            $userId = Auth::id();
        
            // Diretório de armazenamento dentro de storage/app/public
            $userFolderPath = storage_path('app/public/arquivos_filiados/' . $userId);
        
            // Verifique se o diretório do usuário existe, senão crie
            if (!Storage::disk('public')->exists('arquivos_filiados/' . $userId)) {
                Storage::disk('public')->makeDirectory('arquivos_filiados/' . $userId, 0777, true);
            }
        
            // Nome do arquivo
            $imageName = $imagem->getClientOriginalName();
        
            // Move o arquivo para o diretório de armazenamento usando o disco público
            $imagem->storeAs('arquivos_filiados/' . $userId, $imageName, 'public');
        
            // Salva o caminho da imagem no banco de dados
            $validatedData['imagem_filiado'] = 'arquivos_filiados/' . $userId . '/' . $imageName;
        }
        
        if ($request->hasFile('pdf_arquivo')) {
            $pdf = $request->file('pdf_arquivo');
            $userId = Auth::id();
            
            // Diretório de armazenamento dentro de storage/app/public
            $userFolderPath = storage_path('app/public/arquivos_filiados/' . $userId);
            
            // Verifica se o diretório do usuário existe, senão cria
            if (!Storage::disk('public')->exists('arquivos_filiados/' . $userId)) {
                Storage::disk('public')->makeDirectory('arquivos_filiados/' . $userId, 0777, true);
            }
        
            // Verifica se o diretório "documentos" existe dentro do diretório do usuário, senão cria
            if (!Storage::disk('public')->exists('arquivos_filiados/' . $userId . '/documentos')) {
                Storage::disk('public')->makeDirectory('arquivos_filiados/' . $userId . '/documentos', 0777, true);
            }
            
            // Nome do arquivo
            $pdfName = $pdf->getClientOriginalName();
            
            // Move o arquivo para o diretório de armazenamento usando o disco público
            $pdf->storeAs('arquivos_filiados/' . $userId . '/documentos', $pdfName, 'public');
            
            // Salva o caminho do arquivo PDF no banco de dados
            $validatedData['pdf_arquivo'] = 'arquivos_filiados/' . $userId . '/documentos/' . $pdfName;
        }
        
        
        // Adicionar o ID do usuário aos dados do formulário
        $validatedData['IDUsuarioFiliado'] = Auth::id();

        // Adicionar a data atual ao campo DataPreenchimento
        $validatedData['DataPreenchimento'] = now();

        try {
            // Cria um novo objeto de filiação com os dados validados
            $filiacao = new FiliacaoAtletas();
            $filiacao->fill($validatedData);
            $filiacao->save();

            // Redirecionar de volta com uma mensagem de sucesso
            return redirect()->back()->with('success', 'Cadastro efetuado com sucesso!');
        } catch (QueryException $e) {
            // Se houver um erro durante a inserção, exiba a mensagem de erro
            return redirect()->back()->withErrors(['error' => 'Erro ao inserir o registro: ' . $e->getMessage()]);
        }
    }


    public function editFiliado($id)
    {
        // Verifique se o usuário está autenticado e se tem permissão de "usuario"
        if (Auth::check() && Auth::user()->permissao === 'usuario') {
            // Obtenha o ID do usuário autenticado
            $userId = Auth::id();

            // Verifique se o ID passado na URL é igual ao ID do usuário autenticado
            if ($id != $userId) {
                // Se os IDs não coincidirem, redirecione o usuário de volta com uma mensagem de erro
                return redirect()->route('edit-filiado', ['id' => $userId])->with('error', 'Você não tem permissão para acessar esses dados.');
            }

            // Prossiga com a edição dos dados do filiado
            $usuario = User::findOrFail($id);
            return view('editar-filiado', ['usuario' => $usuario]);
        } else {
            // Se o usuário não estiver autenticado ou não tiver permissão adequada, redirecione-o para a página de login
            return redirect()->route('login')->with('error', 'Faça login como usuário para acessar essa página.');
        }
    }


    public function updateFiliado(Request $request, $id)
    {
        // Validação dos dados do formulário
        $request->validate([
            'LoginUsuario' => 'required|string|max:255|unique:users,LoginUsuario,' . $id,
            'email' => 'required|string|email|max:255' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        try {
            // Busca o usuário pelo ID
            $user = User::findOrFail($id);

            // Atualiza os dados do usuário
            $user->LoginUsuario = $request->input('LoginUsuario');
            $user->email = $request->input('email');
            // Verifica se a senha foi fornecida e a atualiza
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }
            $user->NomeUsuario = $request->input('NomeUsuario');
            $user->CadastradoPor = $request->input('CadastradoPor');
            // Não esqueça de atualizar a data de atualização
            $user->updated_at = now();
            $user->save();

            // Redireciona de volta com uma mensagem de sucesso
            return redirect()->route('edit-filiado', ['id' => $id])->with('success', '✔️ Seus dados no Sistema da Federação de Karatê Paulista foram atualizados com sucesso.');
        } catch (\Exception $e) {
            // Em caso de falha, exibe uma mensagem de erro
            return back()->withErrors(['Erro ao atualizar usuário: ' . $e->getMessage()])->withInput();
        }
    }
}
