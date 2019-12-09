<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Musica extends Model
{
    protected $fillable = ['nome', 'arquivo'];

    //Regras de validação sempre dentro do model
    public $rules = [
        'nome' => 'required|min:3|max:100',
        'arquivo' => 'required|max:60000|mimeTypes:aidio/mp3,audio/mpeg,mp3'
    ];

    //Regras de validação sempre dentro do model
    public $rulesEdit = [
        'nome' => 'required|min:3|max:100',
        'arquivo' => 'max:60000|mimeTypes:aidio/mp3,audio/mpeg,mp3'
    ];
}
