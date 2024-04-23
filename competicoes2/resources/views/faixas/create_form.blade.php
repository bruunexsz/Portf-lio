@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="">Criação de Faixa</div>

                <div class="card-body">
                    <!-- Verificar se existe uma mensagem de sucesso -->
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('faixas.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input id="nome" type="text" class="form-control" name="nome" required>
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
