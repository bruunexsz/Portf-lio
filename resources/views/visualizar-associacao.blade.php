@extends('layouts.app4')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-10 d-flex justify-content-start align-items-center mb-5">
            <a class="btnVoltar" href="/filiacao-de-associacao"><i class="fas fa-arrow-circle-left"></i> VOLTAR</a>
        </div>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h2>Declaração</h2>
                </div>
                <div class="card-body" id="cardBody">
                <p><strong>Segue abaixo a ficha preenchida pelo usuário:</strong> {{ $loginUsuario }}</p>

                    <p><strong>Excelentíssimo Sr. Presidente da FKP</strong></p>

                    <p>Eu <strong>{{ $associacao->NomeDoRepresentante }}</strong>, portador da cédula de identidade RG <strong>{{ $associacao->RG }}</strong>, inscrito no CPF <strong>{{ $associacao->CPF }}</strong>, nascido em <strong>{{ $associacao->DtNascimento }}</strong>, na cidade de <strong>{{ $associacao->CidadeDeNascimento }}</strong>, no estado de <strong>{{ $associacao->EstadoDeNascimento }}</strong>, presidente da associação <strong>{{ $associacao->NomeDaAssociacao }}</strong>, situada à <strong>{{ $associacao->EnderecoDaAssociacao }}</strong> no bairro {{ $associacao->BairroDaAssociacao }}</strong>, CEP <strong>{{ $associacao->CepDaAssociacao }}</strong>, na cidade de <strong>{{ $associacao->CidadeDaAssociacao }}</strong> no estado de <strong>{{ $associacao->EstadoDaAssociacao }}</strong>, com o telefone <strong>{{ $associacao->TelefoneDaAssociacao }}</strong>, e CNPJ <strong>{{ $associacao->CnpjDaAssociacao }}</strong>, tendo como instrutor o professor <strong>{{ $associacao->ProfessorInstrutor }}</strong> portador da graduação <strong>{{ $associacao->GraduacaoProfessorInstrutor }}</strong>, com a direção técnica do professor <strong>{{ $associacao->ProfessorDirecaoTecnica }}</strong> portador da graduação <strong>{{ $associacao->GraduacaoProfessorDirecaoTecnica }}</strong>.</p>

<p>Ficha preenchida em: <strong>{{ $associacao->DataPreenchimento }}</strong></p>


                    <p><strong>Nome da associação (Placa):</strong> {{ $associacao->NomeDaAssociacaoPlaca }}</p>

                    <button onclick="printCardBody()" class="btn btn-primary">Imprimir</button>
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