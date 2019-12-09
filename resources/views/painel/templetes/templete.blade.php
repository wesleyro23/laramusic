<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo or 'Painel LaraMusic' }}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('assets/all/css/bootstrap.min.css') }}">
    <!-- Fonts Icons CSS -->
    <link rel="stylesheet" href="{{ url('assets/all/css/font-awesome.min.css') }}">
    <!-- Custom -->
    <link rel="stylesheet" href="{{ url('assets/painel/css/custom.css') }}">
    <!-- Fav Icon -->
    <link rel="icon" type="image/png" href="{{ url('assets/all/imgs/favicon-laramusic.png') }}">
    <!-- JQuery Js -->
    <script src="{{ url('assets/all/js/jquery-2.2.4.min.js') }}"></script>

</head>
<body>

    <div class="menu">
        <ul class="menu col-md-12">
            <li class="col-md-2 text-center">
                <a href="{{ url('/painel') }}">
                    <img src="{{ url('assets/painel/imgs/laramusic-branca.png') }}" alt="LaraMusic" class="logo">
                </a>
            </li>
            <li class="col-md-2 text-center">
                <a href="{{ url('/painel/estilos') }}">
                    <img src="{{ url('assets/painel/imgs/estilos-laramusic.png') }}" alt="Estilos" class="img-menu">
                    <h1>Estilos</h1>
                </a>
            </li>
            <li class="col-md-2 text-center">
                <a href="{{ url('/painel/albuns') }}">
                    <img src="{{ url('assets/painel/imgs/albuns-laramusic.png') }}" alt="Albuns" class="img-menu">
                    <h1>Albuns</h1>
                </a>
            </li>
            <li class="col-md-2 text-center">
                <a href="{{ url('/painel/musicas') }}">
                    <img src="{{ url('assets/painel/imgs/music-laramusic.png') }}" alt="Músicas" class="img-menu">
                    <h1>Músicas</h1>
                </a>
            </li>
            <li class="col-md-2 text-center">
                <a href="{{ url('/painel/usuarios') }}">
                    <img src="{{ url('assets/painel/imgs/perfil-laramusic.png') }}" alt="Uauários" class="img-menu">
                    <h1>Usuários</h1>
                </a>
            </li>
            <li class="col-md-2 text-center">
                <a href="{{ url('/logout') }}">
                    <img src="{{ url('assets/painel/imgs/sair-laramusic.png') }}" alt="Sair" class="img-menu">
                    <h1>Sair</h1>
                </a>
            </li>
        </ul>
    </div><!-- /End Menu-->

    <div class="clear"></div>

    <!-- Content  Dinâmico-->
    @yield('content')

    <div class="clear"></div>

    <footer class="footer">
        <div class="container text-center">
            <p class="text-footer">© All rights reserved | Desenvolvido por RWX Dev</p>

            <div class="social">
                <a href="#">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
                <a href="#">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
            </div>
        </div><!-- /End container-->
    </footer><!-- /End footer-->



    <!-- Bootstrap Js -->
    <script src="{{ url('assets/all/js/bootstrap.min.js') }}"></script>
</body>
</html>