<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Log;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect; // Importação do facade Redirect

use App\Models\User;
use App\Models\Newsletter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use Illuminate\Routing\Controller as BaseController;

class NewsletterController extends BaseController
{
    public function show()
    {
        // Verifique se o usuário está autenticado e se sua permissão é igual a "admin"
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            $newsletter = Newsletter::where('AtivacaoDosDestinatarios', 1)
                ->orderBy('DataDeCadastroDosDestinatarios', 'desc') // Ordena por data de cadastro, da mais recente para a mais antiga
                ->get(); // Obtém todos os usuários com permissão 'admin'
            
            // Contar o número de registros
            $quantidade = $newsletter->count();
    
            return view('shownewsletter', ['newsletter' => $newsletter, 'quantidade' => $quantidade]); // Passa os usuários e a quantidade para a view
        } else {
            abort(403, 'Acesso negado.'); // Ou redirecione para uma página de acesso negado
        }
    }
    

    public function store(Request $request)
    {
        // Validação dos dados recebidos do formulário
        $request->validate([
            'NomesDosDestinatarios' => 'required',
            'EmailsDosDestinatarios' => 'required|email',
        ]);

        // Gerar um código único e curto
        $codigo = Str::random(6); // Gera uma string aleatória de 6 caracteres

        // Criar uma nova instância da Newsletter com os dados fornecidos
        $newsletter = new Newsletter([
            'NomesDosDestinatarios' => $request->input('NomesDosDestinatarios'),
            'EmailsDosDestinatarios' => $request->input('EmailsDosDestinatarios'),
            'AtivacaoDosDestinatarios' => 1, // Definir o valor fixo 1 para AtivacaoDosDestinatarios
            'CodigoDesativacaoDosDestinatarios' => $codigo,
            'DataDeCadastroDosDestinatarios' => now(), // Define a data atual como a data de cadastro
        ]);

        // Salvar a newsletter no banco de dados
        $newsletter->save();

        // Armazenar a mensagem de sucesso na sessão
        Session::flash('success', 'Você está cadastrado(a) em nossa lista de emails especial.');

        // Redirecionar de volta para a página de origem
        return redirect()->back();
    }
    public function desativar($id)
    {
        if (Auth::check() && Auth::user()->permissao === 'admin') {
            // Fazendo o update
            DB::table('usuarionewsletter')
                ->where('ID', $id)
                ->update(['AtivacaoDosDestinatarios' => 0]);

            // Definindo mensagem de sucesso na sessão
            Session::flash('success', 'Mensagem desativada com sucesso.');

            // Redirecionar de volta para a página anterior
            return redirect()->back();
        } else {
            abort(403, 'Acesso negado.'); // Ou redirecione para uma página de acesso negado
        }
    }
    public function exportarEmails()
    {
        // Recuperar os dados da tabela ordenados pela data em ordem decrescente
        $dados = Newsletter::where('AtivacaoDosDestinatarios', 1)
            ->orderBy('DataDeCadastroDosDestinatarios', 'desc')
            ->get();

        // Cabeçalhos do arquivo CSV
        $cabecalhos = [
            'Data de Cadastro',
            'Nome do Destinatário',
            'Email Cadastrado',
        ];

        // Abrir um stream de saída para o arquivo CSV
        $stream = fopen('php://temp', 'w+');

        // Escrever os cabeçalhos no arquivo CSV
        fputcsv($stream, $cabecalhos);

        // Escrever os dados da tabela no arquivo CSV
        foreach ($dados as $linha) {
            fputcsv($stream, [
                $linha->DataDeCadastroDosDestinatarios,
                $linha->NomesDosDestinatarios,
                $linha->EmailsDosDestinatarios,
            ]);
        }

        // Voltar para o início do stream
        rewind($stream);

        // Ler o conteúdo do stream
        $conteudo = stream_get_contents($stream);

        // Fechar o stream
        fclose($stream);

        // Retornar uma resposta HTTP com o arquivo CSV para download
        return response($conteudo)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', 'attachment; filename="emails.csv"');
    }
}
