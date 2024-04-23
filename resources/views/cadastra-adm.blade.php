@extends('layouts.app4')

@section('content')
<div class="col-10 d-flex justify-content-start align-items-center mb-5">
    <a class="btnVoltar" href="/administradores-e-moderadores"><i class="fas fa-arrow-circle-left"></i> VOLTAR</a>
</div>
<div class="col-12 d-flex justify-content-center align-items-center">
    <h2>Cadastro de Administradores</h2>
</div>
<div class="col-12 d-flex justify-content-center align-items-center">
    <div class="alert alert-primary" role="alert">
       O(s) <strong>Adminisradores</strong> Cadastrados abaixo vão ter acesso a todas as ferramentas de Administração de Sistema. </div>
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

    <form style="" method="POST" action="{{ route('cadastra-adm') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-12 mb-3">
                <label for="LoginUsuario" class="form-label">Login do Administrador</label>
                <input placeholder="Login de acesso" type="text" class="form-control" id="LoginUsuario" name="LoginUsuario">
            </div>
            <div class="col-md-12">
                <label for="password" class="form-label">Senha</label>
                <div class="input-group">
                    <input placeholder="Senha de acesso" type="password" class="form-control" id="password" name="password">
                    <button class="btn btn-danger" type="button" id="showPasswordBtn">
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
                <label for="NomeUsuario" class="form-label">Nome do Administrador</label>
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
                <button type="submit" class="btn btn-danger w-100">Efetuar Cadastro de Administrador <i class="far fa-paper-plane"></i></button>
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