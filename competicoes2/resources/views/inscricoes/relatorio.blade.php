@extends('layouts.app2')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @foreach($instituicoes as $index => $instituicao)
<table class="table" style="page-break-before: always; ">
  <thead>
    <tr>
      <th scope="col" colspan="3" style="text-align: center;">{{ $instituicao->nome }}</th>
    </tr>
  </thead>
  <thead>
    <tr>
      <th scope="col" style="width: 30%;">Nome</th>
      <th scope="col" style="width: 30%;">Instituição</th>
      <th scope="col" style="width: 30%;">Categoria</th>
    </tr>
  </thead>
  <tbody>
    @foreach($inscricoes[$instituicao->id] as $index => $inscricao)
    <tr>
      <td>{{ ucwords(strtolower($inscricao->atleta_inscrito ? $inscricao->atleta_inscrito->nome : ($inscricao->equipe_inscrito ? $inscricao->equipe_inscrito->nome : ''))) }}</td>
      <td>{{ ucwords(strtolower($inscricao->atleta_inscrito ? $inscricao->atleta_inscrito->atleta_instituicao->nome : ($inscricao->equipe_inscrito ? $inscricao->equipe_inscrito->equipe_instituicao->nome : ''))) }}</td>
      <td>{{ ucwords(strtolower($inscricao->categoria_inscrito ? $inscricao->categoria_inscrito->nome . ' - ' . $inscricao->categoria_inscrito->tipo_descricao : '')) }}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endforeach

        </div>

    </div>

</div>




@endsection