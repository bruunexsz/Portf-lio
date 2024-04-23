@extends('layouts.app4')

@section('content')

<div class="col-10 d-block justify-content-center align-items-center">
    <h2>Ficha de Filiação de Atleta


    </h2>

</div>

<div class="col-10 mt-5 mb-5 p-5" style="background-color: white;box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
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

    <form method="POST" action="{{ route('filiacao-filiado-store') }}" enctype="multipart/form-data">

        @csrf
        <fieldset>
            <legend class="bg-info text-light p-2">Registro de Atleta</legend>
            <div class="row mb-3">
                <hr>
                <div style="box-shadow: rgba(0, 0, 0, 0.05) 0px 6px 24px 0px, rgba(0, 0, 0, 0.08) 0px 0px 0px 1px;" class="col-md-5 d-flex justify-content-center align-items-center mt-5 mb-5 p-4">
                    <img id="preview" src="#" alt="Imagem de visualização" style="display: none; max-width: 300px; height: 250px;">
                </div>
                <div class="col-md-7 d-flex justify-content-center align-items-center mt-5 mb-5 p-1" style="border-radius:7px;">
                    <div class="col-12 d-block">
                        <label for="imagem_filiado" class="form-label" style="font-weight: bold; font-size: 1.2em;"><i style="color: #AED6F1;" class="fas fa-camera-retro"></i> ENVIE UMA FOTO*</label>
                        <br>
                        <hr>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imagem_filiado" name="imagem_filiado" onchange="previewImage(event)">
                            <label class="custom-file-label" id="imagem_filiado_label" for="imagem_filiado">Escolha uma foto para enviar</label>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <hr>
                <div class="col-md-12 d-flex justify-content-center align-items-center mt-5 mb-5 p-1" style="border-radius: 7px;">
    <fieldset class="w-100">
        <legend style="font-weight: bold;">Envie o Certificado e o RG em um PDF*:</legend>
        <div class="custom-file w-100 bg-light" style="border: 3px dashed #F94A5B; padding: 20px; text-align: center;">
            <label for="pdf_arquivo">CLIQUE AQUI PARA ENVIAR</label>
            <input type="file" class="form-control-file custom-file-input" id="pdf_arquivo" name="pdf_arquivo" style="display: none;">
        </div>
        <div id="pdf_status" class="mt-2 text-success" style="display: none;">PDF Enviado</div>
    </fieldset>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#pdf_arquivo').change(function(){
            var filename = $(this).val().split('\\').pop();
            $('#pdf_status').html(filename + ' enviado').show();
        });
    });
</script>


                <hr>
                <br>
                <br>




                <script>
                    // Atualiza o texto do label com o nome do arquivo selecionado
                    document.getElementById('imagem_filiado').addEventListener('change', function(event) {
                        var fileName = event.target.files[0].name;
                        document.getElementById('imagem_filiado_label').innerHTML = fileName;
                    });
                </script>

                <div class="col-md-12">
                    <label for="NRegistroFKP" class="form-label">Nº Do Registro FKP</label>
                    <input type="text" class="form-control" id="NRegistroFKP" name="NRegistroFKP">
                </div>
                <div class="col-md-12">
                    <label for="NomeDoAtleta" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="NomeDoAtleta" name="NomeDoAtleta">
                </div>
                <div class="col-md-6 mt-2">
                    <label for="DtNascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="DtNascimento" name="DtNascimento">
                </div>
                <div class="col-md-6 mt-2">
                    <label for="RG" class="form-label">RG</label>
                    <input type="text" class="form-control" id="RG" name="RG">

                </div>
                <hr>

                <br>
                <hr>
                <div class="col-md-6 mt-5 mb-5">
                    <label for="Endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="Endereco" name="Endereco">
                </div>
                <div class="col-md-2 mt-2 mt-5 mb-5">
                    <label for="NEndereco" class="form-label">Nº</label>
                    <input type="text" class="form-control" id="NEndereco" name="NEndereco">
                </div>
                <div class="col-md-4 mt-2 mt-5 mb-5">
                    <label for="Bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="Bairro" name="Bairro">
                </div>



                <div class="col-md-4 mt-2">

                    <label for="Telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="Telefone" name="Telefone">
                </div>
                <div class="col-md-6 mt-2">
                    <label for="Cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="Cidade" name="Cidade">
                </div>
                <div class="col-md-2 mt-2">
                    <label for="Estado" class="form-label">Estado</label>
                    <select class="form-select form-control" id="Estado" name="Estado">
                        <option value="" disabled selected>Selecione a UF</option>
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

                <div class="col-md-12 mb-5">
                    <label for="CEP" class="form-label">CEP</label>
                    <input type="text" class="form-control" id="CEP" name="CEP">
                </div>
                <div class="col-md-12 mt-2">
                    <label for="NomeDoPai" class="form-label">Nome do Pai</label>
                    <input type="text" class="form-control" id="NomeDoPai" name="NomeDoPai">
                </div>
                <div class="col-md-12 mt-2">
                    <label for="NomeDaMae" class="form-label">Nome da Mãe</label>
                    <input type="text" class="form-control" id="NomeDaMae" name="NomeDaMae">
                </div>

                <div class="col-md-6 mt-5">
                    <label for="GraduacaoAtual" class="form-label">Graduação Atual</label>
                    <input type="text" class="form-control" id="GraduacaoAtual" name="GraduacaoAtual">
                </div>
                <div class="col-md-6 mt-2 mt-5">
                    <label for="DtGraduacaoAtual" class="form-label">Data da Graduação</label>
                    <input type="date" class="form-control" id="DtGraduacaoAtual" name="DtGraduacaoAtual">
                </div>
                <div class="col-md-6 mt-2">
                    <label for="AssosiacaoFiliada" class="form-label">Associação Filiada</label>
                    <input type="text" class="form-control" id="AssosiacaoFiliada" name="AssosiacaoFiliada">
                </div>
                <div class="col-md-6 mt-2">
                    <label for="ProfessorResponsavel" class="form-label">Professor Responsável</label>
                    <input type="text" class="form-control" id="ProfessorResponsavel" name="ProfessorResponsavel">
                </div>
                <br><br>


                <style>
                    .custom-file-input::-webkit-file-upload-button {
                        visibility: hidden;
                    }

                    .custom-file-input::before {
                        content: 'Selecionar arquivo';
                        display: inline-block;
                        background: linear-gradient(top, #f9f9f9, #e3e3e3);
                        border: 1px solid #999;
                        border-radius: 3px;
                        padding: 5px 8px;
                        outline: none;
                        white-space: nowrap;
                        cursor: pointer;
                        text-shadow: 1px 1px #fff;
                        font-weight: 700;
                        font-size: 10pt;
                    }

                    .custom-file-input:hover::before {
                        border-color: black;
                    }

                    .custom-file-input:active::before {
                        background: -webkit-linear-gradient(top, #e3e3e3, #f9f9f9);
                    }
                </style>
                <script>
                    function previewImage(event) {
                        var reader = new FileReader();
                        reader.onload = function() {
                            var output = document.getElementById('preview');
                            output.style.display = 'block';
                            output.src = reader.result;
                        }
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>
            </div>
            <div class="row mt-5 mb-5">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-lg btn-primary w-100">Cadastrar</button>
                </div>
            </div>
        </fieldset>

        <br>
        <hr>


        <!-- Restante do formulário continua aqui -->
    </form>

</div>

@endsection