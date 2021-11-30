<?php
/*
    //|Coleção de rotas

    $router = [
        'inicio' => 'main@index',
        'loja' => 'main@loja'
    ];

    //Define ação por defeito
    $acao = 'inicio';

    //Verifica se existe ação na query string
    if (isset($_GET['a'])) {
        //Veriica se a ação existe nas rotas
        if (!key_exists($router, $_GET['a'])) {
            $acao = 'inicio';
        } else {
            $acao = $_GET['a'];
        }
    }

    //Traatamento de definição de rotas
    $partes = explode('@', $router[$acao]);

    var_dump($partes);
