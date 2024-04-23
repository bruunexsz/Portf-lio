@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    Lista de Inscricoes

                    <a href="{{ route('inscricoes.show', ['competicao' => $competicao]) }}" class="btn btn-primary">Visualizar Relatório</a>
                    <a href="{{ url('/inscricoes/criar/' . $competicao) }}" class="btn btn-success">
                        Adicionar
                        <i class="fa fa-plus"></i>
                    </a>
                </div>


                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Competição</th>
                                <th>Categoria</th>
                                <th>Atleta/Equipe</th>
                                <th>Status</th>

                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{$compId}}
                            @foreach($inscricoes as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->competicao_inscrito ? $item->competicao_inscrito->nome : 'N/A' }}</td>
                                <td>{{ $item->categoria_inscrito ? $item->categoria_inscrito->nome : 'N/A' }}</td>
                                <td>{{ ($item->atleta_inscrito ? $item->atleta_inscrito->nome : 'N/A') }}</td>
                                <td>{{ $item->status_desc }}</td>
                                <td>
                                    <form action="{{ route('inscricoes.destroy', ['id' => $item->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir esta inscrição?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>

                                </td>

                                <!-- Adicione aqui as colunas necessárias para as competições -->
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