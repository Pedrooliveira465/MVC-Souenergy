<?php

namespace Core\Classes;

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

    public static function criarhash($num_caracter = 12)
    {
        //criar hash
        $chars = '01234567890123456789abcdefghijklmnopqrstuvxwyzabcdefghijklmnopqrstuvxwyzABCDEFGHIJKLMNOPQRSTUVXWYZABCDEFGHIJKLMNOPQRSTUVXWYZ';
        return substr(str_shuffle($chars), 0, $num_caracter);
    }
}
