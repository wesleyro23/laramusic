@extends('painel.templetes.templete')

@section('content')

    <!-- Actions -->
    <div class="actions">
        <div class="container">
            <a class="add" href="{{ url('painel/estilo/cadastrar') }}">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </a>
            <form class="form form-inline form-search" method="post" action="/painel/estilo/pesquisar">

                {{ csrf_field() }}

                <input type="text" name="pesquisar" placeholder="Pesquisar" class="form-control">
                <input type="submit" value="Encontrar" class="btn btn-danger">
            </form>
        </div>
    </div>

    <div class="clear"></div>


    <div class="container">
        <h1 class="titulo">Listagem dos Estilos Musicais</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse( $data as $estilo )
                    <tr>
                        <td>{{ $estilo->id }}</td>
                        <td>{{ $estilo->nome }}</td>
                        <td>
                            <a href="{{ url("/painel/estilo/editar/$estilo->id") }}" class="edit">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url("/painel/estilo/deletar/$estilo->id") }}" class="delete">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="90">Não Existem Estilos Músicais Cadastrados</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        <nav>
            {{ $data->links() }}
        </nav>
    </div>

@endsection

