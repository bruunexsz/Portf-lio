@extends('layouts.app2')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 d-flex justify-content-center">
            <div class="card">
                <div class="card-header">
                    Lista de Competições
                    @if(auth()->user()->roles()->where('name', 'Admin')->exists())
                    <a href="/competicoes/criar" class="btn btn-primary float-end">CADASTRAR</a>
                    @endif

                </div>

                <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Local</th>
                                <th>Data</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($competicoes as $competicao)
                            <tr>
                                <td>{{ $competicao->id }}</td>
                                <td>{{ $competicao->nome }}</td>
                                <td>{{ $competicao->local }}</td>
                                <td>{{ $competicao->data }}</td>
                                <!-- Adicione aqui as colunas necessárias para as competições -->
                                <td>
                                    <!-- Botão de Editar -->
                                    <a href="/inscricoes/{{$competicao->id}}" class="btn btn-outline-info" style="">
                                        <i class="bi bi-people-fill" style=""></i>
                                    </a>
                                    @if(auth()->user()->roles()->where('name', 'Admin')->exists())


                                    <a href="/competicoes/{{$competicao->id}}/editar" class="btn btn-outline-secondary" style="">
                                        <i class="bi bi-pencil-square" style=""></i>
                                    </a>
                                    <!-- Botão de Editar -->
                                    <a href="/competicoes/relatorio/{{$competicao->id}}" class="btn btn-outline-warning" style="">
                                        <i class="bi bi-card-checklist" style=""></i>
                                    </a>

                                    
                                    <a style="" href="/confrontos/{{$competicao->id}}" class="btn btn-outline-success" style="">
                                        <i class="bi bi-card-checklist" style=""></i>
                                    </a>

                                    

                                    @endif

                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection