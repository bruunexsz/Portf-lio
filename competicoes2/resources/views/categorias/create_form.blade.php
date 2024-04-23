@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="">Criação de Categoria</div>

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
               
                    <form method="POST" action="{{ route('categorias.store') }}"> <!-- Apontando para a rota categorias.store -->
                        @csrf

                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input id="nome" type="text" class="form-control" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="equipe" class="form-label">Individual/Equipe</label>
                            <select id="equipe" name="equipe" class="form-control">
                                <option value="0">Individual</option>
                                <option value="1">Equipe</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="idade_minima" class="form-label">Idade Mínima</label>
                            <input id="idade_minima" type="number" class="form-control" name="idade_minima">
                        </div>

                        <div class="mb-3">
                            <label for="idade_maxima" class="form-label">Idade Máxima</label>
                            <input id="idade_maxima" type="number" class="form-control" name="idade_maxima">
                        </div>

                        <div class="mb-3">
                            <label for="sexo" class="form-label">Sexo</label>
                            <select name="sexo" class="form-control">
                                <option value="1">Masculino</option>
                                <option value="2">Feminino</option>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <select id="tipo" name="tipo" class="form-control">
                                <option value="1">Kata Básico</option>
                                <option value="2">Kata Tokuy</option>
                                <option value="3">Kumite</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="sistema" class="form-label">Sistema</label>
                            <select id="sistema" name="sistema" class="form-control">
                                <option value="1">Sem Sistema</option>
                                <option value="2">R - Permitido Repetir</option>
                                <option value="3">PRF - Permitido Repetir na Final</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="altura_minima" class="form-label">Altura Mínima</label>
                            <input id="altura_minima" type="number" class="form-control" name="altura_minima" step="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="altura_maxima" class="form-label">Altura Máxima</label>
                            <input id="altura_maxima" type="number" class="form-control" name="altura_maxima" step="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="peso_minimo" class="form-label">Peso Mínimo</label>
                            <input id="peso_minimo" type="number" class="form-control" name="peso_minimo" step="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="peso_maximo" class="form-label">Peso Máximo</label>
                            <input id="peso_maximo" type="number" class="form-control" name="peso_maximo" step="0.01">
                        </div>
                        <div class="mb-3">
                            <label for="faixas" class="form-label">Faixas</label>
                            <br>
                            @foreach($faixas as $faixa)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="faixas[]" id="faixa{{ $faixa->id }}" value="{{ $faixa->id }}">
                                <label class="form-check-label" for="faixa{{ $faixa->id }}">{{ $faixa->nome }}</label>
                            </div>
                            @endforeach
                        </div>


                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100">Criar Categoria</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection