@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="">Criação de Equipe</div>

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
                    <form method="POST" action="{{route('equipes.store')}}">
                        @csrf

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input id="nome" type="text" class="form-control" name="nome" required>
                        </div>

                        <div class="mb-3">
                            <label for="instituicao" class="form-label">Instituição</label>
                            <br>
                            <select name="instituicao" class="form-control form-select">
                                @foreach($instituicoes as $instituicao)
                                <option value="{{ $instituicao->id }}">{{ $instituicao->nome }}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Criar Equipe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection