<?php

namespace core\Controller;

use core\Classes\Store;

class main
{

    //==========================================================
    public function index()
    {
        /*
        1. Carregar e tratar dados (cálculos) e (Base de dados)
        2. Apresentar o layout (Views)
        */

        $dados = [
            'title' => APP_NAME . '     ' . APP_VERSION,

        ];

        Store::layout([
            'Layout/Html_Header',
            'Layout/Header',    //Header que contém a navegação do header
            'pagina_inicial',
            'Layout/Html_Footer',
        ], $dados);
    }

    //==========================================================
    public function loja()
    {
        echo 'lojannn';
    }

    public function carrinho()
    {
        echo 'Tetse';
    }
}
