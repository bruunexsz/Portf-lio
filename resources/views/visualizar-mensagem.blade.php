@extends('layouts.app4')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-10 d-flex justify-content-start align-items-center mb-5">
            <a class="btnVoltar" href="/dashboard"><i class="fas fa-arrow-circle-left"></i> VOLTAR</a>
        </div>
        <div class="col-md-12">
            <div class="card mb-4" style="box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;">
                <div class="card-header p-4" style="background-color: #283747;color:white;font-weight:900 !important">
                    <h2>{{ $mensagem->TituloDaMensagem }}</h2>
                </div>
                <div class="card-body">
                  
                    <br>
                    <br>
                    <p>{!! $mensagem->TextoConteudoDaMensagem !!}</p>
                    <br>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
