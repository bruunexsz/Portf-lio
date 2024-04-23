@extends('layouts.app4')

@section('content')

<div class="col-6 d-flex justify-content-center align-items-center">
    <h2>Tabela de Custos</h2>
</div>

<div class="col-6 d-flex justify-content-center align-items-center">
    <button type="button" class="btn btn-primary" onclick="imprimirVersaoImpressa()">Versão Impressa</button>
</div>

<div class="col-10 mt-5 d-flex justify-content-center">
<table id="tabelaCustos" class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Descrição</th>
            <th scope="col">Valor</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Renovação de Anuidade de Entidade Afiliada</td>
            <td>01 Salário Mínimo</td>
        </tr>
        <tr>
            <td>Afiliação de nova Entidade</td>
            <td>01 Salário Mínimo</td>
        </tr>
        <tr>
            <td>Afiliação e Renovação de Atleta (Kyu)</td>
            <td>R$ 120.00 <br>Até dia 29/02/24 R$ 100.00</td>
        </tr>
        <tr>
            <td>Afiliação e Renovação de Faixa Preta (Dan)</td>
            <td>R$ 200.00 <br>Até dia 29/02/24 R$ 180.00</td>
        </tr>
        <tr>
            <td>Participação de Open Kumite Individual</td>
            <td>R$ 60.00 p/atleta</td>
        </tr>
        <tr>
            <td>Participação de Open Kata Individual</td>
            <td>R$ 60.00 p/atleta</td>
        </tr>
        <tr>
            <td>Participação de Open Kumite e Kata Individual</td>
            <td>R$ 80.00 p/atleta</td>
        </tr>
        <tr>
            <td>Participação de Paulista Kumite Individual</td>
            <td>R$ 90.00 p/atleta</td>
        </tr>
        <tr>
            <td>Participação de Paulista Kata Individual</td>
            <td>R$ 90.00 p/atleta</td>
        </tr>
        <tr>
            <td>Participação de Paulista Kumite e Kata Individual</td>
            <td>R$ 120.00 p/atleta</td>
        </tr>
        <tr>
            <td>Promoção de Kyus</td>
            <td>R$ 50.00</td>
        </tr>
        <tr>
            <td>Homologação de Faixa Preta acréscimo de R$ 30.00 por Dan</td>
            <td>R$ 150.00</td>
        </tr>
        <tr>
            <td>Cursos Técnico/Credenciamento/Árbitros etc.</td>
            <td>R$ 80.00 à 1 salário mínimo.</td>
        </tr>
        <tr>
            <td>Associação que se apresentar s/ Placa de Identificação</td>
            <td>R$ 50.00</td>
        </tr>
        <tr>
            <td>Associação que não apresentar Árbitro e Mesário</td>
            <td>R$ 100.00 (Árbitro)<br>R$ 50.00 (Mesário)</td>
        </tr>
        <tr>
            <td>Atleta que se apresentar sem distintivo no Kimono</td>
            <td>R$ 30.00</td>
        </tr>
        <tr>
            <td>Taxa de transferência de Atleta</td>
            <td>R$ 200.00</td>
        </tr>
        <tr>
            <td>Atestado e Declarações (conforme a declaração)</td>
            <td>Sob consulta</td>
        </tr>
        <tr>
            <td>Taxa para realização de evento (Open)</td>
            <td>R$ 13.000,00</td>
        </tr>
        <tr>
            <td>Taxa para realização de evento (Camp. Paulista e Copa SP)</td>
            <td>R$ 15.000,00</td>
        </tr>
        <tr>
            <td>Aluguel de material para evento interno</td>
            <td>R$ 1.500,00 por área</td>
        </tr>
    </tbody>
</table>

</div>

<div class="col-12 d-flex justify-content-center">
<div id="lembrete" class="alert alert-info">
    <strong>Lembretes:</strong><br>
    <span><b>1-</b> Em conformidade com o Estatuto da FKP, os valores em Reais apresentados nesta tabela estão sujeitos a alterações, por decisão da diretoria da FKP, sempre que se julgar necessário.</span><br>
    <span><b>2-</b> Cheques devolvidos e/ou sustados será cobrado multa de 20% do valor do cheque além de sanções previstas no Estatuto da FKP.</span><br>
    <span><b>3-</b> No caso de cheque devolvido o emitente poderá ser acionado judicialmente na área cível, inclusive por perdas e danos, e na área criminal pelo crime correspondente (art. 17l do cód. penal), arcando com todas as despesas judiciais e honorárias advocatícios.</span><br>
    <span><b>4-</b> Todos os pagamentos deverão ser efetuados diretamente na conta da FKP - Banco do Brasil Agência 0057-4 c/c nº 109.780-6 ou via boleto.</span><br>
    <span>Esta tabela entra em vigor a partir de 1° de janeiro de 2024.</span><br>
    <br>
    <span>Roberto Luís Fuscaldo</span><br>
    <span>Presidente</span>
</div>

</div>

@endsection
