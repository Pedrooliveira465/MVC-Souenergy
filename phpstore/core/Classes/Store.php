<?php

namespace core\Classes;

use Exception;

class Store
{
    //===================================================
    public static function layout($structure, $dados = null)
    {

        //Verifica se as estruturas é um array
        if (!is_array($structure)) {
            throw new Exception("Coleção de estruturas inválidas", 1);
        }

        //Variáveis
        if (!empty($dados) && is_array($dados)) {
            extract($dados);
        }

        //Apresnetar as views da aplicação
        foreach ($structure as $str) {
            include("../core/Views/$str.php");
        }
    }

    public static function clientelog()
    {
        //Verifica se existe um cliente com sessão iniciada
        return isset($_SESSION['cliente']);
    }
}

/*
html_header.php 
nav_bar.php
inicio.php
html_footer.php 
 */