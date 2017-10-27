<?php

#inclui arquivo da classe de conexão
include_once '../model/modelConexao.class.php';

/**
 * Criado em 25/02/2016
 * Classe de CRUD com PDO para manter aluno
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */
class modelAluno extends modelConexao {

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
     * @param String $cpf do aluno
     * @param String $matricula do aluno
     * @param int $id do grupo
     * @return Array dados do aluno
     */
    public function consultarAluno($id_aluno, $nome,$matricula) {

        #setar os valores
        $this->setId($id_aluno);
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setMatricula($matricula);
        $this->setId_grupo($id_grupo);

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
        
        #verificar se foi passado algum valor de $matricula    
        if ($this->getMatricula() != null) {
            $sql.= " and matricula=:matricula";
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

            #verificar se foi passado algum valor de $matricula
            if ($this->getMatricula() != null) {
                $query->bindValue(':matricula', $this->getMatricula(), PDO::PARAM_INT);
            }
            #verificar se foi passado algum valor de $id grupo 
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
     * Método utilizado para consultar os alunos cadastrados
     * @access public 
     * @param Int $id id do aluno
     * @param String $nome nome do aluno
     * @return Array dados do aluno
     */
    public function consultarAlunoPorGrupo($id_grupo) {

        #montar a consultar (whre 1 serve para selecionar todos os registros)
        $sql = "select ta.nome from tb_grupo tg left join tb_aluno ta on tg.id=ta.id_grupo where tg.id = $id_grupo ";

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
     * Método utilizado para inserir um aluno
     * @access public 
     * @param String $nome nome do aluno
     * @param String $cpf CPF do aluno
     * @param String $matricula  do cliente
     * @param String $telefone telefone do cliente
     * @param String $email do aluno
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirAluno($nome, $cpf, $matricula, $telefone, $email, $id_grupo) {

        #setar os dados
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setMatricula($matricula);
        $this->setTelefone($telefone);
        $this->setEmail($email);
        $this->setId_grupo($id_grupo);
        echo $this->getId_grupo();

        #montar a consulta
        $sql = "INSERT INTO tb_aluno (id, nome, cpf, matricula, telefone, email, id_grupo) "
                . "VALUES (null,:nome,:cpf,:matricula,:telefone,:email,:id_grupo)";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cpf', $this->getCpf(), PDO::PARAM_STR);
            $query->bindValue(':matricula', $this->getMatricula(), PDO::PARAM_STR);
            $query->bindValue(':telefone', $this->getTelefone(), PDO::PARAM_STR);
            $query->bindValue(':email', $this->getEmail(), PDO::PARAM_STR);
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
     * @param Int $id id do aluno
     * @param String $nome nome do aluno
     * @param String $cpf CPF do aluno
     * @param String $matricula do aluno
     * @param String $telefone telefone do aluno
     * @param String $email do aluno 
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    public function alterarAluno($id_aluno, $nome, $cpf, $matricula, $telefone, $email) {

        #setar os dados
        $this->setId($id_aluno);
        $this->setNome($nome);
        $this->setCpf($cpf);
        $this->setMatricula($matricula);
        $this->setTelefone($telefone);
        $this->setEmail($email);
         $this->setId_grupo($id_grupo);

        #montar a consulta
        $sql = "UPDATE tb_aluno SET nome = :nome, cpf = :cpf, matricula = :matricula , telefone = :telefone, email = :email WHERE id = :id_aluno";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_aluno', $this->getId(), PDO::PARAM_INT);
            $query->bindValue(':nome', $this->getNome(), PDO::PARAM_STR);
            $query->bindValue(':cpf', $this->getCpf(), PDO::PARAM_STR);
            $query->bindValue(':matricula', $this->getMatricula(), PDO::PARAM_STR);
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
    public function excluirAluno($id_aluno) {

        #setar os dados
        $this->setId($id_aluno);

        #montar a consulta
        $sql = "DELETE FROM tb_aluno WHERE id=:id_aluno";

        #realizar a blidagem dos dados
        try {
            $bd = $this->conectar();
            $query = $bd->prepare($sql);
            $query->bindValue(':id_aluno', $this->getId(), PDO::PARAM_INT);
            $query->execute();
            return true;
        } catch (PDOException $e) {
            #$e->getMessage();   
            return false;
        }
    }

}
