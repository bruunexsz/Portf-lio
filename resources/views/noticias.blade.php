@extends('layouts.app2')


@section('content')

<div class="section-header">
    <h1>Notícias</h1>

    <div class="row">
        @foreach ($noticias as $noticia)
        <div class="col-lg-4 col-md-6 mb-4">
            <div style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;" class="speaker" data-aos="fade-up" data-aos-delay="100">
                @if (!empty($noticia->ImagemDestaque))
                <img src="{{ asset($noticia->ImagemDestaque) }}" alt="{{ $noticia->Titulo }}" class="img-fluid"  width="100%" height="200">
                @else
                <img src="{{ asset('Img/semfoto2.png') }}" alt="Sem Foto" class="img-fluid" width="100%" height="200">
                @endif

                <div class="details">
                    <h3><a href="{{ $noticia->UrlAmigavel }}">{{ $noticia->Titulo }}</a></h3>

                    <!-- Você pode adicionar outros campos conforme necessário -->
                    <div class="social">
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>





@endsection