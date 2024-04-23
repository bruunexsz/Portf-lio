@extends('layouts.app4')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-10 d-flex justify-content-start align-items-center mb-5">
            <a class="btnVoltar" href="/inscricoes-para-promocao-de-kyu"><i class="fas fa-arrow-circle-left"></i> VOLTAR</a>
        </div>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h2>Inscrições para Promoção de Kyu</h2>
                </div>
                <div class="card-body" id="cardBody">
                    <strong>Fichada preenchida por: <strong class="text-danger">{{$loginUsuario}}</strong></strong>
                    <br>
                    <br>
                    <hr>

                    <p><strong>Data de Preenchimento:</strong> {{ $promocaoAtleta->DataPreenchimento }}</p>
                    <p><strong>Nome da Associação:</strong> {{ $promocaoAtleta->NomeDaAssociacao }}</p>
                    <p><strong>Professor:</strong> {{ $promocaoAtleta->Professor }}</p>
                    <p><strong>DDD do Telefone:</strong> {{ $promocaoAtleta->DDDTelefone }}</p>
                    <p><strong>Data do Exame:</strong> {{ $promocaoAtleta->DtDoExame }}</p>
                    <p><strong>Examinador:</strong> {{ $promocaoAtleta->Examinador }}</p>
                    
                    @if(!is_null($promocaoAtleta->NomesAtletasInformacoes))
                        @if(substr($promocaoAtleta->NomesAtletasInformacoes, 0, 1) === '[')
                            <!-- Dados em formato JSON -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nome do Atleta</th>
                                        <th>NFKP</th>
                                        <th>Kuy</th>
                                        <th>Data de Nascimento</th>
                                        <th>RG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(json_decode($promocaoAtleta->NomesAtletasInformacoes, true) as $info)
                                        <tr>
                                            <td>{{ $info['NomeAtleta'] }}</td>
                                            <td>{{ $info['NFKP'] }}</td>
                                            <td>{{ $info['Kuy'] }}</td>
                                            <td>{{ $info['DataNascimento'] }}</td>
                                            <td>{{ $info['RG'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <!-- Dados em formato HTML -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Número</th>
                                        <th>Nome do Atleta</th>
                                        <th>NFKP</th>
                                        <th>Kuy</th>
                                        <th>Data de Nascimento</th>
                                        <th>RG</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        // Analise a string HTML para extrair os dados relevantes
                                        preg_match_all('/<tr><td height="20">(.*?)<\/td><td>(.*?)<\/td><td align="center">(.*?)<\/td><td align="center">(.*?)<\/td><td align="center">(.*?)<\/td><td align="center">(.*?)<\/td><\/tr>/', $promocaoAtleta->NomesAtletasInformacoes, $matches, PREG_SET_ORDER);
                                    @endphp

                                    @foreach($matches as $match)
                                        <tr>
                                            <td>{{ $match[1] }}</td>
                                            <td>{{ $match[2] }}</td>
                                            <td>{{ $match[3] }}</td>
                                            <td>{{ $match[4] }}</td>
                                            <td>{{ $match[5] }}</td>
                                            <td>{{ $match[6] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    @endif

                    <p><strong>Número de Promoções:</strong> {{ $promocaoAtleta->NPromocoes }}</p>
                    <p><strong>Valor:</strong> R$ {{ $promocaoAtleta->Valor }}</p>

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
