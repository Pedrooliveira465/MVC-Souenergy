<?php

use Core\Controller\Main;

$router = array();

$router['index'] = [
    'rota' => '/',
    'controller' =>  "Main",
    'action' => "index"
];
$router['novo_cliente'] = [
    'rota' => '/novo-cliente',
    'controller' =>  "Main",
    'action' => "novo_cliente"
];

$router['carrinho'] = [
    'rota' => '/carrinho',
    'controller' =>  "Main",
    'action' => "carrinho"
];

$router['criar_cliente'] = [
    'rota' => '/criar-cliente',
    'controller' =>  "Main",
    'action' => "criar_cliente"
];

$router['loja'] = [
    'rota' => '/loja',
    'controller' =>  "Main",
    'action' => "loja"
];

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
foreach ($router as $rota) :
    if ($url === $rota['rota']) :
        $controlador = 'Core\\Controller\\' . ucfirst($rota['controller']);
        $metodo = $rota['action'];

        $ctr = new $controlador();
        $ctr->$metodo();
        return;
    endif;
endforeach;

$ctr = new Main();
$ctr->index();
return;
