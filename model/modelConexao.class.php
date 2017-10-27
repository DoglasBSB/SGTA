<?php

/**
 * Criado em 25/02/2016
 * Classe de conexão com PDO/MySQL
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */

class modelConexao {

    /**
     * Atributos da classe
     */
    private $host;
    private $user;
    private $pwd;
    private $dbase;
    private $link;

    /**
     * Métodos get e sets das classes
     */
    public function getHost() {
        return $this->host;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPwd() {
        return $this->pwd;
    }

    public function getDbase() {
        return $this->dbase;
    }

    public function getLink() {
        return $this->link;
    }

    public function setHost($host) {
        $this->host = $host;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPwd($pwd) {
        $this->pwd = $pwd;
    }

    public function setDbase($dbase) {
        $this->dbase = $dbase;
    }

    public function setLink($link) {
        $this->link = $link;
    }

    /**
     * Método para conexao com o banco de dados
     * @return $pdo retorna o link da conexão com o banco em caso de sucesso
     */
    public function conectar() {

        #setar as cofigurações do banco de dados
        $this->setHost("localhost");
        $this->setUser("root");
        $this->setPwd("");
        $this->setDbase("sgta");

        #conecta ao banco de dados usando o PHP PDO
        try {
            $pdo = new PDO("mysql:host={$this->getHost()};dbname={$this->getDbase()}", "{$this->getUser()}", "{$this->getPwd()}", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setLink($pdo);
            return $pdo;
        } catch (PDOException $e) {
            $this->setLink(null);
            return false;
        }
    }
}
