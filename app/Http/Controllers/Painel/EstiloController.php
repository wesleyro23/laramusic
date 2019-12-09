<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\Models\Painel\Estilo;
use Illuminate\Http\Request;

use App\Http\Requests;

class EstiloController extends StandardController
{
    protected $model;
    protected $request;
    protected $nameView = 'painel.estilos';
    protected $redirectCad = '/painel/estilo/cadastrar';
    protected $redirectEdit = '/painel/estilo/editar';
    protected $route = '/painel/estilos';


    public function __construct(Estilo $estilo, Request $request)
    {
        $this->model = $estilo;
        $this->request = $request;
    }
}
