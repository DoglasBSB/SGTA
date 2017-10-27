<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/*
 * Criado em 25/02/2016
 * Classe de CRUD com PDO para emitir relatório
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */
class modelRelatorio extends modelConexao {

   
    /*
     * Método utilizado para consultar os alunos cadastrados
     * @access public 
     * @param Int $id id do aluno
     * @param String $nome nome do aluno
     * @return Array dados do aluno
     */
    
    /**
     * Atributos da classe
     */
    private $id;
    private $nome;
    private $cpf;
    private $matricula;
    private $telefone;
    private $email;
    private $id_grupo;

    /**
     * Métodos get e sets das classes
     *
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getMatricula() {
        return $this->matricula;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function getEmail() {
        return $this->email;
    }
    
     public function getId_grupo() {
        return $this->id_grupo;
    }
    
    

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
     public function setId_grupo($id_grupo) {
        $this->id_grupo = $id_grupo;
    }

   

    /**
     * Método utilizado para consultar os alunos cadastrados
     * @access public 
     * @param Int $id id do aluno
     * @param String $nome nome do aluno
     * @return Array dados do aluno
     *
    public function consultarDados($id_aluno, $nome) {

        #setar os valores
        $this->setId($id_aluno);
        $this->setNome($nome);
        $this->setCpf($cpf);
        

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_aluno where true";

        #verificar se foi passado algum valor de $id_aluno    
        if ($this->getId() != null) {
            $sql.= " and id=:id_aluno";
        }

        #verificar se foi passado algum valor de $nome 
        if ($this->getNome() != null) {
            $sql.= " and nome LIKE :nome ";
        }

        #verificar se foi passado algum valor de $id_aluno    
        if ($this->getCpf() != null) {
            $sql.= " and cpf=:cpf";
        }
        
        #verificar se foi passado algum valor de $id_grupo   
        if ($this->getId_grupo() != null) {
            $sql.= " and id_grupo=:id_grupo";
        }

        #executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            #verificar se foi passado algum valor de $id_aluno   
            if ($this->getId() != null) {
                $query->bindValue(':id_aluno', $this->getId(), PDO::PARAM_INT);
            }

            #verificar se foi passado algum valor de $nome 
            if ($this->getNome() != null) {
                $this->setNome("%" . $nome . "%");
                $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            }
            #verificar se foi passado algum valor de $cpf 
            if ($this->getCpf() != null) {
                $query->bindValue(':cpf', $this->getCpf(), PDO::PARAM_INT);
            }

            #verificar se foi passado algum valor de $cpf 
            if ($this->getId_grupo() != null) {
                $query->bindValue(':id_grupo', $this->getId_grupo(), PDO::PARAM_INT);
            }
            
            
            
            $query->execute();

            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }
    
    
    */
} 



   
 

