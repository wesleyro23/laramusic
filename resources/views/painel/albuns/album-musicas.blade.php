@extends('painel.templetes.templete')

@section('content')

    <!-- Actions -->
    <div class="actions">
        <div class="container">
            <form class="form form-inline form-search" method="post" action="/painel/album/{{$album->id}}/musicas/pesquisar">

                {{ csrf_field() }}

                <input type="text" name="pesquisar" placeholder="Pesquisar" class="form-control">
                <input type="submit" value="Encontrar" class="btn btn-danger">
            </form>
        </div>
    </div>

    <div class="clear"></div>

    <div class="container">
        <h1 class="titulo">
            Adicionar novas Musicas ao Album <b>{{$album->nome}}</b>
        </h1>

        @if( isset($errors) && count($errors) > 0 )
            <div class="alert alert-danger">
                @foreach( $errors->all() as $error )
                    {{ $error }} <br>
                @endforeach
            </div>
        @endif

        <form class="form" method="POST" action="/painel/album/{{$album->id}}/musicas/cadastrar" enctype="multipart/form-data">

            {{ csrf_field() }}

            @foreach( $musicas as $musica)
            <div class="form-group">
                <label>
                    <input type="checkbox" name="musicas[]" value="{{ $musica->id }}"> {{ $musica->nome }}
                </label>
            </div>
            @endforeach
            <div class="form-group">
                <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
            </div>
        </form>
    </div><!-- /End Container-->


@endsection