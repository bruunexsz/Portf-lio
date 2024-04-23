@extends('layouts.app4')

@section('content')


<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <!-- Se houver uma mensagem de sucesso, exiba-a -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center bg-gradient-primary text-light">
                    <h2>Emails Cadastrados | Newsletter</h2>
                    <div class="btn-group" role="group">
                        <a href="{{ route('exportarEmails') }}" class="btn btn-md btn-success" style="font-weight: bold;">
                            <i class="fas fa-file-csv"></i> Baixar Planilha
                            <span class="badge badge-light">{{ $quantidade }}</span>
                        </a>
                        <!-- <a href="#" class="btn btn-sm btn-success" style="font-weight: bold;" data-toggle="modal" data-target="#enviarEmailModal"><i class="fas fa-paper-plane"></i> ENVIAR EMAIL</a>-->
                    </div>
                </div>

                <!-- Modal 
                <div class="modal fade" id="enviarEmailModal" tabindex="-1" aria-labelledby="enviarEmailModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            
                            <div class="modal-header">
                                <h5 class="modal-title" id="enviarEmailModalLabel">Enviar Email</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                             
                                <form action="/enviar-email" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="titulo">Título do Email:</label>
                                        <input type="text" class="form-control" id="titulo" name="titulo" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="assunto">Assunto do Email:</label>
                                        <input type="text" class="form-control" id="assunto" name="assunto" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="corpo">Conteúdo:</label>
                                        <textarea class="form-control" id="corpo" name="corpo" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">Enviar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
-->
                <div class="card-body">
                    <div class="table-responsive table-bordered table-striped d-flex justify-content-center align-items-center">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>

                                    <th>Data de Cadastro</th>
                                    <th>Nome do Destinatário</th>
                                    <th>Email Cadastrado</th>
                                    <th colspan="3" class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($newsletter as $news)
                                <tr>

                                    <td>{{ \Carbon\Carbon::parse($news->DataDeCadastroDosDestinatarios)->format('d/m/Y') }}</td>
                                    <td>{{ $news->NomesDosDestinatarios }}</td>
                                    <td>{{ $news->EmailsDosDestinatarios }}</td>
                                    <td>
                                        <form action="{{ route('deleteNewsletter', ['id' => $news->ID]) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-md" style="background-color: coral;color:white;font-weight:bold"><i class="far fa-bell-slash"></i> Desativar</button>
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