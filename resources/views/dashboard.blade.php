@extends('layouts.app4')

@section('content')

@foreach($mensagens as $mensagem)
<div class="col-xl-10 col-md-10 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col">
                    <div class="text-xs  text-dark mb-1">
                        <h6 class="text-gray-900">{{ $mensagem->TituloDaMensagem }}</h6>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="far fa-envelope fa-2x text-gray-600"></i>
                </div>
            </div>
            <!-- Botão "Ver Mensagem Completa" -->
            <div class="row justify-content-end mt-3">
                <div class="col-auto">
                    <a href="{{ route('visualizarMensagem', ['id' => $mensagem->ID]) }}" class="btn btn-primary">Ver Mensagem Completa</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="col-12 mb-5 mt-5">
    <!-- Botões de paginação -->
    <div class="row mt-4">
        <div class="col">
            @if ($mensagens->hasPages())
            <ul class="pagination justify-content-center">
                <!-- Botão "Voltar" -->
                @if ($mensagens->previousPageUrl())
                <li class="page-item">
                    <a style="background-color: #2E6AC9;color:white;" class="page-link" href="{{ $mensagens->previousPageUrl() }}" aria-label="Anterior">Voltar</a>
                </li>
                @endif

                <!-- Botão "Ver Mais" ou "Próxima" -->
                @if ($mensagens->hasMorePages())
                <li class="page-item">
                    <a style="background-color: #2ECC71;color:white;" class="page-link" href="{{ $mensagens->nextPageUrl() }}" aria-label="Próxima">Ver Mais</a>
                </li>
                @endif
            </ul>
            @endif
        </div>
    </div>
</div>

@endsection
