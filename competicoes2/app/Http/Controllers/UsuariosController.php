<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Categorias;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class UsuariosController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function showUsuarios()
    {
        $usuarios = User::all();


        return view('usuarios.show', [
            'usuarios' => $usuarios,

        ]);
    }
    public function showFormCreate()
    {
        $roles = Role::all();


        return view('usuarios.create_form', [
            'roles' => $roles,

        ]);
    }

    public function store(Request $request)
    {
        // Valide os dados do formulário
        $validatedData = $request->validate([
            'nome' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'roles' => 'required',
        ]);
    
        try {
            // Crie o usuário
            $user = User::create([
                'name' => $validatedData['nome'],
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);
    
            // Associe as permissões ao usuário
            $user->roles()->sync($request->input('roles'));
    
            // Redirecione de volta com uma mensagem de sucesso
            return redirect()->route('usuarios.create-form')->with('success', 'Usuário criado com sucesso!');
        } catch (\Exception $e) {
            // Em caso de erro, redirecione de volta com uma mensagem de erro
            return redirect()->back()->withErrors(['error' => 'Ocorreu um erro ao criar o usuário. Por favor, tente novamente.']);
        }
    }
    
}
