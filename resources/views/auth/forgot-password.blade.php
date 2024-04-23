@extends('layouts.app3')

@section('content')

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0 mb-5 mt-5">
        <!-- Nested Row within Card Body -->
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 text-center">
                <div class="pl-5 pr-5">
                    <div class="text-center">
                        <img src="{{ asset('/images/logofkp2.png') }}" width="120px">
                        <br>
                        <h1 class="h4 text-gray-900 mb-4">Recuperação de Senha | Federação de Karatê Paulista</h1>
                    </div>
                    <form class="user" id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        @if ($errors->has('email'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('email') }}
                        </div>
                        @endif
                        @if ($errors->has('g-recaptcha-response'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('g-recaptcha-response') }}
                        </div>
                        @endif

                     

                        <div class="form-group">
                            <input required type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Insira seu endereço de e-mail" name="email">
                        </div>
                        <div class="form-group text-center d-flex justify-content-center">
                            <div class="g-recaptcha" data-sitekey="6Lf0lLspAAAAAG_zIAIxWef0YmC2ifBI7MZ87NJO"></div>
                            <input type="hidden" name="recaptcha_status" id="recaptcha_status">
                        </div>
                        <script>
                            // Função chamada quando o reCAPTCHA é preenchido corretamente
                            function onSubmit(token) {
                                document.getElementById("recaptcha_status").value = "true";
                            }

                            // Função chamada quando o reCAPTCHA expira ou é inválido
                            function onExpired() {
                                document.getElementById("recaptcha_status").value = "false";
                            }

                            // Adicione esta função para garantir que o campo recaptcha_status seja definido como "false" se o formulário for enviado sem o reCAPTCHA
                            document.addEventListener('DOMContentLoaded', function() {
                                document.getElementById("loginForm").addEventListener("submit", function() {
                                    if (document.getElementById("recaptcha_status").value !== "true") {
                                        document.getElementById("recaptcha_status").value = "false";
                                    }
                                });
                            });
                        </script>
                        
                        <button type="submit" class="btn btn-danger btn-user btn-block">
                            Enviar Nova Senha por E-mail
                        </button>
                        <hr>
                        <span class="text-muted">Desenvolvido por: <strong style="color: #B01126;">Federação de Karatê Paulista - </strong><span id="currentYear"></span></span>
                    </form>
                 

                    <script>
                        // Obtém o ano atual
                        const currentYear = new Date().getFullYear();
                        // Define o ano atual no elemento HTML com o id "currentYear"
                        document.getElementById("currentYear").textContent = currentYear;
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection