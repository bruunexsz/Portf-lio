@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Lista de Instituições
                    <a href="/instituicoes/criar" class="btn btn-primary float-end">CADASTRAR</a>
                </div>

                <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($instituicoes as $instituicao)
                            <tr>
                                <td>{{ $instituicao->id }}</td>
                                <td>{{ $instituicao->nome }}</td>
                                <td>{{ $instituicao->email }}</td>
                                <td>
                                <a href="{{ route('instituicoes.edit-form', ['id' => $instituicao->id]) }}" class="btn btn-primary">
    <i class="bi bi-pencil-fill" style="color: white;"></i>
</a>

                                    <!-- Botão de Excluir -->
                                    <a href="#" class="btn btn-danger">
                                        <i class="bi bi-trash-fill" style="color: white;"></i>
                                    </a>
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
