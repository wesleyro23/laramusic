<?php

namespace App\Http\Controllers\Site;

use App\Models\Painel\Album;
use App\Models\Painel\Estilo;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class SiteController extends Controller
{
    protected $album, $estilo;

    public function __construct(Album $album, Estilo $estilo)
    {
        $this->album = $album;
        $this->estilo = $estilo;
    }

    public function index()
    {
        //recupera os 4 ultimos albuns musicais
        $albuns = $this->album->take(4)->orderBy('created_at', 'DESC')->get();

        //recupera os estilos musicais
        $estilos = $this->estilo->all();
        
        return view('site.home.index', compact('albuns', 'estilos'));

    }

    public function albunsEstilo($idEstilo)
    {
        //Recupera o estilo
        $estilo = $this->estilo->find($idEstilo);

        //Recupera os albuns deste estilo musical
        $albuns = $estilo->albuns()->get();

        return view('site.estilos.albuns', compact('albuns', 'estilo'));
    }

    public function albumPesquisar(Request $request)
    {
        $palavraPesquisa = $request->get('pesquisa');
        
        //Recupera os albuns pela palavra de pesquisa
        $albuns = $this->album
            ->where('nome', 'LIKE', "%{$palavraPesquisa}%")
            ->get();

        return view('site.albuns.pesquisa', compact('albuns', 'palavraPesquisa'));
    }

    public function musicasAlbum($idAlbum)
    {
        //Recupera o album pelo di
        $album = $this->album->find($idAlbum);

        //Recupera as musicas do album
        $musicas = $album->musicas()->get();

        return view('site.albuns.musicas', compact('album','musicas'));

    }
}
