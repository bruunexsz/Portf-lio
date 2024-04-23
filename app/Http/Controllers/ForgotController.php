<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Mail; // Importe a classe Mail
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ForgotController extends BaseController
{
    public function show()
    {
        return view('auth.forgot-password');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $token = $request->input('g-recaptcha-response');

        if (empty($token)) {
            return back()->withErrors(['g-recaptcha-response' => 'Por favor, complete o reCAPTCHA corretamente.'])->withInput();
        }
        $request->validate(['email' => 'required|email']);
    
        // Verificar se o usuário existe
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'O email fornecido não está cadastrado no sistema.'])->withInput();
        }
    
        // Gerar nova senha
        $newPassword = $this->generateRandomPassword();
    
        // Atualizar a senha do usuário no banco de dados
        $user->password = Hash::make($newPassword);
        $user->save();
    
        // Enviar e-mail com a nova senha
        $this->sendPasswordResetEmail($request->email, $newPassword);
    
        // Retornar uma resposta adequada ao usuário
        return back()->with('status', 'Nova senha enviada com sucesso. Verifique o seu Email e acesse sua Área do Filiado com a nova senha.');
    }
    
    private function generateRandomPassword()
    {
        // Lógica para gerar uma nova senha aleatória, por exemplo:
        return Str::random(10); // Gera uma senha com 10 caracteres aleatórios
    }
    
    private function sendPasswordResetEmail($email, $newPassword)
    {
        // Construa o conteúdo HTML do e-mail
        $htmlContent = "
        <!DOCTYPE html>
        <html>
        <head>
            <title>Nova Senha</title>
        </head>
        <body style='background-color: light; color: black; font-family: Arial, sans-serif; text-align:center;'>
            <img src='https://www.fkp.com.br/images/logofkp2.png' alt='Logo da FKP' width='80'>
            <h2>Você solicitou uma nova senha</h2>
            <p style='font-size:20px;'>🔒 Sua nova senha para a área de filiado da Federação de Karatê Paulista é:</p>
            <p style='font-size: 30px; font-weight: 900; border: 2px solid gray;'>$newPassword</p>
            <p>Por favor, faça login com essa senha e altere-a para uma senha mais segura assim que possível.</p>
           
       
            <p style='color: red;'><strong>⚠️ ATENÇÃO: </strong> Este é um email automático. Por favor, não responda a este email.</p>
            <p><a href='https://www.fkp.com.br/login' style='background-color: #B01126; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Clique aqui para fazer o login</a></p>
        </body>
        </html>
    ";
    
    
        // Envie o e-mail usando o serviço de e-mail do Laravel
        Mail::html($htmlContent, function ($message) use ($email) {
            $message->to($email)
                ->from('karate@fkp.com.br', 'Federação de Karatê Paulista')
                ->subject('Nova Senha - Federação de Karatê Paulista');
        });
    }
    
}
