@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="">Edição de Atletas</div>

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
                    <form method="POST" action="{{ route('atletas.update', ['id' => $atleta->id]) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input id="nome" type="text" class="form-control" name="nome" value="{{ $atleta->nome }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="apelido" class="form-label">Apelido</label>
                            <input id="apelido" type="text" class="form-control" name="apelido" value="{{ $atleta->apelido }}">
                        </div>

                        <div class="mb-3">
                            <label for="instituicao" class="form-label">Instituição</label>
                            <select name="instituicao" class="form-control">
                                @foreach($instituicoes as $instituicao)
                                <option value="{{ $instituicao->id }}" {{ $atleta->instituicao == $instituicao->id ? 'selected' : '' }}>{{ $instituicao->nome }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="data_de_nascimento" class="form-label">Data de Nascimento</label>
                            <input id="data_de_nascimento" type="date" class="form-control" name="data_de_nascimento" value="{{ $atleta->data_de_nascimento }}">
                        </div>

                        <div class="mb-3">
                            <label for="peso" class="form-label">Peso</label>
                            <input id="peso" type="number" class="form-control" name="peso" step="0.01" value="{{ $atleta->peso }}">
                        </div>

                        <div class="mb-3">
    <label for="faixa" class="form-label">Faixa</label>
    <select name="faixa" class="form-control">
        @foreach($allFaixas as $faixa)
            <option value="{{ $faixa->id }}" {{ $atleta->faixa == $faixa->id ? 'selected' : '' }}>{{ $faixa->nome }}</option>
        @endforeach
    </select>
</div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ $atleta->status == 1 ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ $atleta->status == 0 ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="sexo" class="form-label">Sexo</label>
                            <select name="sexo" class="form-control">
                                <option value="1" {{ $atleta->sexo == 1 ? 'selected' : '' }}>Masculino</option>
                                <option value="2" {{ $atleta->sexo == 2 ? 'selected' : '' }}>Feminino</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="altura" class="form-label">Altura</label>
                            <input id="altura" type="number" class="form-control" name="altura" step="0.01" value="{{ $atleta->altura }}">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
