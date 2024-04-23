@extends('layouts.app2')


@section('content')


<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12 d-flex justify-content-center">

            <div class="card w-100">
                <div class="card-header">
                    CATEGORIAS DA COMPETICAO

                </div>




                <div class="card-body">
                    <table id="example" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 10%;"> Código</th>
                                <th style="width: 40%;"> Nome</th>
                                <th style="width: 15%;"> Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categorias as $item)
                            <tr class="gradeX">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->nome }}</td>
                                <td>
                                    <a class="btn btn-secondary" style="" target="_blank" href="">
                                        <i class="bi bi-file-plus"></i>
                                    </a>
                                    <a class="btn btn-light" style="" target="_blank" href="{{ url('/confrontos/pesagem/' . $item->id . '/competicao/' . $competicao->id) }}">
    <i class="bi bi-plus"></i>
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
</div>


@endsection