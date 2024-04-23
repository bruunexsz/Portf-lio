<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistema de Competições</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body style="background-color: royalblue;" class="d-flex justify-content-center align-items-center vh-100"> <!-- Adicionando classes para centralizar vertical e horizontalmente -->


    <div class="container-fluid">
        <div class="row justify-content-center">

            <div style="background-color: #FFFFFF;" class="col-12 col-md-10 d-block justify-content-center p-5">
                <a class="btn btn-lg btn-outline-danger" href="http://www.fkp.com.br/login">VOLTAR</a>
                <br>
                <br>
                <form class="w-100" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h3 class="text-muted">Sistema de Competição</h3>
                    <hr>
                    <br>
                    @if($errors->has('g-recaptcha-response'))
    <div class="alert alert-danger">{{ $errors->first('g-recaptcha-response') }}</div>
@endif

                    <!-- Campo de Email -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example3">Endereço de e-mail</label>
                        <input type="email" id="form3Example3" class="form-control form-control-lg" name="email" placeholder="Digite um endereço de e-mail válido" />
                    </div>

                    <!-- Campo de Senha -->
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Senha</label>
                        <input type="password" id="form3Example4" class="form-control form-control-lg" name="password" placeholder="Digite a senha" />
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Checkbox -->
                        <div class="form-check mb-0 d-none">
                            <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                            <label class="form-check-label" for="form2Example3">
                                Lembrar minhas credenciais
                            </label>
                        </div>


                    </div>
                    <div class="form-outline mb-3 d-flex justify-content-center">
                        <div class="g-recaptcha" data-sitekey="6Lf0lLspAAAAAG_zIAIxWef0YmC2ifBI7MZ87NJO"></div>
                    </div>

                    <!-- Botão de Login -->
                    <div class="text-center text-lg-start mt-4 pt-2">
                        <button type="submit" class="btn btn-lg w-100" style="padding-left: 2.5rem; padding-right: 2.5rem;background-color:royalblue;color:white">Login</button>
                    </div>
                    @if(session('error'))
                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                    @endif
                </form>

            </div>
        </div>
    </div>


</body>

</html>