<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Estilo extends Model
{
    protected $fillable = ['nome'];

    //Regras de validação sempre dentro do model
    public $rules = [
        'nome' => 'required|min:3|max:100'
    ];

    public function albuns()
    {
        return $this->hasMany('App\Models\Painel\Album', 'id_estilo');
    }
}
