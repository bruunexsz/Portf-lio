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
use Illuminate\Support\Facades\DB;

use Illuminate\Routing\Controller as BaseController;

class AdminController extends BaseController
{
    public function showAdms()
    {
        // Verifique se o usuário está autenticado e se sua permissão é igual a "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            $usuarios = User::where('permissao', '=', 'admin')->get(); // Obtém todos os usuários com permissão 'admin'
            return view('show-administradores', ['usuarios' => $usuarios]); // Passa os usuários para a view
        } else {
            abort(403, 'Acesso negado.'); // Ou redirecione para uma página de acesso negado
        }
    }
    public function editAdm($id)
    {
        // Verifique se o usuário está autenticado e se tem permissão de "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            // Obtenha o ID do usuário autenticado
            $userId = Auth::id();

            // Verifique se o ID passado na URL é igual ao ID do usuário autenticado
            if ($id != $userId) {
                // Se os IDs não coincidirem, redirecione o usuário de volta com uma mensagem de erro
                return redirect()->route('edit-administrador', ['id' => $userId])->with('error', 'Você não tem permissão para acessar esses dados.');
            }

            // Prossiga com a edição dos dados do administrador
            $usuario = User::findOrFail($id);
            return view('editar-adm', ['usuario' => $usuario]);
        } else {
            // Se o usuário não estiver autenticado ou não tiver permissão adequada, redirecione-o para a página de login
            return redirect()->route('login')->with('error', 'Faça login como administrador para acessar essa página.');
        }
    }

    public function updateAdm(Request $request, $id)
    {
        // Validação dos dados do formulário
        $request->validate([
            'LoginUsuario' => 'required|string|max:255|unique:users,LoginUsuario,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
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
            return redirect()->route('mostraAdms')->with('success', 'Administrador atualizado com sucesso! Você acabou de atualizar os dados de uma conta.');
        } catch (\Exception $e) {
            // Em caso de falha, exibe uma mensagem de erro
            return back()->withErrors(['Erro ao atualizar usuário: ' . $e->getMessage()])->withInput();
        }
    }
    public function deleteAdm($id)
    {
        // Verifique se o usuário está autenticado e se sua permissão é igual a "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            try {
                // Encontre o administrador pelo ID e exclua-o
                $admin = User::findOrFail($id);
                $admin->delete();

                return redirect()->back()->with('success', 'Administrador excluído com sucesso!');
            } catch (\Exception $e) {
                // Em caso de falha, exiba uma mensagem de erro
                return redirect()->back()->withErrors(['Erro ao excluir administrador: ' . $e->getMessage()]);
            }
        } else {
            abort(403, 'Acesso negado.'); // Ou redirecione para uma página de acesso negado
        }
    }
    public function cadastroAdm()
    {
        // Verifique se o usuário está autenticado e se sua permissão é igual a "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            $user = Auth::user();
            return view('cadastra-adm', ['user' => $user]);
        } else {
            abort(403, 'Acesso negado.'); // Ou redirecione para uma página de acesso negado
        }
    }
    public function registerAdmAction(Request $request)
    {
        // Definindo mensagens de erro personalizadas
        $mensagensErro = [
            'LoginUsuario.required' => 'O campo login do administrador é obrigatório.',
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
            $user->permissao = 'admin'; // Definindo permissao como 'usuario' por padrão
            $user->created_at = Carbon::now(); // Definindo a data de criação
            $user->updated_at = Carbon::now(); // Definindo a data de atualização
            $user->save();

            // Redirecionamento para a página de criar conta com a mensagem de sucesso
            return redirect()->route('cadastra-adm')->with('success', 'Administrador Cadastrado com Sucesso!');
        } catch (\Exception $e) {
            // Em caso de falha, exibir mensagem de erro
            return back()->withErrors(['Erro ao salvar usuário: ' . $e->getMessage()])->withInput();
        }
    }


    public function adminDashboard()
    {
        if (Auth::check() && Auth::user()->permissao === 'admin') {

            // Conte todos os registros em que o campo FichaLida é diferente de 1 para o modelo RenovaAtleta
            $totalRegistrosRenovaAtleta = RenovaAtleta::where('FichaLida', '!=', 1)->count();

            // Conte todos os registros em que o campo FichaLida é diferente de 1 para o modelo FiliacaoAtletas
            $totalRegistrosFiliacaoAtletas = FiliacaoAtletas::where('FichaLida', '!=', 1)->count();

            // Conte todos os registros em que o campo FichaLida é diferente de 1 para o modelo Filiacao
            $totalRegistrosFiliacaoAssociacao = Filiacao::where('FichaLida', '!=', 1)->count();

            // Conte todos os registros em que o campo FichaLida é diferente de 1 para o modelo Kuy
            $totalRegistrosPromocaoKyu = Kuy::where('FichaLida', '!=', 1)->count();

            $totalAtivos = User::where('AtivacaoUsuario', 1)->where('permissao', '!=', 'admin')->count();

            // Conte a quantidade de usuários com AtivacaoUsuario diferente de 1 e permissao diferente de admin
            $totalInativos = User::where('AtivacaoUsuario', '!=', 1)->where('permissao', '!=', 'admin')->count();

            // Retorne os totais de registros para a view
            return view('admin-dashboard', [
                'totalRegistrosRenovaAtleta' => $totalRegistrosRenovaAtleta,
                'totalRegistrosFiliacaoAtletas' => $totalRegistrosFiliacaoAtletas,
                'totalRegistrosFiliacaoAssociacao' => $totalRegistrosFiliacaoAssociacao,
                'totalRegistrosPromocaoKyu' => $totalRegistrosPromocaoKyu,
                'totalAtivos' => $totalAtivos,
                'totalInativos' => $totalInativos
            ]);
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado. Está área é somente para Administradores e Moderadores do Sistema');
        }
    }

    // MOSTRA ASSOCIAÇÕES CADASTRADAS
    public function showAssociacoes()
    {
        if (Auth::check() && Auth::user()->permissao === 'admin') {


            // Obtenha os dados dos filiados de FiliacaoAtletas
            $associacoes = Filiacao::orderBy('DataPreenchimento', 'desc')->paginate(5);

            // Retorne a view 'showfiliados', passando as mensagens e os filiados para a view
            return view('showassociacoes', ['filiados' => $associacoes]);
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado.');
        }
    }
    // MOSTRA PROMOÇÕES DE KYU

    public function showPromocoesKyu()
    {
        if (Auth::check() && Auth::user()->permissao === 'admin') {


            // Obtenha os dados dos filiados de FiliacaoAtletas
            $promocoeskyu = Kuy::orderBy('DataPreenchimento', 'desc')->paginate(5);

            // Retorne a view 'showfiliados', passando as mensagens e os filiados para a view
            return view('showpromocoeskyu', ['promocoeskyu' => $promocoeskyu]);
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado.');
        }
    }

    // MOSTRA RENOVAÇÃO DE ATLETAS

    public function showRenovacoes()
    {
        if (Auth::check() && Auth::user()->permissao === 'admin') {


            // Obtenha os dados dos filiados de FiliacaoAtletas
            $renovacoesAtletas = RenovaAtleta::orderBy('DataPreenchimento', 'desc')->paginate(5);

            // Retorne a view 'showfiliados', passando as mensagens e os filiados para a view
            return view('showrenovacoes', ['renovacoesAtletas' => $renovacoesAtletas]);
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado.');
        }
    }

    //MOSTRA ATLETAS FILIADOS POR ASSOCIAÇÕES

    public function showAtletas()
    {
        if (Auth::check() && Auth::user()->permissao === 'admin') {


            // Obtenha os dados dos filiados de FiliacaoAtletas
            $filiados = FiliacaoAtletas::orderBy('DataPreenchimento', 'desc')->paginate(5);

            // Retorne a view 'showfiliados', passando as mensagens e os filiados para a view
            return view('showfiliados', ['filiados' => $filiados]);
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado.');
        }
    }
    // Método para mostrar o conteúdo da mensagem
    public function visualizarAtleta($id)
    {
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            try {
                // Verifique se o campo "FichaLida" é diferente de 1
                $atleta = FiliacaoAtletas::findOrFail($id);
                if ($atleta->FichaLida != 1) {
                    // Atualize apenas o campo "FichaLida" para 1
                    DB::table('cadastrofiliadosfiliacaodeatleta')
                        ->where('ID', $id)
                        ->update(['FichaLida' => 1]);
                }

                // Recarregue os dados do atleta para garantir que estamos usando os dados atualizados
                $atleta = FiliacaoAtletas::findOrFail($id);

                // Busque o nome do usuário associado ao IDUsuarioFiliado
                $usuario = User::find($atleta->IDUsuarioFiliado);

                // Se o usuário for encontrado, passe o LoginUsuario para a view
                $loginUsuario = $usuario ? $usuario->LoginUsuario : 'Usuário não encontrado';

                // Retorne a view de detalhes do atleta, passando o atleta encontrado e o LoginUsuario
                return view('visualizar-atleta', ['atleta' => $atleta, 'loginUsuario' => $loginUsuario,'usuario'=>$usuario]);
            } catch (\Exception $e) {
                // Em caso de falha, exiba uma mensagem de erro
                return back()->withErrors(['Erro ao visualizar atleta: ' . $e->getMessage()]);
            }
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado.');
        }
    }



    public function visualizarImagemAtleta($userId, $imageName)
    {
        // Construa o caminho do arquivo
        $path = 'arquivos_filiados/' . $userId . '/' . $imageName;

        // Verifique se o arquivo existe no armazenamento
        if (Storage::disk('local')->exists($path)) {
            // Retorna a imagem
            return response()->file(storage_path('app/' . $path));
        } else {
            // Se a imagem não existir, retorne um erro 404
            abort(404);
        }
    }
    public function visualizarAssociacao($id)
    {
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            try {
                // Encontre a associação pelo ID
                $associacao = Filiacao::findOrFail($id);

                // Verifique se o campo "FichaLida" é diferente de 1
                if ($associacao->FichaLida != 1) {
                    // Atualize apenas o campo "FichaLida" para 1
                    DB::table('cadastrofiliadosfiliacaodeassociacao')
                        ->where('ID', $id)
                        ->update(['FichaLida' => 1]);
                }

                // Busque o nome do usuário pelo IDUsuarioFiliado
                $usuario = User::findOrFail($associacao->IDUsuarioFiliado);

                // Retorne apenas o nome do usuário para a view
                $loginUsuario = $usuario->LoginUsuario;

                // Retorne a view de detalhes da associação, passando a associação encontrada
                return view('visualizar-associacao', ['associacao' => $associacao, 'loginUsuario' => $loginUsuario]);
            } catch (\Exception $e) {
                // Em caso de falha, exiba uma mensagem de erro
                return back()->withErrors(['Erro ao visualizar associação: ' . $e->getMessage()]);
            }
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado.');
        }
    }


    public function visualizarRenovacaoAtletas($id)
    {
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            try {
                // Encontre a renovação pelo ID
                $renovacao = RenovaAtleta::findOrFail($id);

                // Verifique se o campo "FichaLida" é diferente de 1
                if ($renovacao->FichaLida != 1) {
                    // Atualize apenas o campo "FichaLida" para 1
                    DB::table('cadastrofiliadosrenovacaodeatleta')
                        ->where('ID', $id)
                        ->update(['FichaLida' => 1]);
                }

                // Busque o nome do usuário pelo IDUsuarioFiliado
                $usuario = User::findOrFail($renovacao->IDUsuarioFiliado);

                // Retorne apenas o nome do usuário para a view
                $loginUsuario = $usuario->LoginUsuario;

                // Retorne a view de detalhes da renovação, passando a renovação encontrada e o nome do usuário
                return view('visualizar-renovacao', ['renovacao' => $renovacao, 'loginUsuario' => $loginUsuario]);
            } catch (\Exception $e) {
                // Em caso de falha, exiba uma mensagem de erro
                return back()->withErrors(['Erro ao visualizar renovação: ' . $e->getMessage()]);
            }
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado.');
        }
    }


    public function visualizarPromocaoKyu($id)
    {
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            try {
                // Encontre a promoção pelo ID
                $promocaoAtleta = Kuy::findOrFail($id);

                // Verifique se o campo "FichaLida" é diferente de 1
                if ($promocaoAtleta->FichaLida != 1) {
                    // Atualize apenas o campo "FichaLida" para 1
                    DB::table('cadastrofiliadospromocaodekyu')
                        ->where('ID', $id)
                        ->update(['FichaLida' => 1]);
                }


                // Busque o nome do usuário pelo IDUsuarioFiliado
                $usuario = User::findOrFail($promocaoAtleta->IDUsuarioFiliado);

                // Retorne apenas o nome do usuário para a view
                $loginUsuario = $usuario->LoginUsuario;

                // Retorne a view de detalhes da promoção, passando a promoção encontrada e o nome do usuário
                return view('visualizar-promocao-kyu', ['promocaoAtleta' => $promocaoAtleta, 'loginUsuario' => $loginUsuario]);
            } catch (\Exception $e) {
                // Em caso de falha, exiba uma mensagem de erro
                return back()->withErrors(['Erro ao visualizar promoção: ' . $e->getMessage()]);
            }
        } else {
            // Em caso de acesso negado, aborte a solicitação
            abort(403, 'Acesso negado.');
        }
    }


    //MOSTRA MENSAGENS CADASTRADAS
    public function showMensagem()
    {
        // Verifique se o usuário está autenticado e se sua permissão é igual a "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            $msg = MensagemFiliados::where('AtivacaoDaMensagem', '=', '1')
                ->orderBy('DataDeCadastroDaMensagem', 'desc')
                ->get(); // Obtém todos os usuários exceto os com permissão 'admin'
            return view('publicamsg', ['mensagem' => $msg]); // Passa os usuários para a view
        } else {
            abort(403, 'Acesso negado.'); // Ou redirecione para uma página de acesso negado
        }
    }

    //MOSTRA FORMULÁRIO DE MENSAGENS

    public function msgAction(Request $request)
    {

        // Verifique se o usuário está autenticado e se sua permissão é igual a "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            $user = Auth::user();
            return view('cadastramensagem', ['user' => $user]);
        } else {
            abort(403, 'Acesso negado.'); // Ou redirecione para uma página de acesso negado
        }
    }

    //AÇÃO PARA CADASTRO DE MENSAGENS

    public function registerMsgAction(Request $request)
    {
        // Definindo mensagens de erro personalizadas
        $mensagensErro = [
            'TituloDaMensagem.required' => 'O campo Título da Mensagem é obrigatório.',
            'TextoConteudoDaMensagem.required' => 'O campo Texto Conteúdo da Mensagem é obrigatório.',
        ];

        // Validação dos dados do formulário
        $request->validate([
            'TituloDaMensagem' => 'required|string|max:255',
            'TextoConteudoDaMensagem' => 'required|string',
        ], $mensagensErro);

        try {
            // Criação de uma nova mensagem
            $mensagem = new MensagemFiliados();
            $mensagem->TituloDaMensagem = $request->input('TituloDaMensagem');
            $mensagem->TextoConteudoDaMensagem = $request->input('TextoConteudoDaMensagem');
            $mensagem->DataDeCadastroDaMensagem = now(); // Define a data de cadastro como o momento atual
            $mensagem->AtivacaoDaMensagem = 1; // Definindo AtivacaoDaMensagem como 1 por padrão
            $mensagem->save();

            // Redirecionamento para a página de criação de mensagem com a mensagem de sucesso
            return redirect()->back()->with('success', 'Mensagem cadastrada com sucesso.');
        } catch (\Exception $e) {
            // Em caso de falha, exibir mensagem de erro
            return back()->withErrors(['Erro ao salvar mensagem: ' . $e->getMessage()])->withInput();
        }
    }





    public function cadastro()
    {
        // Verifique se o usuário está autenticado e se sua permissão é igual a "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            $user = Auth::user();
            return view('cadastro', ['user' => $user]);
        } else {
            abort(403, 'Acesso negado.'); // Ou redirecione para uma página de acesso negado
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



    public function editFiliadoAdm($id)
    {
        // Verifique se o usuário está autenticado e se sua permissão é igual a "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            $usuario = User::findOrFail($id);
            return view('edita-filiado-adm', ['usuario' => $usuario]);
        } else {
            abort(403, 'Acesso negado.'); // Ou redirecione para uma página de acesso negado
        }
    }


    public function updateFiliadoAdm(Request $request, $id)
    {
        $request->validate([
            'LoginUsuario' => 'required|string|max:255|unique:users,LoginUsuario,' . $id,
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:6',
        ], [
            'email.unique' => 'O endereço de e-mail já está em uso.',
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
            $user->AtivacaoUsuario = $request->input('AtivacaoUsuario'); // Novo campo para ativação do usuário
            // Não esqueça de atualizar a data de atualização
            $user->updated_at = now();
            $user->save();

            // Redireciona de volta com uma mensagem de sucesso
            return redirect()->route('edita-filiado-adm-controll', ['id' => $id])->with('success', '✔️ Os Dados do Filiado foram alterados com sucesso.');
        } catch (\Exception $e) {
            // Em caso de falha, exibe uma mensagem de erro
            return back()->withErrors(['Erro ao atualizar usuário: ' . $e->getMessage()])->withInput();
        }
    }



    public function deleteFiliadoAdm($id)
    {
        // Verifique se o usuário está autenticado e se sua permissão é igual a "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            try {
                // Encontre o administrador pelo ID e exclua-o
                $admin = User::findOrFail($id);
                $admin->delete();

                return redirect()->back()->with('success', 'Filiado excluído com sucesso! A partir de agora esse filiado não terá mais acesso ao sistema.');
            } catch (\Exception $e) {
                // Em caso de falha, exiba uma mensagem de erro
                return redirect()->back()->withErrors(['Erro ao excluir filiado: ' . $e->getMessage()]);
            }
        } else {
            abort(403, 'Acesso negado.'); // Ou redirecione para uma página de acesso negado
        }
    }
    // Função para exibir o formulário de edição de mensagem
    public function editMensagem($id)
    {
        // Verifique se o usuário está autenticado e se sua permissão é igual a "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            try {
                // Encontre a mensagem pelo ID
                $mensagem = MensagemFiliados::findOrFail($id);

                // Retorne a view de edição de mensagem com os detalhes da mensagem
                return view('edit-mensagem', compact('mensagem'));
            } catch (\Exception $e) {
                // Em caso de falha, exibe uma mensagem de erro
                return back()->withErrors(['Erro ao editar mensagem: ' . $e->getMessage()]);
            }
        } else {
            // Se o usuário não tiver permissão de "admin", retorne um erro de acesso negado
            abort(403, 'Acesso negado.');
        }
    }

    // Função para atualizar a mensagem no banco de dados
    public function updateMensagem(Request $request, $id)
    {
        // Validação dos dados do formulário
        $request->validate([
            'TituloDaMensagem' => 'required|string|max:255',
            'TextoConteudoDaMensagem' => 'required|string',
        ]);

        try {
            // Busca a mensagem pelo ID
            $mensagem = MensagemFiliados::findOrFail($id);

            // Atualiza os dados da mensagem
            $mensagem->TituloDaMensagem = $request->input('TituloDaMensagem');
            $mensagem->TextoConteudoDaMensagem = $request->input('TextoConteudoDaMensagem');
            $mensagem->DataDeCadastroDaMensagem = now(); // Atualiza a data de cadastro

            $mensagem->save();

            // Redireciona de volta com uma mensagem de sucesso
            return redirect()->route('edita-mensagem-controll', ['id' => $id])->with('success', 'Mensagem atualizada com sucesso.');
        } catch (\Exception $e) {
            // Em caso de falha, exibe uma mensagem de erro
            return back()->withErrors(['Erro ao atualizar mensagem: ' . $e->getMessage()])->withInput();
        }
    }

    // Função para excluir a mensagem
    public function deleteMensagem($id)
    {
        // Verifique se o usuário está autenticado e se sua permissão é igual a "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            try {
                // Busca a mensagem pelo ID e exclui
                MensagemFiliados::findOrFail($id)->delete();

                // Redireciona de volta com uma mensagem de sucesso
                return redirect()->back()->with('success', 'Mensagem excluida com sucesso.');
            } catch (\Exception $e) {
                // Em caso de falha, exibe uma mensagem de erro
                return back()->withErrors(['Erro ao excluir mensagem: ' . $e->getMessage()]);
            }
        } else {
            // Se o usuário não tiver permissão de "admin", retorne um erro de acesso negado
            abort(403, 'Acesso negado.');
        }
    }
}
