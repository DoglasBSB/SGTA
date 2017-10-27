<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/*
 * Criado em 25/02/2016
 * Classe de CRUD com PDO para manter atividade
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */
class modelDocente extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id;
    private $nome;
    private $cpf;
    private $telefone;
    private $email;

    /**
     * Métodos get e sets das classes
     */
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getCpf() {
        return $this->cpf;
    }

    
    public function getTelefone() {
        return $this->telefone;
    }
     
    public function getEmail() {
        return $this->email;
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

    
    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }
     
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * método mágico para não permitir clonar a classe
     */
    public function __clone() {
        ;
    }

    /**
     * Método utilizado para consultar os alunos cadastrados
     * @access public 
     * @param Int $id id do aluno
     * @param String $nome nome do aluno
     * @return Array dados do aluno
     */
    public function consultarDocente($id_docente, $nome, $cpf) {

        #setar os valores
        $this->setId($id_docente);
        $this->setNome($nome);
        $this->setCpf($cpf);

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_docente where true";

        #verificar se foi passado algum valor de $id_docente    
        if ($this->getId() != null) {
            $sql.= " and id=:id_docente";
        }

        #verificar se foi passado algum valor de $nome 
        if ($this->getNome() != null) {
            $sql.= " and nome LIKE :nome ";
        }
        
        #verificar se foi passado algum valor de $cpf 
        if ($this->getCpf() != null) {
            $sql.= " and cpf LIKE :cpf ";
        }

        #executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            #verificar se foi passado algum valor de $id_docente   
            if ($this->getId() != null) {
                $query->bindValue(':id_docente', $this->getId(), PDO::PARAM_INT);
            }

            #verificar se foi passado algum valor de $nome 
            if ($this->getNome() != null) {
                $this->setNome("%" . $nome . "%");
                $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            }
            
            
             #verificar se foi passado algum valor de $nome 
            if ($this->getCpf() != null) {
                $this->setCpf("%" . $cpf . "%");
                $query->bindValue(':cpf', $this->getCpf(), PDO::PARAM_INT);
            }
            $query->execute();

            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }

    
    
    public function consultarNomeDocente($id_docente) {

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        
       $sql = "select * from tb_docente inner join tb_gerenciar_tcc on tb_docente.id=tb_gerenciar_tcc.id_docente where tb_gerenciar_tcc.id = $id_docente";
       #$sql = "select td.nome from tb_docente where tb_gerenciar_tcc.id = $id_docente";
        
        
        
          
#executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            #verificar se foi passado algum valor de $id_aluno   
            $query->bindValue(':id_docente', $id_docente, PDO::PARAM_INT);
            $query->execute();
            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }
       
    
    
    /**
     * Método utilizado para inserir um docente
     * @access public 
     * @param String $nome nome do docente
     * @param String $cpf CPF do docente
     * @param String $telefone telefone do docente
     * @param String $email do docente
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirDocente($nome, $cpf, $telefone, $email) {

        #setar os dados
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setTelefone($telefone);
        $this->setEmail($email);
        echo $this->getEmail();

        #montar a consulta
        $sql = "INSERT INTO tb_docente (id, nome, cpf, telefone, email) "
                . "VALUES (null,:nome,:cpf,:telefone,:email)";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cpf', $this->getCpf(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #echo $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para alterar um aluno
     * @access public 
     * @param Int $id id do aluno
     * @param String $nome nome do aluno
     * @param String $cpf CPF do aluno
     * @param String $matricula do aluno
     * @param String $telefone telefone do aluno
     * @param String $email do aluno 
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alterarDocente($id_docente, $nome, $cpf, $telefone, $email) {

        #setar os dados
        $this->setId($id_docente);
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setTelefone($telefone);
        $this->setEmail($email);

        #montar a consulta
        $sql = "UPDATE tb_docente SET nome = :nome, cpf = :cpf, telefone = :telefone, email = :email WHERE id = :id_docente";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_docente', $this->getId(), PDO::PARAM_INT);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cpf', $this->getCpf(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #echo $e->getMessage();
            return false;
        }
    }

    /**
     * Método utilizado para excluir um aluno cadastrado
     * @access public 
     * @param Int $id id do aluno
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    public function excluirDocente($id_docente) {

        #setar os dados
        $this->setId($id_docente);

        #montar a consulta
        $sql = "DELETE FROM tb_docente WHERE id=:id_docente";
        
        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_docente', $this->getId(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #$e->getMessage();   
            return false;
        }
    }

}
