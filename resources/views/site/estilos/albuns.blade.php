@extends('site.templetes.templete')

@section('content')

    <section class="estilo-selected">
        <div class="container">
            <h1 class="title">{{ $estilo->nome }}</h1>

            <div class="col-md-12 list-albuns">
                @forelse($albuns as $album)
                <article class="col-md-3 albun">
                    <a href="{{ url("/album/{$album->id}") }}">
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
                    <p>Não Existem Albuns para este estilo músical!!!</p>
                @endforelse
            </div><!-- /End list-albuns -->
        </div><!-- /End Container-->
    </section><!-- /End Section estilos -->


@endsection