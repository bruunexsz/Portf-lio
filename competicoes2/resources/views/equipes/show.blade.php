@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Lista de Equipes
                    <a href="/equipes/criar"  class="btn btn-primary float-end">CADASTRAR</a>
                </div>

                <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nome</th>
                              
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($equipes as $equipe)
                            <tr>
                                <td>{{$equipe->id}}</td>
                                <td>{{$equipe->nome}}</td>
                                <td>
                                    <!-- Botão de Editar -->
                                    <a href="#" class="btn btn-primary" style="background-color: blue;">
                                        <i class="bi bi-pencil-fill" style="color: white;"></i>
                                    </a>
                                    <!-- Botão de Excluir -->
                                    <a href="#" class="btn btn-danger" style="background-color: red;">
                                        <i class="bi bi-trash-fill" style="color: white;"></i>
                                    </a>
                                  
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
