<?php

namespace Core\Controller;

use Core\Classes\Database;
use Core\Classes\EnviarEmail;
use Core\Classes\Store;

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

        //inserir novo cliente na base de dados e devolver o purl
        $email_cliente = strtolower(trim($_POST['text_email']));
        $purl = $cliente->registar_cliente();

        //enviar do email para o cliente
        $email = new EnviarEmail(); 
        $resultado = $email->enviar_email_confirmacao_novo_cliente($email_cliente, $purl);

        if($resultado = true){
            echo 'Email enviado';
        }else{
            echo 'Aconteceu um erro';
        }

        //Base de dados Verificar se não já  existe um cliente com o mesmo email 
        $bd = new Database();
        $params = [
            ':email' => strtolower(trim($_POST['text_email']))
        ];
        $result = $bd->select("SELECT email FROM clientes WHERE email = :email", $params);
        print_r($result);
        die;

        if (count($result) != 0) {
            die('Já existe uma conta para esse endereço de email');
        }
        die('OK');
    }

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
