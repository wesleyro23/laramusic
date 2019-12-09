<?php

namespace App\Http\Controllers\Painel;

use App\Models\Painel\Estilo;
use App\Models\Painel\Musica;
use Illuminate\Http\Request;
use App\Http\Controllers\StandardController;
use App\Models\Painel\Album;

class AlbumController extends StandardController
{
    protected $model;
    protected $request;
    protected $nameView = 'painel.albuns';
    protected $redirectCad = '/painel/album/cadastrar';
    protected $redirectEdit = '/painel/album/editar';
    protected $route = '/painel/albuns';


    public function __construct(Album $album, Request $request)
    {
        $this->model = $album;
        $this->request = $request;
    }

    /*
     * Lista os Itens
     * */
    public function index()
    {
        //Recuperar todos os estilos Musicais cadastrados
        //$data = $this->model->paginate($this->totalPorPagia);
        $data = $this->model
            ->join('estilos', 'estilos.id', '=', 'albuns.id_estilo')
            ->select('albuns.nome', 'albuns.id', 'estilos.nome as estilo')
            ->paginate($this->totalPorPagia);

        return view("{$this->nameView}.index", compact('data'));
    }


    /*
    * Exibe o Form de Cadastro
    * */
    public function cadastrar()
    {
        //Recupera os Estilos
        $estilos = Estilo::get();

        return view("{$this->nameView}.cad-edit", compact('estilos'));
    }

    /*
     * Executa o Cadastro
     * */
    public function cadastrarGo()
    {
        //Recupera os dados do formulario
        $dadosForm = $this->request->all();

        $validacao = validator($dadosForm, $this->model->rules, $this->model->messages);

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
        $img = $this->request->file('imagem');

        //Define o caminho
        $path = public_path('assets/uploads/imgs/albuns');

        //Define o nome da imagem
        $nameImg = date('YmdHms').'.'.$img->getClientOriginalExtension();
        $dadosForm['imagem'] = $nameImg;

        //Faz o upload da imagem
        $upload = $img->move($path, $nameImg);

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
            //return redirect($this->route);
            return redirect("/painel/album/{$insert->id}/musicas/cadastrar");
        else
            return redirect($this->redirectCad)
                ->withErrors(['errors' => 'Falha ao cadastrar!!!'])
                ->withInput();

    }

    /*
    * Exibe o form de Edição
    * */
    public function editar($id)
    {
        //Recupera os Estilos
        $estilos = Estilo::get();

        //recupera o estilo pelo id
        $data = $this->model->find($id);

        return view("{$this->nameView}.cad-edit", compact('data','estilos'));
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
        if ( $this->request->hasFile('imagem') && $this->request->file('imagem')->isValid()){

            //Recupera o campo de upload
            $img = $this->request->file('imagem');

            //Define o caminho
            $path = public_path('assets/uploads/imgs/albuns');

            //Define o nome da Imagem
            $nameImg = $item->imagem;

            //Faz o upload da Imagem
            $upload = $img->move($path, $nameImg);

            if( !$upload)
                return redirect("$this->redirectEdit/$id")
                    ->withErrors(['errors' => 'Falha ao fazer o upload']);
        }

        /*
         * Final Upload de Arquivo
         * */

        //Faz a edição do item
        $dadosForm['imagem'] = $item->imagem;
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
        //$data = $this->model->where('nome', 'LIKE', "%$pesquisa%")->paginate(10);
        //->orWhere('email', 'LIKE', "%$pesquisa%")
        //->orWhere('idade', 'LIKE', "%$pesquisa%"); essa opção pode ser utilizada para pesquisar por varios campos
        $data = $this->model
            ->join('estilos', 'estilos.id', '=', 'albuns.id_estilo')
            ->select('albuns.nome', 'albuns.id', 'estilos.nome as estilo')
            ->where('albuns.nome', 'LIKE', "%$pesquisa%")
            ->orwhere('estilos.nome', 'LIKE', "%$pesquisa%")
            ->paginate($this->totalPorPagia);

        //Mostra a view
        return view("{$this->nameView}.index", compact('data'));
    }

    /**/
    public function musicas($id)
    {
        //recuperar o album
        $album = $this->model->find($id);

        //Recupera as Musicas do ALbum
        $musicas = $album->musicas;
        return view('painel.albuns.musicas', compact('musicas', 'album'));
    }

    /**/
    public function musicasCadastrar($id, Musica $musica)
    {
        //Recupera as informações do album
        $album = $this->model->find($id);

        //Recupera as Musicas
        $musicas = $musica->whereNotIn('id', function($query) use ($id){
            $query->select('albuns_musicas.id_musica');
            $query->from('albuns_musicas');
            $query->whereRaw(" albuns_musicas.id_album = {$id} ");
        })->get();
        //->toSql();/*recpera o debug do sql*/

        //dd($musicas);

        return view('painel.albuns.album-musicas', compact('musicas', 'album'));
    }

    /**/
    public function musicasCadastrarGo($id)
    {
        //Recupera as musicas
        $musicas = $this->request->get('musicas');

        //Recupera o Album
        $album = $this->model->find($id);

        $validacao = validator($this->request->all(), $this->model->rulesAlbum_Musica);
        /*
         * Regra de validação utilizando sessao de erros com withErrors e withInput
         * necessario usa filtros web nas rotas
         * */
        if($validacao->fails()){
            return redirect("/painel/album/{$id}/musicas/cadastrar")
                ->withErrors($validacao)
                ->withInput();
        }

        //Vincula as musicas ao album
        $vincula = $album->musicas()->attach($musicas);

        return redirect("/painel/album/musicas/{$id}");

    }

    /**/
    public  function deletarMusicaAlbum($idAlbum, $idMusica)
    {
        //recupera o album pelo seu id
        $album = $this->model->find($idAlbum);

        //recupera o objeto de musicas album
        $musicas = $album->musicas()->detach($idMusica);

        return redirect("/painel/album/musicas/{$idAlbum}");
    }

    /**/
    public function musicasPesquisar($id)
    {
        //recuperar o album
        $album = $this->model->find($id);

        //Recupera as Musicas do ALbum
        $musicas = $album
            ->musicas()
            ->where('musicas.nome', 'LIKE', "%{$this->request->get('pesquisar')}%")
            ->get();

        return view('painel.albuns.musicas', compact('musicas', 'album'));

    }

    /**/
    public function pesquisarMusicaAdd($id, Musica $musica)
    {
        //Recupera as informações do album
        $album = $this->model->find($id);

        //Recupera as Musicas
        $musicas = $musica->whereNotIn('id', function($query) use ($id){
            $query->select('albuns_musicas.id_musica');
            $query->from('albuns_musicas');
            $query->whereRaw(" albuns_musicas.id_album = {$id} ");
            })
            ->where('nome', 'LIKE', "%{$this->request->get('pesquisar')}%")
            ->get();
        //->toSql();/*recpera o debug do sql*/

        //dd($musicas);

        return view('painel.albuns.album-musicas', compact('musicas', 'album'));
    }

}
