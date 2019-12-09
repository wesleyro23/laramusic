<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albuns';

    protected $fillable = [
        'id_estilo',
        'nome',
        'imagem'
    ];

    public $messages =
       [
            'nome.required'=>'Preencha um nome'

        ];
    

    //Regras de validação sempre dentro do model
    public $rules = [
        'id_estilo' => 'required',
        'nome' => 'required|min:3|max:100',
        'imagem' => 'required|image|max:4000|mimes:jpg,png,jpeg',
    ];

    //Regras de validação sempre dentro do model
    public $rulesEdit = [
        'id_estilo' => 'required',
        'nome' => 'required|min:3|max:100',
        'imagem' => 'image|max:4000|mimes:jpg,png,jpeg',
    ];

    public $rulesAlbum_Musica = [
        'musicas' => 'required',
    ];

    public function musicas()
    {
        return $this->belongsToMany('App\Models\Painel\Musica','albuns_musicas', 'id_album', 'id_musica');
    }

}
