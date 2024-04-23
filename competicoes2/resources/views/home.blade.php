@extends('layouts.app2')

@section('content')


<!-- Exibindo o nome do usuário autenticado -->

@if(auth()->user()->roles()->where('name', 'Admin')->exists())

<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-start">
            <h5 class="text-muted">Dashboard - <p>Bem-vindo, {{ auth()->user()->name}}</p>
            </h5>
        </div>

        <div class="col-md-12 mb-5 d-flex justify-content-center">
          
                    <h1 class="card-title">{{ isset($nomeCompeticao) ? $nomeCompeticao : 'Nenhuma competição encontrada' }}</h1>
            
        </div>

        <div class="col-md-12 mb-5 d-flex justify-content-start">
            <a class="btn btn-outline-info" href="https://competicoes.fkp.com.br/inscricoes/relatorio/{{$ultimaCompeticaoId}}">VISUALIZAR RELATÓRIO</a>
        </div>
        <div class="col-md-12 mb-5 d-flex justify-content-start">
            <a class="btn btn-outline-primary" href="https://competicoes.fkp.com.br/inscricoes/{{$ultimaCompeticaoId}}">VISUALIZAR INSCRIÇÕES</a>
        </div>


        @if (isset($inicioCompeticao) && isset($fimCompeticao))

        <div class="col-md-12">
    <div class="card mb-3" style="background-color: #cfe2ff;">
        <div class="card-body">
            <h5 class="card-title">Datas da Competição</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <i class="bi bi-calendar-event"></i> Início: <strong>{{ $inicioCompeticao }}</strong>
                </li>
                <li class="list-group-item">
                    <i class="bi bi-calendar-x"></i> Término: <strong>{{ $fimCompeticao }}</strong>
                </li>
            </ul>
        </div>
    </div>

    <div class="card mb-3" style="background-color: #b3d9ff;">
        <div class="card-body">
            <h5 class="card-title">Quantidade Total de Inscrições</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <i class="bi bi-file-earmark-text"></i> Quantidade Total de Inscrições: <strong>{{ $quantidadeInscricoes }}</strong>
                </li>
            </ul>
        </div>
    </div>

    <div class="card mb-3" style="background-color: #99ccff;">
        <div class="card-body">
            <h5 class="card-title">Quantidade Total de Atletas Únicos</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <i class="bi bi-person"></i> Quantidade de Inscrições Únicas: <strong>{{ $quantidadeAtletasUnicos }}</strong>
                </li>
            </ul>
        </div>
    </div>
</div>

    </div>
    @endif


</div>
</div>
@endif

@endsection