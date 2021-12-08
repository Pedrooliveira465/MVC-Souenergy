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
        $purl = Store::criarhash();

        //parametros
        $params = [
            ':email' => strtolower(trim($_POST['text_email'])),
            ':senha' => password_hash(trim($_POST['text_senha_1']), PASSWORD_DEFAULT),
            ':nome_completo' => (trim($_POST['nome_completo'])),
            ':morada' => (trim($_POST['text_morada'])),
            ':cidade' => (trim($_POST['text_cidade'])),
            ':telefone' => (trim($_POST['text_telefone'])),
            ':purl' => $purl,
            ':activo' => 0

        ];
        $bd->insert("INSERT INTO clientes VALUES (0, 
        :email,
        :senha,
        :nome_completo,
        :morada,
        :cidade,
        :telefone,
        :purl,
        :activo,
        NOW(),
        NOW(),
        NULL
        )
         ", $params);

        //retorna o purl criado
        return $purl;
    }
}
