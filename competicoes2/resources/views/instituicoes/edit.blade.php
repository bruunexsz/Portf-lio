@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="">Edição de Instituição</div>

                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('instituicoes.update', ['id' => $instituicoes->id]) }}">
    @csrf
    @method('PUT')

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input id="nome" type="text" class="form-control" name="nome" value="{{ $instituicoes->nome }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="responsavel" class="form-label">Responsável</label>
                            <input id="responsavel" type="text" class="form-control" name="responsavel" value="{{ $instituicoes->responsavel }}">
                        </div>


                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuário</label>
                            <select id="usuario" class="form-control" name="usuario">
                                @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->id }}" {{ $usuario->id == $usuarioSelecionado->id ? 'selected' : '' }}>
                                    {{ $usuario->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ $instituicoes->email }}">
                        </div>

                        <div class="mb-3">
                            <label for="telefone" class="form-label">Telefone</label>
                            <input id="telefone" type="text" class="form-control" name="telefone" value="{{ $instituicoes->telefone }}">
                        </div>

                        <div class="mb-3">
                            <label for="logradouro" class="form-label">Logradouro</label>
                            <input id="logradouro" type="text" class="form-control" name="logradouro" value="{{ $instituicoes->logradouro }}">
                        </div>

                        <div class="mb-3">
                            <label for="numero" class="form-label">Número</label>
                            <input id="numero" type="text" class="form-control" name="numero" value="{{ $instituicoes->numero }}">
                        </div>

                        <div class="mb-3">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input id="bairro" type="text" class="form-control" name="bairro" value="{{ $instituicoes->bairro }}">
                        </div>

                        <div class="mb-3">
                            <label for="complemento" class="form-label">Complemento</label>
                            <input id="complemento" type="text" class="form-control" name="complemento" value="{{ $instituicoes->complemento }}">
                        </div>


                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <input id="estado" type="text" class="form-control" name="estado" value="{{ $instituicoes->estado }}">
                        </div>

                        <div class="mb-3">
                            <label for="cidade" class="form-label">Cidade</label>
                            <input id="cidade" type="text" class="form-control" name="cidade" value="{{ $instituicoes->cidade }}">
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ $instituicoes->status == 1 ? 'selected' : '' }}>Ativo</option>
                                <option value="0" {{ $instituicoes->status == 0 ? 'selected' : '' }}>Inativo</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Cadastrar Instituição</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection