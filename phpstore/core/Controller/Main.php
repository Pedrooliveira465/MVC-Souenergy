<?php

namespace Core\Controller;

use Core\Classes\Database;
use Core\Classes\Store;
use Core\Models\Clientes;

class Main
{

    //==========================================================
    //Apresenta a pagina index
    public function index()
    {
        /*
        1. Carregar e tratar dados (cálculos) e (Base de dados)
        2. Apresentar o layout (Views)
        */

        Store::layout([
            'Layout/Html_Header',
            'Layout/Header',    //Header que contém a navegação do header
            'inicio',
            'Layout/Footer',
            'Layout/Html_Footer',
        ]);
    }

    //==========================================================
    //Apresenta a pagina da loja 
    public function loja()
    {
        Store::layout([
            'Layout/Html_Header',
            'Layout/Header',    //Header que contém a navegação do header
            'Loja',
            'Layout/Footer',
            'Layout/Html_Footer',
        ]);
    }

    //==========================================================
    //Apresneta a tela de novo cliente
    public function novo_cliente()
    {
        //Verifica se já existe uma sessão iniciada
        if (Store::clientelog()) {
            $this->index();
            return;
        }

        Store::layout([
            'Layout/Html_Header',
            'Layout/Header',    //Header que contém a navegação do header
            'criar_cliente',
            'Layout/Footer',
            'Layout/Html_Footer',
        ]);
    }


    public function criar_cliente()
    {
        //Verifica se já existe sessao
        if (Store::clientelog()) {
            $this->index();
            return;
        }

        //Verifica se existe uma ação de submit
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }

        //Criar novo cliente
        //Verificação de senha (Senha 1 = Senha2)
        if ($_POST['text_senha_1'] !== $_POST['text_senha_2']) {
            //Senhas diferentes
            $_SESSION['erro'] = 'As senhas estão diferentes, verifique novamente';
            $this->novo_cliente();
            return;
        }

        //Base de dados Verificar se não já  existe um cliente com o mesmo email 

        $cliente = new Clientes();

        if ($cliente->verificar_email_existe($_POST['text_email'])) {

            $_SESSION['erro'] = 'Já existe um email cadastrado';
            $this->novo_cliente();
            return;
        }
        $bd = new Database();
        $params = [
            ':email' => strtolower(trim($_POST['text_email']))
        ];
        $result = $bd->select("SELECT email FROM clientes WHERE email = :email", $params);

        if (count($result) != 0) {
            $_SESSION['error'] = 'Já existe um email cadastrado';
            $this->novo_cliente();
            return;
        }

        $purl = Store::criarhash();
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
        die('Inserido');
    }

    ///Cliente pronto para ser inserido na base de dados
    //Criar uma purl 

    //==========================================================
    //Apresenta a pagina do carrinho
    public function carrinho()
    {
        Store::layout([
            'Layout/Html_Header',
            'Layout/Header',    //Header que contém a navegação do header
            'carrinho',
            'Layout/Footer',
            'Layout/Html_Footer',
        ]);
    }
}
