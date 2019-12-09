<?php

namespace App\Http\Controllers\Painel;

use App\Models\Painel\Album;
use App\Models\Painel\Estilo;
use App\Models\Painel\Musica;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PainelController extends Controller
{
    protected $estilo, $album, $musica, $user;

    public function __construct(Estilo $est, Album $alb, Musica $mus, User $us)
    {
        $this->estilo = $est;
        $this->album  = $alb;
        $this->musica = $mus;
        $this->user   = $us;
    }

    public function index()
    {
        //Recupera o total de cada item cadastrado
        $estilos = $this->estilo->count();
        $albuns = $this->album->count();
        $musicas = $this->musica->count();
        $users = $this->user->count();

        return view('painel.home.home', compact('estilos', 'albuns', 'musicas', 'users'));
    }
}
