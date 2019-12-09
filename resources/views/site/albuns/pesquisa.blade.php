@extends('site.templetes.templete')

@section('content')

    <section class="estilo-selected">
        <div class="container">
            <h1 class="title">Resultado para a pesquisa: {{ $palavraPesquisa }}</h1>

            <div class="col-md-12 list-albuns">
                @forelse($albuns as $album)
                    <article class="col-md-3 albun">
                        <a href="album">
                            <div class="image-album">
                                <img src="{{ url("assets/uploads/imgs/albuns/{$album->imagem}") }}" alt="{{$album->nome}}" class="img-albun">
                                <div class="hover-img-album">
                                    <i class="fa fa-headphones" aria-hidden="true"></i>
                                </div>
                            </div>
                            <h1 class="title-albun">{{ $album->nome }}</h1>
                        </a>
                    </article>
                @empty
                    <p>Não Existem Albuns para esta pesquisa!!!</p>
                @endforelse
            </div><!-- /End list-albuns -->
        </div><!-- /End Container-->
    </section><!-- /End Section estilos -->


@endsection