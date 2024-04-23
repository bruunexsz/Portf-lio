@extends('layouts.app4')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h2>Atletas Filiados nas Associações</h2>
                    @if($filiados->count() > 0)
                    <span>Você está na página {{ $filiados->currentPage() }} de {{ $filiados->lastPage() }}</span>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive d-flex justify-content-center align-items-center">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Nome do Atleta</th>
                                    <th>Data de Preenchimento</th>
                                    <th>Associação Filida</th>
                                    <th>Visualizar</th> <!-- Colspan para ocupar duas colunas e centralizar -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($filiados as $filiado)
                                <tr @if($filiado->FichaLida == 1) style="background-color: #F1FFDC;" @else style="background-color: #FFDCDC;" @endif>
                                    <td>{{ $filiado->NomeDoAtleta }}</td>
                                    <td>{{ \Carbon\Carbon::parse($filiado->DataPreenchimento)->format('d/m/Y') }}</td>
                                    <td>{{ $filiado->AssosiacaoFiliada }}</td>
                                    <td>
                                        <form action="{{ route('visualizar-atleta', ['id' => $filiado->ID]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-info"> <i class="far fa-eye"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    @if ($filiados->previousPageUrl())
                    <a href="{{ $filiados->previousPageUrl() }}" class="btn btn-secondary"><i class="far fa-arrow-alt-circle-left"></i> Página Anterior</a>
                    @endif

                    @if ($filiados->nextPageUrl())
                    <a href="{{ $filiados->nextPageUrl() }}" class="btn btn-success">Próxima Página <i class="far fa-arrow-alt-circle-right"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection