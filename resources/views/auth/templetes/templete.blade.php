<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo or 'Login LaraMusic' }}</title>

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
<div class="login">
    <div class="login-header">
        <img src="{{ url('assets/painel/imgs/laramusic-branca.png') }}" alt="LaraMusic" class="logo-login">
    </div>

    @yield('content')
</div>
<!-- /.login -->
<!-- Bootstrap Js -->
<script src="./js/bootstrap.min.js"></script>
</body>
</html>