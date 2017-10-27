<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/*
 * Criado em 25/02/2016
 * Classe de CRUD com PDO para manter atividade
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */
class Nomedaclasse extends modelConexao {

    /**
     * Atributos da classe
     */
    private $nome_atributo;

    /**
     * Métodos get e sets das classes
     */
    public function getNome_atributo() {
        return $this->nome_atributo;
    }

    public function setNome_atributo($nome_atributo) {
        $this->nome_atributo = $nome_atributo;
    }

    /**
     * Método utilizado para <descrição>
     * @access public 
     * @param <tipo do parâmero> $<nome parâmetro> <descrição do parâmetro>
     * @return <tipo do retorno> <descrição do reorno>
     */
    function consultar($parâmetros) {

        #setar os dados
        $this->setNome_atributo($nome_atributo);

        #montar a consultar (where true serve para selecionar todos os registros)
        $sql = "select * from <nome tabela> where true";

        #verificar se foi passado algum valor de <parâmetro>   
        if ($this->getNome_atributo() != null) {
            $sql.= " and <campo tabela>=:<nome campo>";
        }

        #executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            #verificar se foi passado algum valor de :<nome campo> 
            if ($this->getNome_atributo() != null) {
                $query->bindValue(':<nome campo>', $this->getNome_atributo(), PDO::PARAM_INT);
            }

            $query->execute();
            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }

    /**
     * Método utilizado para <descrição>
     * @access public 
     * @param <tipo do parâmero> $<nome parâmetro> <descrição do parâmetro>
     * @return <tipo do retorno> <descrição do reorno>
     */
    function inserir($parâmetros) {

        #setar os dados
        $this->setNome_atributo($nome_atributo);


        #montar a consulta
        $sql = "INSERT INTO <nome tabela> (<campo tabela>) VALUES (:<nome campo>)";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':<nome campo>', $this->getNome_atributo(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    /**
     * Método utilizado para <descrição>
     * @access public 
     * @param <tipo do parâmero> $<nome parâmetro> <descrição do parâmetro>
     * @return <tipo do retorno> <descrição do reorno>
     */
    public function alterar($parâmetros) {

        #setar os dados
        $this->setNome_atributo($nome_atributo);

        #montar a consulta
        $sql = "UPDATE <nome tabela> SET <nome campo> = :<nome campos> WHERE <nome chave primária> = :<nome campo>";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':<nome campo>', $this->getNome_atributo(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {

            return false;
        }
    }

    /**
     * Método utilizado para <descrição>
     * @access public 
     * @param <tipo do parâmero> $<nome parâmetro> <descrição do parâmetro>
     * @return <tipo do retorno> <descrição do reorno>
     */
    public function excluir($parâmetros) {

        #setar os dados
        $this->setNome_atributo($nome_atributo);

        #montar a consulta
        $sql = "DELETE FROM <nome tabela> WHERE <nome chave primária>=:<nome campo>";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':<nome campo>', $this->$this->getNome_atributo(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}
