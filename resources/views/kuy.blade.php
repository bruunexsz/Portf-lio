@extends('layouts.app4')

@section('content')

<div class="col-6 d-flex justify-content-center align-items-center">
    <h2>Promoção de Kyu</h2>
</div>

<div class="col-11 mt-5 mb-5 p-5" style="background-color: white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <form method="POST" action="{{ route('promocao-de-kuy') }}">
        @csrf
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="NomeDaAssociacao" class="form-label">Nome da Associação</label>
                <input type="text" class="form-control" id="NomeDaAssociacao" name="NomeDaAssociacao">
            </div>
            <div class="col-md-6">
                <label for="Professor" class="form-label">Professor</label>
                <input type="text" class="form-control" id="Professor" name="Professor">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="DDDTelefone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="DDDTelefone" name="DDDTelefone">
            </div>
            <div class="col-md-6">
                <label for="DtDoExame" class="form-label">Data do Exame</label>
                <input type="date" class="form-control" id="DtDoExame" name="DtDoExame">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <label for="Examinador" class="form-label">Examinador</label>
                <input type="text" class="form-control" id="Examinador" name="Examinador">
            </div>

        </div>
        <hr>

        <div id="containerAtletas" class="mb-5 mt-5" style="">
            <div class="row mb-3 atleta" style="">
                <div class="col-md-3">
                    <label for="nomeAtleta" class="form-label">Nome do Atleta</label>
                    <input type="text" class="form-control" name="nomeAtleta[]">
                </div>
                <div class="col-md-2">
                    <label for="nFkp" class="form-label">Nº FKP</label>
                    <input type="text" class="form-control" name="nFkp[]">
                </div>
                <div class="col-md-2">
                    <label for="kuy" class="form-label">Kuy</label>
                    <input type="text" class="form-control" name="kuy[]">
                </div>
                <div class="col-md-3">
                    <label for="dataNascimento" class="form-label">Data Nascimento</label>
                    <input type="date" class="form-control" name="dataNascimento[]">
                </div>
                <div class="col-md-2">
                    <label for="rg" class="form-label">RG</label>
                    <input type="text" class="form-control" name="rg[]">
                </div>

            </div>
        </div>
        <div class="row d-flex justify-content-center mb-5 ">
            <div class="col-md-12">
                <button type="button" id="btnAddAtleta" class="btn btn-success w-100">ADICIONAR ATLETA</button>
            </div>
        </div>

        <hr>
        <div class="row mb-3 mt-4">
            <div class="col-md-6">
                <label for="NPromocoes" class="form-label">Nº de Promoções</label>
                <input type="text" class="form-control" id="NPromocoes" name="NPromocoes">
            </div>
            <div class="col-md-6">
                <label for="Valor" class="form-label">Valor</label>
                <input placeholder="R$" type="text" class="form-control" id="Valor" name="Valor">
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary w-100">Enviar</button>
            </div>
        </div>
    </form>
</div>
<script>
    const btnAddAtleta = document.getElementById('btnAddAtleta');
    btnAddAtleta.addEventListener('click', adicionarAtleta);

    function adicionarAtleta() {
        const containerAtletas = document.getElementById('containerAtletas');
        const novoAtleta = document.createElement('div');
        novoAtleta.classList.add('row', 'mb-3', 'atleta');
        novoAtleta.innerHTML = `
            <div class="col-md-3">
                <label for="nomeAtleta" class="form-label">Nome do Atleta</label>
                <input type="text" class="form-control" name="nomeAtleta[]">
            </div>
            <div class="col-md-2">
                <label for="nFkp" class="form-label">Nº FKP</label>
                <input type="text" class="form-control" name="nFkp[]">
            </div>
            <div class="col-md-2">
                <label for="kuy" class="form-label">Kuy</label>
                <input type="text" class="form-control" name="kuy[]">
            </div>
            <div class="col-md-3">
                <label for="dataNascimento" class="form-label">Data Nascimento</label>
                <input type="date" class="form-control" name="dataNascimento[]">
            </div>
            <div class="col-md-2">
                <label for="rg" class="form-label">RG</label>
                <input type="text" class="form-control" name="rg[]">
            </div>
        `;
        containerAtletas.appendChild(novoAtleta);
    }
</script>
@endsection