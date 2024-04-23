@extends('layouts.app4')

@section('content')

<div class="col-12 d-block justify-content-center align-items-center">
    <h2>Ficha de Filiação de Associação

    </h2>
    <br>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    <div class="alert alert-primary d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-5" width="24" height="24" role="img" aria-label="Info:">
            <use xlink:href="#info-fill" />
        </svg>
        <div>
             O Formulário abaixo refere-se a ficha de Filiação na Federação de Karatê Paulista.
             <ol>
                <li>
                    Registre primeiro os dados do(a) responsável da associação no qual será cadastrada para a filiação.
                    
                </li>
                <li>
                  Após o preenchimento dos dados do responsável da associação, preencha os dados completos da associação que será cadastrada como filiada.
                    
                </li>
             </ol>
        </div>
    </div>
    <br>
</div>

<div class="col-12 mt-1 mb-5 p-5" style="background-color: white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
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

    <form method="POST" action="{{ route('filiacao-store') }}">
    @csrf

        <fieldset>
            <legend class="bg-info text-light p-2">Dados do Representante</legend>
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="NomeDoRepresentante" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="NomeDoRepresentante" name="NomeDoRepresentante">
                </div>
                <div class="col-md-4 mt-2">
                    <label for="RG" class="form-label">RG</label>
                    <input type="text" class="form-control" id="RG" name="RG">
                </div>
                <div class="col-md-4 mt-2">
                    <label for="CPF" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="CPF" name="CPF">
                </div>

                <div class="col-md-4 mt-2">
                    <label for="DtNascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="DtNascimento" name="DtNascimento">
                </div>

                <div class="col-md-8 mt-2">
                    <label for="CidadeDeNascimento" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="CidadeDeNascimento" name="CidadeDeNascimento">
                </div>
                <div class="col-md-4 mt-2">
                    <label for="EstadoDeNascimento" class="form-label">Estado</label>
                    <select class="form-select form-control" id="EstadoDeNascimento" name="EstadoDeNascimento">
                        <option value="" disabled selected>Selecione o estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </div>


            </div>
            <div class="row mb-3">

            </div>
        </fieldset>
        <br>
        <hr>
        <br>
        <fieldset>
            <legend class="bg-primary text-light p-2">Dados da Associação</legend>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="NomeDaAssociacao" class="form-label">Nome da Associação</label>
                    <input type="text" class="form-control" id="NomeDaAssociacao" name="NomeDaAssociacao">
                </div>
                <div class="col-md-6">
                    <label for="TelefoneDaAssociacao" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="TelefoneDaAssociacao" name="TelefoneDaAssociacao">
                </div>
                <div class="col-md-4">
                    <label for="EnderecoDaAssociacao" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="EnderecoDaAssociacao" name="EnderecoDaAssociacao">
                </div>
                <div class="col-md-2">
                    <label for="NumeroDaAssociacao" class="form-label">Número</label>
                    <input type="text" class="form-control" id="NumeroDaAssociacao" name="NumeroDaAssociacao">
                </div>
                <div class="col-md-6">
                    <label for="BairroDaAssociacao" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="BairroDaAssociacao" name="BairroDaAssociacao">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mt-3">
                    <label for="CidadeDaAssociacao" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="CidadeDaAssociacao" name="CidadeDaAssociacao">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="EstadoDaAssociacao" class="form-label">Estado</label>
                    <select class="form-select form-control" id="EstadoDaAssociacao" name="EstadoDaAssociacao">
                        <option value="" disabled selected>Selecione o estado</option>
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3 mt-3">
                <div class="col-md-6 mt-3">
                    <label for="CepDaAssociacao" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="CepDaAssociacao" name="CepDaAssociacao">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="CnpjDaAssociacao" class="form-label">CNPJ</label>
                    <input type="text" class="form-control" id="CnpjDaAssociacao" name="CnpjDaAssociacao">
                </div>
                <div class="col-md-6 mt-3">

                    <label for="ProfessorInstrutor" class="form-label">Nome do Professor/Instrutor</label>
                    <input type="text" class="form-control" id="ProfessorInstrutor" name="ProfessorInstrutor">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="GraduacaoProfessorInstrutor" class="form-label">Graduação do Professor Instrutor</label>
                    <input type="text" class="form-control" id="GraduacaoProfessorInstrutor" name="GraduacaoProfessorInstrutor">
                </div>
            </div>
            <div class="row mb-3">

                <div class="col-md-6 mt-3">
                    <label for="ProfessorDirecaoTecnica" class="form-label">Nome do Professor da Direção Técnica</label>
                    <input type="text" class="form-control" id="ProfessorDirecaoTecnica" name="ProfessorDirecaoTecnica">
                </div>
                <div class="col-md-6 mt-3">
                    <label for="GraduacaoProfessorDirecaoTecnica" class="form-label">Graduação do Professor da Direção Técnica</label>
                    <input type="text" class="form-control" id="GraduacaoProfessorDirecaoTecnica" name="GraduacaoProfessorDirecaoTecnica">
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md-12 mt-3">
                    <label for="NomeDaAssociacaoPlaca" class="form-label">Nome da Placa</label>
                    <input type="text" class="form-control" id="NomeDaAssociacaoPlaca" name="NomeDaAssociacaoPlaca">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-lg btn-outline-primary w-100">Enviar</button>
                </div>
            </div>
        </fieldset>


        <hr>

        <!-- Restante do formulário continua aqui -->
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