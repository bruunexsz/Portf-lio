@extends('layouts.app2')

@section('content')

<div class="section-header">
    <h2>Resultados</h2>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título do Resultado</th>
                <th>Local do Resultado</th>
                <th>Data do Resultado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $resultado)
            <tr>
                <td>{{ $resultado->TituloDoResultado }}</td>
                <td>{{ $resultado->LocalDoResultado }}</td>
                <td>{{ \Carbon\Carbon::parse($resultado->DataDoResultado)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
