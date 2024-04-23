@extends('layouts.app4')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-info" role="alert">
                As contas abaixo referen-se a conta(s) de usuário(s) Administradores Do Sistema.
                <br>
                <strong>Somente os cadastrados abaixo tem acesso exclusivo a ferramentas de administração.</strong>
            </div>
            <hr>

            </svg>
            <div class="alert alert-warning d-flex align-items-center p-2" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                ⚠️  Cada administrador pode editar apenas o próprio perfil.
                </div>
            </div>
        </div>
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
                    <h2>Administradores Do Sistema</h2>
                    <a href="/cadastrar-administrador" class="btn btn-md btn-danger" style="font-weight: bold;"><i class="fas fa-user-tie"></i> CADASTRAR ADMINISTRADOR</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive d-flex justify-content-center align-items-center">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Login</th>
                                    <th>Status</th>
                                    <th>Permissão</th>
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
                                        <span style="" class="text-success"> ATIVO </span>
                                        @endif
                                    </td>
                                    <td><strong>{{ $usuario->permissao }}</strong></td>
                                    <td>
                                        <!-- Botões de editar e excluir -->
                                        <a href="{{ route('edit-administrador', $usuario->id) }}" class="btn btn-primary"> <i class="fas fa-user-edit"></i> Editar</a>
                                    </td>
                                    <td>
                                        @if($usuarios->count() > 1)
                                        <form action="{{ route('delete-administrador', $usuario->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"> <i class="fas fa-user-times"></i>Remover</button>
                                        </form>
                                        @endif
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