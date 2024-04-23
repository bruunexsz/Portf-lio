@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="">Formulário de Inscrição</div>

                <div class="card-body">
                    <!-- Se houver mensagens de erro de validação, exibe-as -->
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <!-- Se houver mensagens de sucesso na sessão, exibe-as -->
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('competicoes.update', ['id' => $competicao->id]) }}">
    @csrf
    @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input id="nome" type="text" class="form-control" name="nome" value="{{ $competicao->nome }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="tipo" class="form-label">Tipo</label>
                                <select class="form-control" required="required" id="tipo" name="tipo">
                                    <option value="1" {{ $competicao->tipo == 1 ? 'selected' : '' }}>Eliminatório</option>
                                    <option value="2" {{ $competicao->tipo == 2 ? 'selected' : '' }}>Eliminatório com repescagem</option>
                                    <option value="3" {{ $competicao->tipo == 3 ? 'selected' : '' }}>Todos contra todos</option>
                                </select>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="data" class="form-label">Data</label>
                                <input id="data" type="date" class="form-control" name="data" value="{{ $competicao->data }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="local" class="form-label">Local</label>
                                <input id="local" type="text" class="form-control" name="local" value="{{ $competicao->local }}" required>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="logradouro" class="form-label">Logradouro</label>
                                <input id="logradouro" type="text" class="form-control" name="logradouro" value="{{ $competicao->logradouro }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="numero" class="form-label">Número</label>
                                <input id="numero" type="text" class="form-control" name="numero" value="{{ $competicao->numero }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="complemento" class="form-label">Complemento</label>
                                <input id="complemento" type="text" class="form-control" name="complemento" value="{{ $competicao->complemento }}">
                            </div>
                            <div class="col-md-6">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input id="bairro" type="text" class="form-control" name="bairro" value="{{ $competicao->bairro }}" required>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input id="cidade" type="text" class="form-control" name="cidade" value="{{ $competicao->cidade }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="estado" class="form-label">Estado</label>
                                <select id="estado" name="estado" class="form-control" required>
                                    <option value="{{ $competicao->estado }}">{{ $competicao->estado }}</option>
                                    <option value="">Selecione...</option>
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
                            <div class="col-md-6">
                                <label for="inicio_inscricao" class="form-label">Início Inscrição</label>
                                <input id="inicio_inscricao" type="date" class="form-control" name="inicio_inscricao" value="{{ $competicao->inicio_inscricao ?? '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fim_inscricao" class="form-label">Fim Inscrição</label>
                                <input id="fim_inscricao" type="date" class="form-control" name="fim_inscricao" value="{{ $competicao->fim_inscricao ?? '' }}" required>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="taxa_inscricao" class="form-label">Taxa de Inscrição</label>
                                <input id="taxa_inscricao" type="text" class="form-control" name="taxa_inscricao" value="{{ $competicao->taxa_inscricao ?? '' }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="form-control" required>
                                    <option value="">Selecione o Status da Competição</option>
                                    <option value="1" {{ $competicao->status == 1 ? 'selected' : '' }}>Aberta</option>
                                    <option value="0" {{ $competicao->status == 0 ? 'selected' : '' }}>Fechada</option>
                                </select>
                            </div>


                            <div class="col-md-12">
                                <br>
                                <hr>
                                <br>
                                <label for="status" class="form-label">Categorias</label>
                                <br>
                                <div class="row">
                                    @foreach($categorias as $categoriaId => $categoriaNome)
                                    <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="categorias[]" value="{{ $categoriaId }}" {{ in_array($categoriaId, $categorias_competicao) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="categoria{{ $categoriaId }}">
                                            {{ $categoriaNome }}
                                        </label>
                                    </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>


                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection