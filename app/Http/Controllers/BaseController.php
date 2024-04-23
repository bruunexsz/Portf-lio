<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function __construct()
    {
        // Compartilhe os dados do usuário autenticado com todas as visualizações
        View::composer('*', function ($view) {
            $user = Auth::user();
            $view->with('user', $user);
        });
    }
}
