<?php
#iniciar_sessao
session_start();

#carregar as classes dinamicamente
include_once 'autoload.php';

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

/**
 * Criado em 25/02/2015
 * Classe de controle do grupo
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */
class ControlGrupo extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos grupos cadastrados e invocar o método consultarGrupo no model
     * @access public 
     * @param Int $id id do grupo
     * @param String $nome nome do grupo
     * @return Array email do grupo
     */
    function consultarGrupo($dados) {

        #extração de dados do grupo
        $nome = $dados['nome'][0];
        $id = $dados["id_grupo"][0];
        $email = $dados['email'][0];
        

        $objGrupo = new modelGrupo();
        return $listaGrupo= $objGrupo->consultarGrupo($id, $nome, $email);
    }

    /**
     * Método utilizado validar os dados dos Alunos cadastrados e invocar o método inserirAluno no model
     * @access public 
     * @param Array $dados com os dados do Aluno
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirGrupo($dados) {

        #extração de dados do Aluno
        $nome = $dados['nome'][0];
        $email = $dados['email'][0];
       
        

        #invocar métódo  e passar parâmetros
        $objGrupo = new modelGrupo();

       
        #se for válido invocar o método de iserir
        if ($objGrupo->inserirGrupo($nome, $email) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Grupo inserido com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=grupo&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro grupo já inserido!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=grupo&menu=consultar");
        }
    }

    /**
     * Método utilizado validar os dados dos Alunos e invocar o método alterarAluno no model
     * @access public 
     * @param Int $id id do Aluno
     * @param String $nome nome do Aluno
     * @param String $cpf CPF do Aluno
     * @param String $matricula do Aluno
     * @param String $telefone telefone do Aluno
     * @param String $email telefone do Aluno
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function alterarGrupo($dados) {

        #extração de dados do aluno
        $id = $dados['id_grupo'][0];
        $nome = $dados['nome'][0];
        $email = $dados['email'][0];
        
        
           
        #invocar métódo  e passar parâmetros
        $objGrupo = new modelGrupo();

        if ($objGrupo->alterarGrupo($id, $nome, $email) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = " Grupo alterado com sucesso!";      
            #redirecionar
            header("location: ../view/modulo.php?modulo=grupo&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar grupo!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=grupo&menu=consultar");
        }
    }

    /**
     * Método utilizado para validar os dados dos clientes e invocar o método excluirAluno no model
     * @access public 
     * @param Int $id id do Aluno
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluirGrupo($dados) {

        #extração de dados do cliente
        $id = $dados['id_grupo'][0];
        
        #invocar métódo  e passar parâmetros
        $objGrupo = new modelGrupo();

        #invocar métódo  e passar parâmetros
        if ($objGrupo->excluirGrupo($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Grupo excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=grupo&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir grupo!";
            header("location: ../view/modulo.php?modulo=grupo&menu=consultar");
        }
    }
    
    public function listaAlunos($id_grupo)
    {
        $objAluno = new modelAluno();
        
        $alunos = $objAluno->consultarAlunoPorGrupo($id_grupo);
        
         foreach ($alunos as $item) {
            
             echo $item['nome'].' | ';
        }
    }

}
