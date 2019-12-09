@extends('painel.templetes.templete')

@section('content')

    <!-- Actions -->
    <div class="actions">
        <div class="container">
            <a class="add" href="{{ url("painel/album/{$album->id}/musicas/cadastrar") }}">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </a>
            <form class="form form-inline form-search" method="post" action="/painel/album/musicas/{{$album->id}}">

                {{ csrf_field() }}

                <input type="text" name="pesquisar" placeholder="Pesquisar" class="form-control">
                <input type="submit" value="Encontrar" class="btn btn-danger">
            </form>
        </div>
    </div>

    <div class="clear"></div>


    <div class="container">
        <h1 class="titulo">Listagem das Musicas do Album <b>{{$album->nome}}</b></h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th width="200px">Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse( $musicas as $musica )
                    <tr>
                        <td>{{ $musica->id }}</td>
                        <td>{{ $musica->nome }}</td>
                        <td>
                            <a href="{{ url("/painel/album/$album->id/musica/deletar/$musica->id") }}" class="delete">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="90">Não Existem Musicas neste Album</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

@endsection

