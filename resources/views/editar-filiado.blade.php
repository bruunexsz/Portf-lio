@extends('layouts.app4')

@section('content')
<div class="col-10 d-flex justify-content-start align-items-center mb-5">
    <a class="btnVoltar" href="/dashboard"><i class="fas fa-arrow-circle-left"></i> VOLTAR</a>
</div>
<div class="col-12 d-flex justify-content-center align-items-center">
    <h2>{{ isset($usuario) ? 'Editar Cadastro' : 'Cadastro' }}</h2>
</div>
<div class="col-10 d-block justify-content-center align-items-center">
   
    <br>

    <div class="alert alert-primary" role="alert">
    💬 Você está editando seus dados de acesso na Área de Filiado.  
    <br>
    Caso queira permanecer com <strong>A MESMA SENHA DE ACESSO</strong> é só deixar o campo da senha em branco.
    </div>
    <br>


</div>

<div class="col-9 mt-5 mb-5 p-5" style="background-color: #FBFCFC;box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form style="" method="POST" action="{{ isset($usuario) ? route('update-filiado', $usuario->id) : route('cadastra-adm') }}">
        @csrf
        @if (isset($usuario))
        @method('PUT')
        @endif
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label for="LoginUsuario" class="form-label">Login de Acesso</label>
                <input placeholder="Login de acesso" type="text" class="form-control" id="LoginUsuario" name="LoginUsuario" value="{{ isset($usuario) ? $usuario->LoginUsuario : '' }}">
            </div>
            <div class="col-md-12">
                <label for="password" class="form-label">Insira uma nova Senha*</label>
                <div class="input-group">
                    <input placeholder="Senha de acesso" type="password" class="form-control" id="password" name="password">
                    <button class="btn btn-outline-secondary" type="button" id="showPasswordBtn">
                        MONSTRAR <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>

        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ isset($usuario) ? $usuario->email : '' }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="NomeUsuario" class="form-label">Nome de Usuário</label>
                <input type="text" class="form-control" id="NomeUsuario" name="NomeUsuario" value="{{ isset($usuario) ? $usuario->NomeUsuario : '' }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <input type="hidden" name="CadastradoPor" value="{{ Auth::user()->email }}">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary w-100">{{ isset($usuario) ? 'Atualizar Dados' : 'Efetuar Cadastro' }} <i class="far fa-paper-plane"></i></button>
            </div>
        </div>
    </form>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const passwordInput = document.getElementById('password');
        const showPasswordBtn = document.getElementById('showPasswordBtn');

        showPasswordBtn.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        });
    });
</script>

@endsection