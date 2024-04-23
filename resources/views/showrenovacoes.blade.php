@extends('layouts.app4')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h2>Renovação de Atleta</h2>
                    @if($renovacoesAtletas->count() > 0)
                    <span>Você está na página {{ $renovacoesAtletas->currentPage() }} de {{ $renovacoesAtletas->lastPage() }}</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive d-flex justify-content-center align-items-center">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nome da Associação</th>
                                    <th>Professor</th>
                                    <th>Data de Preenchimento</th>
                                    <th>Visualizar</th> <!-- Colspan para ocupar duas colunas e centralizar -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($renovacoesAtletas as $renovacao)
                                <tr style="background-color: {{ $renovacao->FichaLida == 1 ? '#F1FFDC' : '#FFDCDC' }}">
                                    <td>{{ $renovacao->NomeDaAssociacao }}</td>
                                    <td>{{ $renovacao->Professor }}</td>
                                    <td>{{ \Carbon\Carbon::parse($renovacao->DataPreenchimento)->format('d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('visualizar-renovacao-atleta', ['id' => $renovacao->ID]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-info"> <i class="far fa-eye"></i></button>
                                        </form>
                                        <!-- Botão de visualizar -->
                                    
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    @if ($renovacoesAtletas->previousPageUrl())
                    <a href="{{ $renovacoesAtletas->previousPageUrl() }}" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Página Anterior</a>
                    @endif

                    @if ($renovacoesAtletas->nextPageUrl())
                    <a href="{{ $renovacoesAtletas->nextPageUrl() }}" class="btn btn-success">Próxima Página <i class="far fa-arrow-alt-circle-right"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection