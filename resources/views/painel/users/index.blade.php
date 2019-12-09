@extends('painel.templetes.templete')

@section('content')

    <!-- Actions -->
    <div class="actions">
        <div class="container">
            <a class="add" href="{{ url('painel/user/cadastrar') }}">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </a>
            <form class="form form-inline form-search" method="post" action="/painel/usuarios/pesquisar">

                {{ csrf_field() }}

                <input type="text" name="pesquisar" placeholder="Pesquisar" class="form-control">
                <input type="submit" value="Encontrar" class="btn btn-danger">
            </form>
        </div>
    </div>

    <div class="clear"></div>


    <div class="container">
        <h1 class="titulo">Listagem dos Usuários</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse( $data as $user )
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ url("/painel/user/editar/$user->id") }}" class="edit">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url("/painel/user/deletar/$user->id") }}" class="delete">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="90">Não Existem Usuários Cadastrados</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        <nav>
            {{ $data->links() }}
        </nav>
    </div>

@endsection

