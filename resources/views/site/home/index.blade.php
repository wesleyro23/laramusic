@extends('site.templetes.templete')

@section('content')

    <section class="albuns">
        <div class="container">
            <h1 class="title">
                Últimos Albúns:
            </h1>
            <div class="col-md-12 list-albuns">
                @forelse($albuns as $album)
                    <article class="col-md-3 albun">
                        <a href="/album/{{$album->id}}">
                            <div class="image-album">
                                <img src="{{ url("assets/uploads/imgs/albuns/{$album->imagem}") }}" alt="{{$album->nome}}" class="img-albun">
                                <div class="hover-img-album">
                                    <i class="fa fa-headphones" aria-hidden="true"></i>
                                </div>
                            </div>
                            <h1 class="title-albun">{{$album->nome}}</h1>
                        </a>
                    </article>
                @empty
                    <div class="col-md-12 list-albuns">
                        <p>Não existem albuns cadastrados</p>
                    </div>
                @endforelse
            </div><!-- /End list-albuns -->
        </div><!-- /End Container-->
    </section><!-- /End Section Albuns -->

    <div class="clear"></div>

    <hr class="hr">

    <section class="estilos">
        <div class="container">
            <h1 class="title">
                Estilos:
            </h1>
            <div class="col-md-12 estilos-mu">
                @forelse($estilos as $estilo)
                    <a href="{{ url("/estilo/{$estilo->id}") }}" class="estilo">{{ $estilo->nome }}</a>
                @empty
                    <p>Não existem estilos cadastrados!!!</p>
                @endforelse
            </div><!-- /End estilos-mu -->
        </div><!-- /End Container-->
    </section><!-- /End Section estilos -->

@endsection