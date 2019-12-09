@extends('painel.templetes.templete')

@section('content')

    <div class="container">
        <h1 class="titulo">
            Gestão de Usuários
        </h1>

        @if( isset($errors) && count($errors) > 0 )
            <div class="alert alert-danger">
                @foreach( $errors->all() as $error )
                    {{ $error }} <br>
                @endforeach
            </div>
        @endif

        @if( isset($data))
            <form class="form" method="POST" action="/painel/user/editar/{{ $data->id }}">
        @else
            <form class="form" method="POST" action="/painel/user/cadastrar">
        @endif

            {{ csrf_field() }}

            <div class="form-group">
                <input type="text" name="name" placeholder="Insira o Nome do Usuário" class="form-control" value="{{ $data->name or old('name') }}">
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Insira o Email do Usuário" class="form-control" value="{{ $data->email or old('email') }}">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Insira o Password do Usuário" class="form-control" value="{{old('password') }}">
            </div>
            <div class="form-group">
                <input type="submit" name="enviar" value="Enviar" class="btn btn-success">
            </div>
        </form>
    </div><!-- /End Container-->


@endsection