@extends('layouts.app2')


@section('content')


<div class="container-fluid">
            <div class="container">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Instituição</th>
                      <th scope="col">Tipo</th>
                      <th scope="col">Quantidade</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($inscricoes as $index => $inscricao)
                        <tr>
                          <th scope="row">{{ $index + 1 }}</th>
                          <td>{{ ucwords(strtolower($inscricao->instituicao)) }}</td>
                          <td>{{ $inscricao->tipo_inscricao }}</td>
                          <td>{{ $inscricao->qtd_inscritos }}</td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>

@endsection