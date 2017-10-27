<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/*
 * Criado em 25/02/2016
 * Classe de CRUD com PDO para manter grupo
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */
class modelGrupo extends modelConexao {

    /**
     * Atributos da classe
     */
    private $id;
    private $nome; 
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

    public function getEmail() {
        return $this->email;
    }
    

    public function setId($id) {
        $this->id = $id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
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
    public function consultarGrupo($id_grupo, $nome, $email) {

        #setar os valores
        $this->setId($id_grupo);
        $this->setNome($nome);
        $this->setEmail($email);
 
        

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select * from tb_grupo where true";

        #verificar se foi passado algum valor de $id_docente    
        if ($this->getId() != null) {
            $sql.= " and id=:id_grupo";
        }

        #verificar se foi passado algum valor de $nome 
        if ($this->getNome() != null) {
            $sql.= " and nome LIKE :nome ";
        }
        
       
        #verificar se foi passado algum valor de $email 
        if ($this->getEmail() != null) {
            $sql.= " and email LIKE :email ";
        }
            
        

        #executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);

            #verificar se foi passado algum valor de $id_grupo   
            if ($this->getId() != null) {
                $query->bindValue(':id_grupo', $this->getId(), PDO::PARAM_INT);
            }

            #verificar se foi passado algum valor de $nome 
            if ($this->getNome() != null) {
                $this->setNome("%" . $nome . "%");
                $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            }
            
            
            #verificar se foi passado algum valor de $email 
            if ($this->getEmail() != null) {
                $this->setEmail("%" . $email . "%");
                $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            }
            
                    
            
            
            
            
            $query->execute();

            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }
    
    
        public function consultarNomeGrupo($id_grupo) {

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        #$sql = "select ta.nome from tb_gerenciar_tcc tg right join tb_grupo ta on ta.id=tg.id_grupo where ta.id = $id_grupo ";
        $sql = "select * from tb_grupo inner join tb_gerenciar_tcc on tb_grupo.id=tb_gerenciar_tcc.id_grupo where tb_gerenciar_tcc.id = $id_grupo ";
            
            
#executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            #verificar se foi passado algum valor de $id_aluno   
            $query->bindValue(':id_grupo', $id_grupo, PDO::PARAM_INT);
            $query->execute();
            $this->resultado = $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $e->getMessage();

            $this->resultado = null;
        }
        return $this->resultado;
    }
    
    
    public function consultarNomeGrupoParaAtividade($id_grupo) {

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        #$sql = "select ta.nome from tb_gerenciar_tcc tg right join tb_grupo ta on ta.id=tg.id_grupo where ta.id = $id_grupo ";
        $sql = "select * from tb_grupo inner join tb_atividade on tb_grupo.id=tb_atividade.id_grupo where tb_atividade.id = $id_grupo ";
            
            
#executa consulta e controi um array com o resultado da consulta
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            #verificar se foi passado algum valor de $id_aluno   
            $query->bindValue(':id_grupo', $id_grupo, PDO::PARAM_INT);
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
    function inserirGrupo($nome, $email) {

        #setar os dados
        $this->setNome($nome);
        $this->setEmail($email);


        #montar a consulta
        $sql = "INSERT INTO tb_grupo (id, nome, email) "
                . "VALUES (null,:nome,:email)";
        
     

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
            $query->execute();
            #$id_grupo = $query->lastInsertId();
            
            
            
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
     * @param String $nome nome da atividade
     * @param String $data data da atividade
     
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alterarGrupo($id_grupo, $nome, $email) {

        #setar os dados
        $this->setId($id_grupo);
        $this->setNome($nome);
        $this->setEmail($email);
        
        

        #montar a consulta
        $sql = "UPDATE tb_grupo SET nome = :nome, email = :email WHERE id = :id_grupo";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_grupo', $this->getId(), PDO::PARAM_INT);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
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
    public function excluirGrupo($id_grupo) {

        #setar os dados
        $this->setId($id_grupo);

        #montar a consulta
        $sql = "DELETE FROM tb_grupo WHERE id=:id_grupo";
        
        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_grupo', $this->getId(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #$e->getMessage();   
            return false;
        }
    }

}
