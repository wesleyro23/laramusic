<?php

namespace App\Http\Controllers\Painel;

use App\Http\Controllers\StandardController;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends StandardController
{
    protected $model;
    protected $request;
    protected $nameView = 'painel.users';
    protected $redirectCad = '/painel/user/cadastrar';
    protected $redirectEdit = '/painel/user/editar';
    protected $route = '/painel/usuarios';


    public function __construct(User $user, Request $request)
    {
        $this->model = $user;
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

        //Criptografar a senha
        $dadosForm['password'] = bcrypt($dadosForm['password']);

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

        //Regras especiais
        $rules = [
            'name' => 'required|min:3|max:100',
            'email' => "required|email|min:3|max:100|unique:users,email,{$id}",
            'password' => 'min:3|max:20'
        ];

        $validacao = validator($dadosForm, $rules);

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

        //Criptografar a senha
        if (count($dadosForm['password']) > 0)
            $dadosForm['password'] = bcrypt($dadosForm['password']);
        else
            unset($dadosForm['password']);

        //Faz a edição do item
        $update = $item->update($dadosForm);

        //verifica se editou com sucesso
        if($update)
            return redirect($this->route);
        else
            return redirect("{$this->redirectEdit}/$id")
                ->withErrors(['errors' => 'Falha ao editar!!!'])
                ->withInput();

    }

    /*
    * Metodo de pesquisa de Estilos
    * */
    public  function pesquisar()
    {
        //Recupera a palavra de pesquisa
        $pesquisa = $this->request->get('pesquisar');

        //Filtra os dados de acordo com a palavra de pesquisa
        $data = $this->model
            ->where('name', 'LIKE', "%$pesquisa%")
            ->orWhere('email', $pesquisa)
            ->paginate(10);
        //->orWhere('idade', 'LIKE', "%$pesquisa%"); essa opção pode ser utilizada para pesquisar por varios campos
        //Mostra a view
        return view("{$this->nameView}.index", compact('data'));
    }

}
