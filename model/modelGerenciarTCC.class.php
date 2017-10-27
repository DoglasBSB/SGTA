<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/**
 * Criado em 01/01/2015
 * Classe de CRUD com PDO para manter aluno
 * @author Sérgio Lima (professor.sergiolima@gmail.com)
 * @version 1.0.0
 */
class modelGerenciarTCC extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id;
    private $tema;
    private $ano;
    private $semestre;
    private $id_grupo;
    private $id_docente;
   
    
    
   
      
   

    /**
     * Métodos get e sets das classes
     */
    public function getId() {
        return $this->id;
    }

    public function getTema() {
        return $this->tema;
    }
    
    public function getAno() {
        return $this->ano;
    }

    public function getSemestre() {
        return $this->semestre;
    }
    public function getId_grupo() {
        return $this->id_grupo;
    }

    public function getId_docente() {
        return $this->id_docente;
    }
    
   
   

    

         
        
    
    public function setId($id) {
        $this->id = $id;
    }

    public function setTema($tema) {
        $this->tema = $tema;
    }
   
    public function setAno($ano) {
        $this->ano = $ano;
    }

    public function setSemestre($semestre) {
        $this->semestre = $semestre;
    }
    
     public function setId_grupo($id_grupo) {
        $this->id_grupo = $id_grupo;
    }
    
     public function setId_docente($id_docente) {
        $this->id_docente = $id_docente;
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
     * @param String $tema tema do aluno
     * @return Array dados do aluno
     */
    public function consultarGerenciarTCC($id_gerenciartcc, $tema, $ano, $semestre) {

        #setar os valores
        $this->setId($id_gerenciartcc);
        $this->setTema($tema);
        $this->setAno($ano);
        $this->setSemestre($semestre);
        $this->setId_grupo($id_grupo);
        $this->setId_grupo($id_docente);
       


        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_gerenciar_tcc where true";

        #verificar se foi passado algum valor de $id_gerenciartcc   
        if ($this->getId() != null) {
            $sql.= " and id=:id_gerenciartcc";
        }

        #verificar se foi passado algum valor de $tema 
        if ($this->getTema() != null) {
            $sql.= " and tema LIKE :tema ";
        }
        
      #verificar se foi passado algum valor de $tema 
        if ($this->getAno() != null) {
            $sql.= " and ano LIKE :ano ";
        }
        
        #verificar se foi passado algum valor de $tema 
        if ($this->getSemestre() != null) {
            $sql.= " and semestre LIKE :semestre ";
        }
        
         #verificar se foi passado algum valor de $id_grupo   
        if ($this->getId_grupo() != null) {
            $sql.= " and id_grupo=:id_grupo";
        }
        
         #verificar se foi passado algum valor de $id_grupo   
        if ($this->getId_docente() != null) {
            $sql.= " and id_docente=:id_docente";
        }

        
        #executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            #verificar se foi passado algum valor de $id_aluno   
            if ($this->getId() != null) {
                $query->bindValue(':id_gerenciartcc', $this->getId(), PDO::PARAM_INT);
            }

            #verificar se foi passado algum valor de $tema 
            if ($this->getTema() != null) {
                $this->setTema("%" . $tema . "%");
                $query->bindValue(':tema', $this->getTema(), PDO::PARAM_STR);  
            }
            
            #verificar se foi passado algum valor de $tema 
            if ($this->getAno() != null) {
                $this->setAno("%" . $ano . "%");
                $query->bindValue(':ano', $this->getAno(), PDO::PARAM_STR);  
            }
            
             #verificar se foi passado algum valor de $tema 
            if ($this->getSemestre() != null) {
                $this->setSemestre("%" . $semestre . "%");
                $query->bindValue(':semestre', $this->getSemestre(), PDO::PARAM_STR);  
            }
            
            #verificar se foi passado algum valor de $id_grupo 
            if ($this->getId_grupo() != null) {
                $query->bindValue(':id_grupo', $this->getId_grupo(), PDO::PARAM_INT);
            }
            
            #verificar se foi passado algum valor de $id_grupo 
            if ($this->getId_docente() != null) {
                $query->bindValue(':id_docente', $this->getId_docente(), PDO::PARAM_INT);
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
     * Método utilizado para inserir um aluno
     * @access public 
     * @param String $tema tema do aluno
     * @param String $cpf CPF do aluno
     * @param String $matricula  do cliente
     * @param String $telefone telefone do cliente
     * @param String $email do aluno
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirGerenciarTCC($tema, $ano, $semestre, $id_grupo, $id_docente) {

        #setar os dados
        $this->setTema($tema);
        $this->setAno($ano);
        $this->setSemestre($semestre);
        $this->setId_grupo($id_grupo);
        $this->setId_docente($id_docente);
        echo $this->getId_docente();
        
        
        #montar a consulta
        $sql = "INSERT INTO tb_gerenciar_tcc (id,tema,ano,semestre, id_grupo, id_docente) "
                . "VALUES (null,:tema,:ano,:semestre,:id_grupo,:id_docente)";
        
       
        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':tema', $this->getTema(), PDO::PARAM_STR);
            $query->bindValue(':ano', $this->getAno(), PDO::PARAM_STR);
            $query->bindValue(':semestre', $this->getSemestre(), PDO::PARAM_STR);
            $query->bindValue(':id_grupo', $this->getId_grupo(), PDO::PARAM_INT);
            $query->bindValue(':id_docente', $this->getId_docente(), PDO::PARAM_INT);
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
     * @param String $tema tema do aluno
     * @param String $cpf CPF do aluno
     * @param String $matricula do aluno
     * @param String $telefone telefone do aluno
     * @param String $email do aluno 
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alterarGerenciarTCC($id_gerenciartcc, $tema, $ano, $semestre) {

        #setar os dados
        $this->setId($id_gerenciartcc);
        $this->setTema($tema);
        $this->setAno($ano);
        $this->setSemestre($semestre);
        $this->setId_grupo($id_grupo);
        $this->setId_grupo($id_docente);
       
        #montar a consulta
        $sql = "UPDATE tb_gerenciar_tcc SET tema = :tema, ano = :ano, semestre = :semestre WHERE id = :id_gerenciartcc";

        
  
        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_gerenciartcc', $this->getId(), PDO::PARAM_INT);
            $query->bindValue(':tema', $this->getTema(), PDO::PARAM_STR);
            $query->bindValue(':ano', $this->getAno(), PDO::PARAM_STR);
            $query->bindValue(':semestre', $this->getSemestre(), PDO::PARAM_STR);
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
    public function excluirGerenciarTCC($id_gerenciartcc) {

        #setar os dados
        $this->setId($id_gerenciartcc);

        #montar a consulta
        $sql = "DELETE FROM tb_gerenciar_tcc WHERE id=:id_gerenciartcc";
        
        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_gerenciartcc', $this->getId(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #$e->getMessage();   
            return false;
        }
    } 
  
    
    
  
    
 }