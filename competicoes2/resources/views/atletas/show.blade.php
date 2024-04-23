@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mb-3">
                    Lista de Atletas
                    <a href="/atletas/criar" class="btn btn-primary float-end">CADASTRAR</a>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-warning" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <div class="card-body">
                    <table id="example2" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Instituição</th>
                                <th>Opçoes</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                            // Carregar todas as instituições uma vez
                            $instituicoes = \App\Models\Instituicoes::pluck('nome', 'id');
                            @endphp

                            @foreach($atletas as $atleta)
                            <tr>
                                <td>{{$atleta->id}}</td>
                                <td>{{$atleta->nome}}</td>
                                <td>{{ $instituicoes[$atleta->instituicao] ?? '' }}</td>
                                <td>
                                    <a href="{{ route('atletas.edit-form', ['id' => $atleta->id]) }}" class="btn btn-info"><i class="bi bi-pencil-square"></i></a>

                                    <form method="POST" action="{{ route('atletas.destroy', ['id' => $atleta->id]) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection