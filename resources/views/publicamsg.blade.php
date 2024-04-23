@extends('layouts.app4')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
               <!-- Se houver uma mensagem de sucesso, exiba-a -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h2>Mensagens aos Filiados</h2>
                    <a href="/cadastrar-mensagem" class="btn btn-md btn-success" style="font-weight: bold;"><i class="fas fa-paper-plane"></i> CADASTRAR MENSAGEM</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive d-flex justify-content-center align-items-center">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Data de Cadastro</th>
                                    <th>Título</th>
                                    <th colspan="3" class="text-center">Ações</th> <!-- Colspan para ocupar três colunas e centralizar -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mensagem as $msg)
                                <tr>
                                    <td>{{ $msg->DataDeCadastroDaMensagem }}</td>
                                    <td>{{ $msg->TituloDaMensagem }}</td>

                                    <td>
                                        <!-- Botão de editar -->
                                        <a href="{{ route('edita-mensagem-controll', ['id' => $msg->ID]) }}" class="btn btn-primary"> <i class="fas fa-edit"></i> Editar</a>
                                    </td>
                                    <td>
                                        <!-- Formulário para excluir -->
                                        <form action="{{ route('delete-mensagem-controll', ['id' => $msg->ID]) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"> <i class="fas fa-trash"></i> Excluir</button>
                                        </form>
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
</div>
@endsection