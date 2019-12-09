@extends('painel.templetes.templete')

@section('content')

    <!-- Actions -->
    <div class="actions">
        <div class="container">
            <a class="add" href="{{ url('painel/musica/cadastrar') }}">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </a>
            <form class="form form-inline form-search" method="post" action="/painel/musica/pesquisar">

                {{ csrf_field() }}

                <input type="text" name="pesquisar" placeholder="Pesquisar" class="form-control">
                <input type="submit" value="Encontrar" class="btn btn-danger">
            </form>
        </div>
    </div>

    <div class="clear"></div>


    <div class="container">
        <h1 class="titulo">Listagem das Músicas</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse( $data as $musica)
                    <tr>
                        <td>{{ $musica->id }}</td>
                        <td>{{ $musica->nome }}</td>
                        <td>
                            <a href="{{ url("/painel/musica/editar/$musica->id") }}" class="edit">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url("/painel/musica/deletar/$musica->id") }}" class="delete">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="90">Não Existem Músicas Cadastradas</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        <nav>
            {{ $data->links() }}
        </nav>
    </div>

@endsection

