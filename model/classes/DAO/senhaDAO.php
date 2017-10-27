<?php

require_once("Conexao.php");

class senhaDAO {

    function __construct() {
        $this->con = new Conexao();
        $this->pdo = $this->con->Connect();
    }

    function cadastrar(senha $entSenha) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO senha VALUES (:us_cod, :us_senha)");
            $param = array(
                ":us_cod" => $entSenha->getUs_cod(),
                ':us_senha' => md5($entSenha->getUs_senha())
            );

            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 01,  SENHA: {$ex->getMessage()}";
        }
    }

    public function redefinirSenha($us_cod, $us_senha) {
        try {
            $stmt = $this->pdo->prepare("UPDATE senha set senha = :us_senha WHERE us_cod = :us_cod");

            $param = array(
                ":us_cod" => $us_cod,
                ":us_senha" => md5($us_senha)
            );
            
            return $stmt->execute($param);
        } catch (PDOException $ex) {
            echo "ERRO 02,  SENHA: {$ex->getMessage()}";
        }
    }

}

?>