@extends('layouts.app4')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">

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


            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h2>Filiados Cadastrados</h2>
                    <a href="/cadastrar-filiado" class="btn btn-md btn-success" style="font-weight: bold;"><i class="fas fa-user-plus"></i> CADASTRAR FILIADO</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive d-flex justify-content-center align-items-center">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Login</th>
                                    <th>Status</th>
                                    <th colspan="2" class="text-center">Ações</th> <!-- Colspan para ocupar duas colunas e centralizar -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->LoginUsuario }}</td>
                                    <td>
                                        @if($usuario->AtivacaoUsuario == 0)
                                        <span class="text-danger">INATIVO</span>
                                        @else
                                        <span class="text-success"> ATIVO </span>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Botão de editar -->
                                        <a href="{{ route('edita-filiado-adm-controll', ['id' => $usuario->id]) }}" class="btn btn-primary">
                                            <i class="fas fa-user-edit"></i> Editar
                                        </a>

                                    </td>

                                    <td>
                                    <form action="{{ route('delete-filiado-controll', $usuario->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"> <i class="fas fa-user-times"></i>Remover Filiado</button>
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
</div>
@endsection