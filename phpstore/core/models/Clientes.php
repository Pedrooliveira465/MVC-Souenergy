<?php

namespace Core\Models;

use Core\Classes\Database;
use Core\Classes\Store;

class Clientes
{

    //==========================================================
    public function verificar_email_existe($email)
    {

        //verifica se ja existe conta com esse email

        $bd = new Database();
        $params = [
            ':email' => strtolower(trim($email))
        ];
        $result = $bd->select("SELECT email FROM clientes WHERE email = :email", $params);

        if (count($result) != 0) {
            return true;
        } else {
            return false;
        }
    }

    //==========================================================

    public function registrar_cliente()
    {

        //registra o novo cliente no banco de dados
        $bd = new Database();

        //cria uma hash pro registro do cliente

    }
}
