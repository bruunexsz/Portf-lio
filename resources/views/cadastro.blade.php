@extends('layouts.app4')

@section('content')
<div class="col-10 d-flex justify-content-start align-items-center mb-5">
    <a class="btnVoltar" href="/filiados"><i class="fas fa-arrow-circle-left"></i> VOLTAR</a>
</div>
<div class="col-12 d-flex justify-content-center align-items-center">
    <h2>Cadastro de Filiados - Sistema</h2>
</div>
<div class="col-12 d-flex justify-content-center align-items-center">
    <div class="alert alert-info" role="alert">
        Preencha o formulário abaixo para <strong>Cadastrar</strong> novos <strong>Filiados</strong> no Sistema.
    </div>
</div>

<div class="col-11 mt-5 mb-5 p-5" style="background-color: white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
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

<form method="POST" action="{{ route('cadastra-filiado') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="LoginUsuario" class="form-label">Login do Usuário</label>
                <input placeholder="Login de acesso" type="text" class="form-control" id="LoginUsuario" name="LoginUsuario">
            </div>
            <div class="col-md-6">
    <label for="password" class="form-label">Senha</label>
    <div class="input-group">
        <input placeholder="Senha de acesso" type="password" class="form-control" id="password" name="password">
        <button class="btn btn-primary" type="button" id="showPasswordBtn">
        <i class="fas fa-eye"></i>
        </button>
    </div>
</div>

        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="NomeUsuario" class="form-label">Nome do Usuário</label>
                <input type="text" class="form-control" id="NomeUsuario" name="NomeUsuario">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                
                <input type="hidden" name="CadastradoPor" value="{{ Auth::user()->email }}">

            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary w-100">Enviar</button>
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