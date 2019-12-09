@extends('painel.templetes.templete')

@section('content')

    <div class="container">
        <h1 class="titulo">
            Gestão de Album
        </h1>

        @if( isset($errors) && count($errors) > 0 )
            <div class="alert alert-danger">
                @foreach( $errors->all() as $error )
                    {{ $error }} <br>
                @endforeach
            </div>
        @endif

        @if( isset($data))
            <form class="form" method="POST" action="/painel/album/editar/{{ $data->id }}" enctype="multipart/form-data">
        @else
            <form class="form" method="POST" action="/painel/album/cadastrar" enctype="multipart/form-data">
        @endif

            {{ csrf_field() }}

            <div class="form-group">
                <select name="id_estilo" class="form-control">
                    <option value="">Escolha o Estilo</option>
                    @foreach( $estilos as $estilo)
                        <option value="{{ $estilo->id }}"
                            {{-- Verifica se existe um estilo e se exitir seleciona--}}
                            @if( isset($data->id_estilo) && $data->id_estilo == $estilo->id )
                                selected
                            @endif
                        >{{ $estilo->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="nome" placeholder="Insira o Nome do Album" class="form-control" value="{{ $data->nome or old('nome') }}">
            </div>
                <div class="form-group">
                    <input type="file" name="imagem" class="form-control">
                </div>
            <div class="form-group">
                <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
            </div>
        </form>
    </div><!-- /End Container-->


@endsection