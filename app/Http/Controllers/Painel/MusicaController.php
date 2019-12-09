<?php

namespace App\Http\Controllers\Painel;

use App\Models\Painel\Musica;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\StandardController;

class MusicaController extends StandardController
{
    protected $model;
    protected $request;
    protected $nameView = 'painel.musicas';
    protected $redirectCad = '/painel/musica/cadastrar';
    protected $redirectEdit = '/painel/musica/editar';
    protected $route = '/painel/musicas';


    public function __construct(Musica $musica, Request $request)
    {
        $this->model = $musica;
        $this->request = $request;
    }

    /*
     * Executa o Cadastro
     * */
    public function cadastrarGo()
    {
        //Recupera os dados do formulario
        $dadosForm = $this->request->all();

        $validacao = validator($dadosForm, $this->model->rules);

        /*
         * Regra de validação utilizando sessao de erros com withErrors e withInput
         * necessario usa filtros web nas rotas
         * */
        if($validacao->fails()){
            return redirect($this->redirectCad)
                ->withErrors($validacao)
                ->withInput();
        }

        /*
         * Upload de arquivo
         * */
        //Recupera o campo de upload
        $musica = $this->request->file('arquivo');

        //Define o caminho
        $path = public_path('assets/uploads/musics');

        //Define o nome da Musica
        $nameMusic = date('YmdHms').'.'.$musica->getClientOriginalExtension();
        $dadosForm['arquivo'] = $nameMusic;

        //Faz o upload da musica
        $upload = $musica->move($path, $nameMusic);

        if( !$upload)
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Falha ao fazer o upload']);

        /*
         * Final Upload de Arquivo
         * */


        //Faz o insert
        $insert = $this->model->create($dadosForm);

        //verifica se insert funcionou
        if($insert)
            return redirect($this->route);
        else
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Falha ao cadastrar!!!'])
                ->withInput();

    }

    /*
    * Editando o item
    * */
    public function editarGo($id)
    {
        //Recupera os dados do formulario em forma de array
        $dadosForm = $this->request->all();

        $validacao = validator($dadosForm, $this->model->rulesEdit);
        /*
         * Regra de validação utilizando sessao de erros com withErrors e withInput
         * necessario usa filtros web nas rotas
         * */
        if($validacao->fails()){
            return redirect("{$this->redirectEdit}/$id")
                ->withErrors($validacao)
                ->withInput();
        }

        //Recupera o item pelo id
        $item = $this->model->find($id);

        /*
         * Upload de arquivo
         * */

        //Se existe o arquivo para o upload
        if ( $this->request->hasFile('arquivo') && $this->request->file('arquivo')->isValid()){

            //Recupera o campo de upload
            $musica = $this->request->file('arquivo');

            //Define o caminho
            $path = public_path('assets/uploads/musics');

            //Define o nome da Musica
            $nameMusic = $item->arquivo;

            //Faz o upload da musica
            $upload = $musica->move($path, $nameMusic);

            if( !$upload)
                return redirect("$this->redirectEdit/$id")
                    ->withErrors(['errors' => 'Falha ao fazer o upload']);
        }

        /*
         * Final Upload de Arquivo
         * */

        //Faz a edição do item
        $dadosForm['arquivo'] = $item->arquivo;
        $update = $item->update($dadosForm);

        //verifica se editou com sucesso
        if($update)
            return redirect($this->route);
        else
            return redirect("{$this->redirectEdit}/$id")
                ->withErrors(['errors' => 'Falha ao editar!!!'])
                ->withInput();

    }

}
