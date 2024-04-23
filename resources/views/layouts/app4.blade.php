<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <title>Área do Filiado | Federação de Karatê Paulista</title>
    <meta name="robots" content="noindex">

    <!-- Custom fonts for this template-->
    <link href="/painel/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <script src="https://cdn.tiny.cloud/1/k6gnzdpxcexp4ud7lhhog4vc143t2xml03gtshd5ke11iifa/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Custom styles for this template-->
    <link href="/painel/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .btnVoltar {
            background-color: #273746;
            color: white;
            font-weight: bold;
            padding: 15px;
            border-radius: 8px;
        }

        .btnVoltar:hover {
            text-decoration: none;
            color: white;
            font-weight: bold;

            background-color: #85929E;
        }

        .navLink-gradient {
            /* From https://css.glass */
            background: rgba(255, 255, 255, 0.08);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(2.5px);
            -webkit-backdrop-filter: blur(2.5px);
            border: 1px solid rgba(255, 255, 255, 0.44);
        }

        .navLink-gradient:hover {
            background-image: radial-gradient(circle 325px at 19.2% 64.8%, rgba(254, 62, 101, 1) 9.7%, rgba(166, 24, 146, 1) 91.3%);
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" class="">

        <!-- Sidebar -->
        <ul style="background-color: {{ Auth::check() && Auth::user()->permissao === 'admin' ? '#273746' : '#002D62' }};font-weight:bold !important;" class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center p-1" href="#">
                @if(!(Auth::check() && Auth::user()->permissao === 'admin'))

                <div class="sidebar-brand-text mx-3">
                    <img src="{{ asset('/images/logofkp2.png') }}" width="50">
                    <br>
                </div>

                @endif

            </a>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            @if(Auth::check() && Auth::user()->permissao === 'usuario')

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active text-center">
                <a class="nav-link" href="/dashboard">
                    <i style="font-size: 25px;" class="fas fa-comments"></i>
                    <br>
                    <span>Mensagens</span></a>
            </li>
            @endif
            @if(Auth::check() && Auth::user()->permissao === 'admin')
            <hr class="sidebar-divider">
            <br>
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active text-center">
                <a style="background-image: radial-gradient( circle 830px at 95.6% -5%,  rgba(244,89,128,1) 0%, rgba(223,23,55,1) 90% );" class="nav-link" href="/admin-dashboard">
                    <i style="font-size: 15px;" class="fas fa-chart-line"></i>

                    <span>Relatórios</span></a>
            </li>
            @endif
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MENU
            </div>
            <br>
            @if(Auth::check() && Auth::user()->permissao === 'admin')

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active text-center">
                <a style="" class="nav-link navLink-gradient" href="/administradores-e-moderadores">


                    <i style="color: beige;font-size: 15px;" class="fas fa-user-tie"></i>


                    <span>Administradores</span></a>
            </li>
            <br>








            @endif
            @if(Auth::check() && Auth::user()->permissao === 'usuario')

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a style="background-color:#1560bd;" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i style="color: beige;font-size: 25px;" class="fas fa-user-tag"></i>
                    <br>
                    <span>Fichas de Inscrição</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Fichas de Inscrição</h6>
                        <a class="collapse-item" href="/area-do-filiado-filiacao-de-atleta">Filiação de Atleta</a>
                        <a class="collapse-item" href="/area-do-filiado-filiacao-de-associacao">Filiação de Associação</a>
                        <a class="collapse-item" href="/area-do-filiado-renovacao-de-atleta">Renovação de Atleta</a>
                        <a class="collapse-item" href="/promocao-de-kuy">Promoção de Kyu</a>



                    </div>
                </div>
            </li>

            <br>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a style="background-color:#1E90FF" class="nav-link" href="/tabela-de-custos">
                    <i style="color: beige;font-size: 25px;" class="fas fa-fw fa-money-bill"></i>
                    <br>
                    <span>Tabela de Custos</span></a>
            </li>
            <br>
     
             <li class="nav-item">
              <a style="background-color:#5955E7" class="nav-link" href="http://competicoes.fkp.com.br/login/<?php echo Auth::user()->id + 1; ?>">
    <i style="color: beige;font-size: 25px;" class="fas fa-trophy"></i>
    <br>
    <span>Competições</span>
</a>
  
   

            </li>

           
            @endif

            @if(Auth::check() && Auth::user()->permissao === 'admin')

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a style="" class="nav-link collapsed navLink-gradient" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i style="color: beige;font-size: 15px;" class="fas fa-user-tag"></i>

                    <span>Área do Filiado</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu</h6>
                        <a class="collapse-item" href="/filiados">Filiados</a>
                        <a class="collapse-item" href="/publica-mensagem">Mensagens</a>
                        <a class="collapse-item" href="/filiacao-de-atletas">Filiação de Atletas</a>
                        <a class="collapse-item" href="/filiacao-de-associacao">Filiação de Associação</a>

                        <a class="collapse-item" href="/renovacao-de-atleta">Renovação de Atletas</a>
                        <a class="collapse-item" href="/inscricoes-para-promocao-de-kyu">Promoção de Kyu</a>




                    </div>
                </div>
            </li>
            @endif
            @if(Auth::check() && Auth::user()->permissao === 'admin')
            <br>
            <li class="nav-item">
                <a style="" class="nav-link navLink-gradient" href="#">

                    <i style="color: beige;font-size: 15px;" class="fas fa-newspaper"></i>

                    <span>Notícias</span></a>
            </li>
            <br>
            <li class="nav-item">
                <a style="" class="nav-link navLink-gradient" href="#">
                    <i style="color: beige;font-size: 15px;" class="far fa-calendar-alt"></i>

                    <span>Eventos</span></a>
            </li>
            <br>
            <li class="nav-item">
                <a style="" class="nav-link navLink-gradient" href="#">

                    <i style="color: beige;font-size: 15px;" class="fas fa-poll-h"></i>

                    <span>Resultados</span></a>
            </li>
            <br>
            <li class="nav-item">
                <a style="" class="nav-link navLink-gradient" href="#">

                    <i style="color: beige;font-size: 15px;" class="fas fa-images"></i>

                    <span>Galeria</span></a>
            </li>
            <br>
            <li class="nav-item">
                <a style="" class="nav-link navLink-gradient" href="#">

                    <i style="color: beige;font-size: 15px;" class="far fa-star"></i>

                    <span>Destaques</span></a>
            </li>
            <br>
            <li class="nav-item">
                <a style="" class="nav-link navLink-gradient" href="#">

                    <i style="color: beige;font-size: 15px;" class="fas fa-bullhorn"></i>
                    <span>Publicidade</span></a>
            </li>
            <br>
            <li class="nav-item">
                <a style="" class="nav-link navLink-gradient" href="/inscritos-newsletter">

                    <i style="color: beige;font-size: 15px;" class="fas fa-rss"></i>

                    <span>Newsletter</span></a>
            </li>
            @endif



            <!-- Divider -->
            <hr class="sidebar-divider">








            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">








                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> Bem-vindo: <strong>
                                        @if(Auth::check() && Auth::user()->permissao === 'admin')
                                        <i style="color: #FFC72C;" class="fas fa-crown"></i>

                                        @endif
                                        {{ Auth::user()->NomeUsuario }}
                                    </strong>
                                </span>
                                @php
                                $imgSrc = Auth::check() && Auth::user()->permissao === 'admin' ? '/images/logofkp2.png' : 'https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png';
                                @endphp

                                <img class="img-profile rounded-circle" src="{{ $imgSrc }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                @if(Auth::check() && Auth::user()->permissao === 'admin')
                                <a class="dropdown-item" href="{{ route('edit-administrador', Auth::user()->id) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Editar Perfil
                                </a>

                                @endif
                                @if(Auth::check() && Auth::user()->permissao === 'usuario')
                                <a class="dropdown-item" href="{{ route('edit-filiado', Auth::user()->id) }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Editar Perfil 
                                </a>
                                @endif

                              


                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/loggout" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"></h1>

                    </div>

                    <!-- Content Row -->
                    <div class="row d-flex justify-content-center">

                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->



            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja sair?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Selecione "Sair" abaixo se estiver pronto para encerrar sua sessão atual.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                        <a class="btn btn-danger" href="{{route('logout')}}">Sair</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="/painel/vendor/jquery/jquery.min.js"></script>
        <script src="/painel/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="/painel/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="/painel/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="/painel/vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="/painel/js/demo/chart-area-demo.js"></script>
        <script src="/painel/js/demo/chart-pie-demo.js"></script>

        <script>
            function imprimirVersaoImpressa() {
                // Obtém o conteúdo da tabela e do lembrete
                var tabelaCustos = document.getElementById('tabelaCustos').outerHTML;
                var lembrete = document.getElementById('lembrete').outerHTML;

                // Cria uma janela temporária para impressão
                var janelaImpressao = window.open('', '', 'width=800,height=600');

                // Adiciona o estilo para formatação na versão impressa
                var style = '<style type="text/css">';
                style += '@media print {';
                style += 'body { font-family: Arial, sans-serif; }';
                style += '.header { font-weight: bold; text-transform: uppercase; }';
                style += '}';
                style += '</style>';

                // Escreve o conteúdo da tabela, do lembrete e o estilo na janela de impressão
                janelaImpressao.document.write('<html><head><title>Versão Impressa</title>' + style + '</head><body>');
                janelaImpressao.document.write('<div class="header">FKP</div>');
                janelaImpressao.document.write('<div class="header">FEDERAÇÃO DE KARATÊ PAULISTA - CNPJ. 02.959.715/0001-00</div>');
                janelaImpressao.document.write('<div class="header">FILIADA A FBK</div>');
                janelaImpressao.document.write('<div class="header">www.fkp.com.br - karate@fkp.com.br - Fone: (17) 3353-2248 - Fax: (17) 3353-2249</div>');
                janelaImpressao.document.write('<div class="header">Tabela de custos 2011</div>');
                janelaImpressao.document.write(tabelaCustos);
                janelaImpressao.document.write(lembrete);
                janelaImpressao.document.write('</body></html>');

                // Imprime a janela de impressão
                janelaImpressao.print();

                // Fecha a janela de impressão após a impressão
                janelaImpressao.close();
            }
        </script>

</body>

</html>