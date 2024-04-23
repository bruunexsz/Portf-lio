<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class LoginController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function showLoginForm()
    {
        return view('login');
    }
    public function authenticate(Request $request)
    {
        $token = $request->input('g-recaptcha-response');

        if (empty($token)) {
            return redirect()->route('login')->withErrors(['g-recaptcha-response' => 'Por favor, complete o reCAPTCHA corretamente.'])->withInput();
        }
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida, redirecione para a página desejada
            return redirect()->route('home'); // Redireciona para a rota home
        }

        // Autenticação falhou, redirecione de volta para a página de login com uma mensagem de erro
        return redirect()->route('login')->with('error', 'Credenciais inválidas. Por favor, tente novamente.');
    }
    public function loginById(Request $request)
    {
        Auth::loginUsingId($request->id);
        return redirect()->route('home');
    }
}
