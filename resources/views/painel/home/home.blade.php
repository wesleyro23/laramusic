@extends('painel.templetes.templete')

@section('content')
    <div class="relatorios">
        <div class="container">
            <ul class="relatorios">
                <li class="col-md-6 text-center">
                    <a href="{{ url('/painel/estilos') }}">
                        <img src="{{ url('assets/painel/imgs/estilos-laramusic.png') }}" alt="Estilos" class="img-menu">
                        <h1>{{ $estilos }}</h1>
                    </a>
                </li>
                <li class="col-md-6 text-center">
                    <a href="{{ url('/painel/albuns') }}">
                        <img src="{{ url('assets/painel/imgs/albuns-laramusic.png') }}" alt="Albuns" class="img-menu">
                        <h1>{{ $albuns }}</h1>
                    </a>
                </li>
                <li class="col-md-6 text-center">
                    <a href="{{ url('/painel/musicas') }}">
                        <img src="{{ url('assets/painel/imgs/music-laramusic.png') }}" alt="Músicas" class="img-menu">
                        <h1>{{ $musicas }}</h1>
                    </a>
                </li>
                <li class="col-md-6 text-center">
                    <a href="{{ url('/painel/usuarios') }}">
                        <img src="{{ url('assets/painel/imgs/perfil-laramusic.png') }}" alt="Usuários" class="img-menu">
                        <h1>{{ $users }}</h1>
                    </a>
                </li>
            </ul><!-- /End Relatorios-->

        </div>
    </div>

@endsection