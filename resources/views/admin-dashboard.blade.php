@extends('layouts.app4')

@section('content')



<div class="col-xl-10 col-md-10 mb-4">

    Painel Administrativo
  
</div>
<style>
    .fas {
        color: #1A1416;
    }
    .h3-admindashboard{
        font-weight: bold;
    }
</style>


<div class="col-md-10 mb-5">
    <hr>
    <h3 class="h3-admindashboard">Fichas Não Lidas</h3>
    <hr>
</div>



<div class="col-md-3">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Renovação de Atletas</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRegistrosRenovaAtleta }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Filiacao de Atletas</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRegistrosFiliacaoAtletas }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user-friends"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Associações</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRegistrosFiliacaoAssociacao }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-university"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-3">
    <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Promoções Kyu</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRegistrosPromocaoKyu }}</div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-money-check"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-10 mt-5 mb-5">
    <hr>
    <h3 class="h3-admindashboard">Situação dos Filiados</h3>
    <hr>
</div>
<div class="col-md-6">
    <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">ATIVOS</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAtivos}}</div>
                </div>
                <div class="col-auto">
                <i class="fas fa-check-circle"></i>                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6">
    <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">INATIVOS</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalInativos }}</div>
                </div>
                <div class="col-auto">
                <i class="fas fa-times"></i>                </div>
            </div>
        </div>
    </div>
</div>


@endsection