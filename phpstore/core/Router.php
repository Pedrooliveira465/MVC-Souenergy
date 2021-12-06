<?php

//|Coleção de rotas

$router = [
    'inicio' => 'main@index',
    'loja' => 'main@loja',
    'carrinho' => 'main@carrinho',

    //cliente
    'novo_cliente' => 'main@novo_cliente',
    'criar_cliente' => 'main@criar_cliente',
];

//Define ação por defeito(Ação padrão, se nenhum endereço for passado vai cair na página inicio)
$acao = 'inicio';

//Verifica se existe ação na query string
if (isset($_GET['a'])) {
    //Veriica se a ação existe nas rotas
    if (!key_exists($_GET['a'], $router)) {
        $acao = 'inicio';
    } else {
        $acao = $_GET['a'];
    }
}
//Tratamento de definição de rotas
$partes = explode('@', $router[$acao]);
$controlador = 'core\\Controller\\' . ucfirst($partes[0]);
$metodo = $partes[1];

$ctr = new $controlador();
$ctr->$metodo();
