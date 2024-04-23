@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="">Cadastrar Usuário</div>

                <div class="card-body">
                @if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

                    <form method="POST" action="{{ route('usuarios.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input id="nome" type="text" class="form-control" name="nome" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Senha</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                        </div>

                        <div class="mb-3">
                            <label for="permissions" class="form-label">Permissões</label>
                            @foreach($roles as $role)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="{{$role->id}}" name="roles[]" id="{{$role->name}}">
                                <label class="form-check-label" for="{{$role->name}}">{{$role->name}}</label>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
