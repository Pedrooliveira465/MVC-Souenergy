<?php

namespace Core\Classes;

use Exception;
use PDO;
use PDOException;

/* Gestão de base de dados*/

class Database
{

    private $ligacao;
    //================================================================================
    private function ligar()
    {
        //Ligação com a base de dados
        $this->ligacao = new PDO(
            'mysql:' .
                'host=' . MYSQL_SERVER . ';' .
                'dbname=' . MYSQL_DATABSE . ';',
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );
        // 'charset=' . MYSQL_CHARSET
        //Atributo que mantém a ligação do servidor com a base de dados
        // 

        //Debug
        $this->ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    private function desligar()
    {
        //Encerra a conexão com a base de dados 
        $this->ligacao = null;
    }

    //===============================================================
    //CRUD
    //===============================================================

    //Verifica se é uma instrução insert
    public function select($sql, $parametros = null)
    {
        $sql = trim($sql);
        //Verifica se a expressão é um select
        if (!preg_match("/^SELECT/i", $sql)) {
            throw new Exception("Base de dados - Não é uma instrução em select", 1);
            //die("Base de dados - Não é uma instrução em select");
        }

        //Liga
        $this->ligar();
        $resultados = null;


        //Comunica
        try {
            //Comunicação com o banco
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) {
            //Caso exista erros
            return false;
        }

        //Encerra a conexão com o banco de dados
        $this->desligar();

        //Retorna os resultados obtidos
        return $resultados;
    }
    //===============================================================

    //Verfica se é uma instrução insert
    public function insert($sql, $parametros = null)
    {
        if (!preg_match("/^INSERT/i", $sql)) {
            throw new Exception("Base de dados - Não é uma instrução em insert", 1);
            //die("Base de dados - Não é uma instrução em select");
        }

        //Liga
        $this->ligar();

        $resultados = null;

        try {
            //Comunicação com o banco
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            //Caso exista erros
            return false;
        }

        //Encerra a conexão com o banco de dados
        $this->desligar();

        //Retorna os resultados obtidos
        return $resultados;
    }
    //===============================================================
    //Verifica se é uma instrução update
    public function Update($sql, $parametros = null)
    {
        if (!preg_match("/^UPDATE/i", $sql)) {
            throw new Exception("Base de dados - Não é uma instrução em update", 1);
            //die("Base de dados - Não é uma instrução em select");
        }

        //Liga
        $this->ligar();

        $resultados = null;

        try {
            //Comunicação com o banco
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            //Caso exista erros
            return false;
        }

        //Encerra a conexão com o banco de dados
        $this->desligar();

        //Retorna os resultados obtidos
        return $resultados;
    }
    //===============================================================
    //Verifica se é uma instrução delete
    public function delete($sql, $parametros = null)
    {
        if (!preg_match("/^DELETE/i", $sql)) {
            throw new Exception("Base de dados - Não é uma instrução em delete", 1);
            //die("Base de dados - Não é uma instrução em select");
        }

        //Liga
        $this->ligar();

        $resultados = null;

        try {
            //Comunicação com o banco
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            //Caso exista erros
            return false;
        }

        //Encerra a conexão com o banco de dados
        $this->desligar();

        //Retorna os resultados obtidos
        return $resultados;
    }

    //===============================================================
    //Método genérico 
    //===============================================================

    //Verifica se é uma instrução diferente das anteriores
    public function statement($sql, $parametros = null)
    {
        if (preg_match("/^(SELECT|INSERT|UPDATE|DELETE)/i", $sql)) {
            throw new Exception("Base de dados - Instrução inválida", 1);
            //die("Base de dados - Não é uma instrução em select");
        }

        //Liga
        $this->ligar();

        $resultados = null;

        try {
            //Comunicação com o banco
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            //Caso exista erros
            return false;
        }

        //Encerra a conexão com o banco de dados
        $this->desligar();

        //Retorna os resultados obtidos
        return $resultados;
    }
}












/*  
1.Ligar
2. Comunicar
3. Fechar


CRUD
Create  -INSERT
Read    -SELECT
Update  -UPDATE
Delete  -DELETE

define('MYSQL_SERVER',   'localhost');
define('MYSQL_DATABSE',  'php_store');
define('MYSQL_USER',     'user_php_store');
define('MYSQL+PASS',     '');
define('MYSQL_CHARSET',  'utf-8');
*/
