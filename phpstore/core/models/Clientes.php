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

    //==========================================================
    public function validar_email($purl){
        //validar o email do novo cliente 
        $bd = new Database();
        $params = [
            ':purl' => $purl
        ];
        $resultados = $bd->select("SELECT * FROM clientes WHERE purl = :purl", $params);

        //verifica se foi encontrado o cliente
        if(count($resultados) != 1){
            return false;
        }

        //foi encontrado este cliente com o purl indicado
        $id_cliente = $resultados[0]->id_cliente;

        //atualizar os dados do cliente
        $params = [
            ':id_cliente' => $id_cliente
        ];
        
        $bd->update("UPDATE clientes SET purl = NULL, activo = 1, update_at = NOW()", $params);

        return true;
    }
}
