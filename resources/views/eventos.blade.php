@extends('layouts.app2')

@section('content')

<div class="section-header">
    <h2>Eventos</h2>
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título do Evento</th>
                <th>Local do Evento</th>
                <th>Data Inicial</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
            <tr>
                <td>{{ $evento->TituloDoEvento }}</td>
                <td>{{ $evento->LocalDoEvento }}</td>
                <td>{{ \Carbon\Carbon::parse($evento->DataInicial)->format('d/m/Y') }}</td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
