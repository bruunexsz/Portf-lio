@extends('layouts.app4')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-10 d-flex justify-content-start align-items-center mb-5">
            <a class="btnVoltar" href="/dashboard"><i class="fas fa-arrow-circle-left"></i> VOLTAR</a>
        </div>
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h2>{{ $mensagem->TituloDaMensagem }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Conteúdo da Mensagem:</strong></p>
                    <hr>
                    <p>{!! $mensagem->TextoConteudoDaMensagem !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
