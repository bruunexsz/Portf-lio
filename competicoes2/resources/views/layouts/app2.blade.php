<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Aplicação</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- DataTables Bootstrap 5 Integration CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- Bootstrap Bundle (incluindo Popper.js) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables Core JavaScript -->
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

    <!-- DataTables Bootstrap 5 Integration JavaScript -->
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>

    <script>
        new DataTable('#example');
    </script>
    <!-- Bootstrap CSS -->
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: royalblue;color:white !important;font-weight:bold">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand d-block text-center" href="/">
 Sistema de Sorteios</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/equipes">Equipes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/atletas">Atletas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/competicoes">Competições</a>
                    </li>
                    @if(auth()->user()->roles()->where('name', 'Admin')->exists())
                    <li class="nav-item">
                        <a class="nav-link" href="/instituicoes">Instituições</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/categorias">Categorias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/faixas">Faixas</a>
                    </li>
                    <li class="nav-item">

                        <a class="nav-link" href="/usuarios">Usuários</a>

                    </li>
                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button style="background-color:#5D6D7E;color:white;" type="submit" class="btn btn-link nav-link p-2">Sair <i class="bi bi-box-arrow-in-right"></i></button>
                    </form>



                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div style="" class="col-12 d-flex justify-content-start align-items-center mt-5 mb-5 p-4">

                @yield('content')
            </div>


        </div>
    </div>
    <script>
        new DataTable('#example');
        $(document).ready(function() {
            // Encontra a div com a classe dt-search e busca o elemento label dentro dela
            $('.dt-search label').text('Buscar:');
            $('label[for="dt-length-0"]').text('resultados por página');


        });
    </script>
    <script>
    $(document).ready(function() {
        $('#example2').DataTable({
            "order": [[0, "desc"]] // Ordena pela primeira coluna (Código) em ordem decrescente
        });
        // Tradução dos textos
        $('.dt-search label').text('Buscar:');
        $('label[for="dt-length-0"]').text('resultados por página');
    });
</script>
</body>

</html>