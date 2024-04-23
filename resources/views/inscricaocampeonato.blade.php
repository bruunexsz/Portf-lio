@extends('layouts.app4')

@section('content')

<div class="col-10 d-block justify-content-center align-items-center">
    <h2>Ficha de Inscrição Para Campeonatos
    </h2>

</div>

<div class="col-12 mt-5 mb-5 p-5" style="background-color: white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('camp-inscricao-store') }}">
      
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="NomeCampeonato" class="form-label">Nome do Campeonato</label>
                <input type="text" class="form-control" id="NomeCampeonato" name="NomeCampeonato">
            </div>
            <div class="col-md-12">
                <label for="NomeAssociacao" class="form-label">Nome da Associação</label>
                <input type="text" class="form-control" id="NomeAssociacao" name="NomeAssociacao">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-8">
                <label for="Professor" class="form-label">Professor</label>
                <input type="text" class="form-control" id="Professor" name="Professor">
            </div>
            <div class="col-md-4">
                <label for="DDDTelefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="DDDTelefone" name="DDDTelefone">
            </div>
        </div>
        <!-- Adicionar Atleta -->
        <div id="containerAtletas" class="mb-5 mt-5">
            <div class="row mb-3 atleta">
                <div class="col-md-4">
                    <label for="nomeAtleta" class="form-label">Nome do Atleta</label>
                    <input type="text" class="form-control" name="nomeAtleta[]">
                </div>
                <div class="col-md-4">
                    <label for="nFkp" class="form-label">Nº da Categoria Kata</label>
                    <input type="text" class="form-control" name="nKata[]">
                </div>
                <div class="col-md-4">
                    <label for="kuy" class="form-label">Nº da Categoria Kumite</label>
                    <input type="text" class="form-control" name="nKumite[]">
                </div>

            </div>
        </div>

        <!-- Botão para Adicionar Atleta -->
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-md-12">
                <button type="button" id="btnAddAtleta" class="btn btn-success w-100">ADICIONAR ATLETA</button>
            </div>
        </div>

        <div class="row mb-3">

            <div class="col-md-4">
                <label for="NAtletas" class="form-label">Nº de Atletas</label>
                <input type="text" class="form-control" id="NAtletas" name="NAtletas">
            </div>
            <div class="col-md-4">
                <label for="TotalKata" class="form-label">Total Kata</label>
                <input type="text" class="form-control" id="TotalKata" name="TotalKata">
            </div>
            <div class="col-md-4">
                <label for="Valor" class="form-label">Valor</label>
                <input placeholder="R$" type="text" class="form-control" id="Valor" name="Valor">
            </div>
        </div>
        <div class="row mb-3">

            <div class="col-md-6">
                <label for="Arbitro" class="form-label">Árbitro</label>
                <input type="text" class="form-control" id="Arbitro" name="Arbitro">
            </div>
            <div class="col-md-6">
                <label for="Mesario" class="form-label">Mesário</label>
                <input type="text" class="form-control" id="Mesario" name="Mesario">
            </div>
        </div>
        <div class="row mb-3">

            <div class="col-md-12">
                <label for="ProfessorResponsavel" class="form-label">Professor Responsável</label>
                <input type="text" class="form-control" id="ProfessorResponsavel" name="ProfessorResponsavel">
            </div>
        </div>

        <hr>


        <!-- Botão de Envio -->
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary w-100">Enviar</button>
            </div>
        </div>
    </form>
    <script>
        const btnAddAtleta = document.getElementById('btnAddAtleta');
        btnAddAtleta.addEventListener('click', adicionarAtleta);

        function adicionarAtleta() {
            const containerAtletas = document.getElementById('containerAtletas');
            const novoAtleta = document.createElement('div');
            novoAtleta.classList.add('row', 'mb-3', 'atleta');
            novoAtleta.innerHTML = `
            <div class="col-md-4">
                <label for="nomeAtleta" class="form-label">Nome do Atleta</label>
                <input type="text" class="form-control" name="nomeAtleta[]">
            </div>
            <div class="col-md-4">
                <label for="nFkp" class="form-label">Nº da Categoria Kata</label>
                <input type="text" class="form-control" name="nKata[]">
            </div>
            <div class="col-md-4">
                <label for="kuy" class="form-label">Nº da Categoria Kumite</label>
                <input type="text" class="form-control" name="nKumite[]">
            </div>
           
        `;
            containerAtletas.appendChild(novoAtleta);
        }
    </script>

</div>

@endsection