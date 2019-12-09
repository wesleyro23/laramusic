<?php

/*
 * Gestão do Painel
 */
Route::group(['prefix' => 'painel', 'middleware' => ['auth'], 'web'], function($route){

    /*Rotas Estilos Musicais*/
    $route->get('/estilos','Painel\EstiloController@index');
    $route->get('/estilo/cadastrar','Painel\EstiloController@cadastrar');
    $route->post('/estilo/cadastrar','Painel\EstiloController@cadastrarGo');
    $route->get('/estilo/editar/{id}','Painel\EstiloController@editar');
    $route->post('estilo/editar/{id}','Painel\EstiloController@editarGo');
    $route->get('estilo/deletar/{id}','Painel\EstiloController@deletar');
    $route->post('estilo/pesquisar','Painel\EstiloController@pesquisar');

    /*Rotas Albuns*/
    $route->get('/albuns','Painel\AlbumController@index');
    $route->get('/album/cadastrar','Painel\AlbumController@cadastrar');
    $route->post('/album/cadastrar','Painel\AlbumController@cadastrarGo');
    $route->get('/album/editar/{id}','Painel\AlbumController@editar');
    $route->post('album/editar/{id}','Painel\AlbumController@editarGo');
    $route->get('album/deletar/{id}','Painel\AlbumController@deletar');
    $route->post('album/pesquisar','Painel\AlbumController@pesquisar');

    /*Rotas Músicas*/
    $route->get('/musicas','Painel\MusicaController@index');
    $route->get('/musica/cadastrar','Painel\MusicaController@cadastrar');
    $route->post('/musica/cadastrar','Painel\MusicaController@cadastrarGo');
    $route->get('/musica/editar/{id}','Painel\MusicaController@editar');
    $route->post('musica/editar/{id}','Painel\MusicaController@editarGo');
    $route->get('musica/deletar/{id}','Painel\MusicaController@deletar');
    $route->post('musica/pesquisar','Painel\MusicaController@pesquisar');

    /*Rotas de Gestão de Usuários*/
    $route->get('/usuarios','Painel\UserController@index');
    $route->get('/user/cadastrar','Painel\UserController@cadastrar');
    $route->post('/user/cadastrar','Painel\UserController@cadastrarGo');
    $route->get('/user/editar/{id}','Painel\UserController@editar');
    $route->post('user/editar/{id}','Painel\UserController@editarGo');
    $route->get('user/deletar/{id}','Painel\UserController@deletar');
    $route->post('usuarios/pesquisar','Painel\UserController@pesquisar');

    /*Rota Albuns <=> Musicas*/
    $route->get('/album/musicas/{id}', 'Painel\AlbumController@musicas');
    $route->get('/album/{id}/musicas/cadastrar', 'Painel\AlbumController@musicasCadastrar');
    $route->post('/album/{id}/musicas/cadastrar', 'Painel\AlbumController@musicasCadastrarGo');
    $route->get('/album/{idAlbum}/musica/deletar/{idMusica}', 'Painel\AlbumController@deletarMusicaAlbum');
    $route->post('/album/musicas/{id}', 'Painel\AlbumController@musicasPesquisar');
    $route->post('/album/{id}/musicas/pesquisar', 'Painel\AlbumController@pesquisarMusicaAdd');



    //Rota inicial do painel
    $route->get('/','Painel\PainelController@index');
});

//Rota de autenticação
//Route::auth();
Route::group(['middleware' => [], 'web'], function(){
    //Autentication Route
    $this->get('login', 'Auth\AuthController@showLoginForm');
    $this->post('login', 'Auth\AuthController@login');
    $this->get('logout', 'Auth\AuthController@logout');

    //Registration Route
    //$this->get('register', 'Auth\AuthController@showRegistrationForm');
    //$this->post('register', 'Auth\AuthController@register');

    //Password Reset Route
    $this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    $this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    $this->post('password/reset', 'Auth\PasswordController@reset');

});

//Mostras as musicas do album
Route::get('/album/{id}', 'Site\SiteController@musicasAlbum');

//Filtra os albuns
Route::post('/albuns/pesquisar', 'Site\SiteController@albumPesquisar');

//Listagem dos Albuns de um determinado estilo musical
Route::get('/estilo/{id}', 'Site\SiteController@albunsEstilo');



//Home Page do Laramusic
Route::get('/', 'Site\SiteController@index');

