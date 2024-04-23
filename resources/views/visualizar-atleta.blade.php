@extends('layouts.app4')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-10 d-flex justify-content-start align-items-center mb-5">
            <a class="btnVoltar" href="/filiacao-de-atletas"><i class="fas fa-arrow-circle-left"></i> VOLTAR</a>
        </div>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h2>Detalhes do Atleta</h2>
                </div>
                <div class="card-body" id="cardBody">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <p><strong>Cadastrado por:</strong> {{ $loginUsuario }}</p>

                    <div class="row">
                        <div class="col-md-4 text-center">
                            <div class="card">
                                <div class="card-header text-center">
                                    Foto do Atleta
                                </div>
                                <div class="card-body text-center">
                                    @if ($atleta->imagem_filiado)
                                    <img src="{{ asset('storage/' . $atleta->imagem_filiado) }}" class="" style="width:250px" height="200px" alt="Foto do Atleta">
                                    @else
                                    <div class="text-center">
                                        <i class="fas fa-image" style="font-size: 48px;"></i>
                                        <p class="mt-2">Nenhuma imagem disponível</p>
                                    </div>
                                    @endif

                                </div>
                            </div>
                            <hr>
                            <br>
                            @if ($atleta->pdf_arquivo)
    <a style="background-color: #AF1121; color: white; display: inline-block; padding: 10px 20px; text-decoration: none; border-radius: 5px;" href="{{ asset('storage/'. $atleta->pdf_arquivo) }}" download>
        <i class="fas fa-file-pdf" style="font-size: 5em;"></i> <!-- Ícone grande -->
        <br>
        Download PDF - CERTIFICADO E RG
    </a>
@else
    <div class="text-center">
        <i class="fas fa-file-pdf" style="font-size: 5em;"></i> <!-- Ícone grande -->
        <p class="mt-2">Nenhum PDF com documentos disponível</p>
    </div>
@endif



                            <br>
                            <hr>

                        </div>
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header bg-dark text-light text-center">
                                    Informações do Atleta
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Data de Preenchimento:</strong> {{ $atleta->DataPreenchimento }}</p>
                                            <p><strong>Número de Registro FKP:</strong> {{ $atleta->NRegistroFKP }}</p>
                                            <p><strong>Nome do Atleta:</strong> {{ $atleta->NomeDoAtleta }}</p>
                                            <p><strong>Endereço:</strong> {{ $atleta->Endereco }}</p>
                                            <p><strong>Número do Endereço:</strong> {{ $atleta->NEndereco }}</p>
                                            <p><strong>Bairro:</strong> {{ $atleta->Bairro }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Telefone:</strong> {{ $atleta->Telefone }}</p>
                                            <p><strong>Cidade:</strong> {{ $atleta->Cidade }}</p>
                                            <p><strong>Estado:</strong> {{ $atleta->Estado }}</p>
                                            <p><strong>CEP:</strong> {{ $atleta->CEP }}</p>
                                            <p><strong>Nome do Pai:</strong> {{ $atleta->NomeDoPai }}</p>
                                            <p><strong>Nome da Mãe:</strong> {{ $atleta->NomeDaMae }}</p>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Data de Nascimento:</strong> {{ $atleta->DtNascimento }}</p>
                                            <p><strong>RG:</strong> {{ $atleta->RG }}</p>
                                            <p><strong>Graduação Atual:</strong> {{ $atleta->GraduacaoAtual }}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Associação Filida:</strong> {{ $atleta->AssosiacaoFiliada }}</p>
                                            <p><strong>Professor Responsável:</strong> {{ $atleta->ProfessorResponsavel }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button onclick="printCardBody()" class="btn btn-primary w-100">Imprimir</button>
                        </div>
                    </div>
                    <script>
                        function printCardBody() {
                            var bodyContent = document.getElementById('cardBody').innerHTML;
                            var originalContent = document.body.innerHTML;
                            document.body.innerHTML = bodyContent;
                            window.print();
                            document.body.innerHTML = originalContent;
                        }
                    </script>
                </div>




            </div>
        </div>
    </div>
</div>

@endsection