<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/*
 * Criado em 25/02/2016
 * Classe de CRUD com PDO para manter atividade
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */
class modelAtividade extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id;
    private $nome_atividade; 
    private $fase;
    private $prazo;
    private $status;
    private $id_grupo;
   

    /**
     * Métodos get e sets das classes
     */
    public function getId() {
        return $this->id;
    }

    public function getNomeAtividade() {
        return $this->nome_atividade;
    }

    public function getFase() {
        return $this->fase;
    }
    
    public function getPrazo() {
        return $this->prazo;
    }

    public function getStatus() {
        return $this->status;
    }
    
    public function getId_grupo() {
        return $this->id_grupo;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setNomeAtividade($nome_atividade) {
        $this->nome_atividade = $nome_atividade;
    }

    public function setFase($fase) {
        $this->fase = $fase;
    }
    
    public function setPrazo($prazo) {
        $this->prazo = $prazo;
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function setId_grupo($id_grupo) {
        $this->id_grupo = $id_grupo;
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
     * @param String $nome_atividade nome_atividade do aluno
     * @return Array dados do aluno
     */
    public function consultarAtividade($id_atividade, $nome_atividade, $fase, $prazo, $status) {

        #setar os valores
        $this->setId($id_atividade);
        $this->setNomeAtividade($nome_atividade);
        $this->setFase($fase);
        $this->setPrazo($prazo);
        $this->setStatus($status);
        $this->setId_grupo($id_grupo);

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_atividade where true";

        #verificar se foi passado algum valor de $id_docente    
        if ($this->getId() != null) {
            $sql.= " and id=:id_atividade";
        }

        #verificar se foi passado algum valor de $nome_atividade 
        if ($this->getNomeAtividade() != null) {
            $sql.= " and nome_atividade LIKE :nome_atividade ";
        }  
        
        #verificar se foi passado algum valor de $fase 
        if ($this->getFase() != null) {
            $sql.= " and fase LIKE :fase ";
        }
        
        #verificar se foi passado algum valor de $prazo 
        if ($this->getPrazo() != null) {
            $sql.= " and prazo LIKE :prazo ";
        }
        
        #verificar se foi passado algum valor de $status 
        if ($this->getStatus() != null) {
            $sql.= " and status LIKE :status ";
        }
        
        #verificar se foi passado algum valor de $id_grupo
        if ($this->getId_grupo() != null) {
            $sql.= " and id_grupo LIKE :id_grupo ";
        }
        
        
        

        #executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            #verificar se foi passado algum valor de $id_docente   
            if ($this->getId() != null) {
                $query->bindValue(':id_atividade', $this->getId(), PDO::PARAM_INT);
            }

            #verificar se foi passado algum valor de $nome_atividade 
            if ($this->getNomeAtividade() != null) {
                $this->setNomeAtividade("%" . $nome_atividade . "%");
                $query->bindValue(':nome_atividade', $this->getNomeAtividade(), PDO::PARAM_STR);
            }
            
            
            #verificar se foi passado algum valor de $nome_atividade 
            if ($this->getFase() != null) {
                $this->setFase("%" . $fase . "%");
                $query->bindValue(':fase', $this->getFase(), PDO::PARAM_STR);
            }
             
            #verificar se foi passado algum valor de $prazo 
            if ($this->getPrazo() != null) {
                $this->setPrazo("%" . $prazo . "%");
                $query->bindValue(':prazo', $this->getPrazo(), PDO::PARAM_STR);
            }
            
            #verificar se foi passado algum valor de $status 
            if ($this->getStatus() != null) {
                $this->setStatus("%" . $status . "%");
                $query->bindValue(':status', $this->getStatus(), PDO::PARAM_STR);
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
    
    
         

    /**
     * Método utilizado para inserir uma atividade
     * @access public 
     * @param String $nome_atividade nome_atividade do docente
     * @param String $cpf CPF do docente
     * @param String $telefone telefone do docente
     * @param String $email do docente
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirAtividade($nome_atividade, $fase, $prazo, $status, $id_grupo) {

        #setar os dados
        $this->setNomeAtividade($nome_atividade);
        $this->setFase($fase);
        $this->setPrazo($prazo);
        $this->setStatus($status);
         $this->setId_grupo($id_grupo);
        echo $this->getId_grupo(); 

        #montar a consulta
        $sql = "INSERT INTO tb_atividade (id, nome_atividade, fase, prazo, status, id_grupo) "
                . "VALUES (null,:nome_atividade,:fase,:prazo,:status,:id_grupo)";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':nome_atividade', $this->getNomeAtividade(), PDO::PARAM_STR);
            $query->bindValue(':fase', $this->getFase(), PDO::PARAM_STR);
            $query->bindValue(':prazo', $this->getPrazo(), PDO::PARAM_STR);
            $query->bindValue(':status', $this->getStatus(), PDO::PARAM_STR);
            $query->bindValue(':id_grupo', $this->getId_grupo(), PDO::PARAM_INT);
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
     * @param Int $id id da atividade
     * @param String $nome_atividade nome_atividade da atividade
     * @param String $data data da atividade
     
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alterarAtividade($id_atividade, $nome_atividade, $fase, $prazo, $status) {

        #setar os dados
        $this->setId($id_atividade);
        $this->setNomeAtividade($nome_atividade);
        $this->setFase($fase);
        $this->setPrazo($prazo);
        $this->setStatus($status);
        

        #montar a consulta
        $sql = "UPDATE tb_atividade SET nome_atividade = :nome_atividade, fase = :fase, prazo = :prazo, status = :status WHERE id = :id_atividade";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_atividade', $this->getId(), PDO::PARAM_INT);
            $query->bindValue(':nome_atividade', $this->getNomeAtividade(), PDO::PARAM_STR);
            $query->bindValue(':fase', $this->getFase(), PDO::PARAM_STR);
            $query->bindValue(':prazo', $this->getPrazo(), PDO::PARAM_STR);
            $query->bindValue(':status', $this->getStatus(), PDO::PARAM_STR);
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
    public function excluirAtividade($id_atividade) {

        #setar os dados
        $this->setId($id_atividade);

        #montar a consulta
        $sql = "DELETE FROM tb_atividade WHERE id=:id_atividade";
        
        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_atividade', $this->getId(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #$e->getMessage();   
            return false;
        }
    }

}
