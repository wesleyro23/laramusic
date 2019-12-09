<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>{{$titulo or 'LaraMusic'}}</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/assets/all/css/bootstrap.min.css') }}">
    <!-- Fonts Icons CSS -->
    <link rel="stylesheet" href="{{ url('assets/all/css/font-awesome.min.css') }}">
    <!-- Custom -->
    <link rel="stylesheet" href="{{ url('assets/site/css/custom.css') }}">
    <!-- Resets-->
    <link rel="stylesheet" href="{{ url('assets/site/css/resets.css') }}">
    <!-- Fav Icon -->
    <link rel="icon" type="image/png" href="{{ url('assets/all/imgs/favicon-laramusic.png') }}">
    <!-- JQuery Js -->
    <script src="{{ url('assets/all/js/jquery-2.2.4.min.js') }}"></script>

    <!-- JPlayer -->
    <link rel="stylesheet" href="{{ url('assets/site/dist/skin/blue.monday/css/jplayer.blue.monday.min.css') }}">
    <script src="{{ url('assets/site/dist/jplayer/jquery.jplayer.min.js') }}"></script>
    <script src="{{ url('assets/site/dist/add-on/jplayer.playlist.min.js') }}"></script>

    @stack('scripts-header')
</head>
<body>

<header class="header">
    <div class="container">
        <div class="col-md-3">
            <a href="{{ url('/') }}">
                <img class="img-logo" src="{{ url('assets/site/imgs/laramusic.png') }}" alt="Laramusic" title="Laramusic">
            </a>
        </div>
        <div class="col-md-7">
            <form class="form-search input-group " method="post" action="/albuns/pesquisar">
                {{ csrf_field() }}
                <input type="text" class="form-control" name="pesquisa" placeholder="Pesquisar Albúns">
                            <span class="input-group-btn">
                                <button class="btn btn-default btn-search" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </span>
            </form><!-- /input-group -->
        </div>
        <div class="col-md-2">
            <a href="{{ url('/login') }}" class="login">Entrar</a>
        </div>
    </div><!-- /End Container -->
</header><!-- /End Header-->

<div class="clear"></div>

<hr class="hr">

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

@stack('scripts-footer')
</body>
</html>