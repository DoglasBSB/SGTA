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
 * Classe de controle do docente
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */
class ControlDocente extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos docentes cadastrados e invocar o método consultarDocente no model
     * @access public 
     * @param Int $id id do docente
     * @param String $nome nome do docente
     * @return Array dados do docente
     */
    function consultarDocente($dados) {

        #extração de dados do docente
        $nome = $dados['nome'][0];
        $id = $dados['id_docente'][0];
        $cpf = $dados['cpf'][0];

        $objDocente = new modelDocente();
        return $listaDocente = $objDocente->consultarDocente($id, $nome, $cpf);
    }

    /**
     * Método utilizado validar os dados dos Alunos cadastrados e invocar o método inserirAluno no model
     * @access public 
     * @param Array $dados com os dados do Aluno
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirDocente($dados) {

        #extração de dados do Aluno
        $nome = $dados['nome'][0];
        $cpf = $dados['cpf'][0];
        $telefone = $dados['telefone'][0];
        $email = $dados['email'][0];

        #invocar métódo  e passar parâmetros
        $objDocente = new modelDocente();

       
        #se for válido invocar o método de iserir
        if ($objDocente->inserirDocente($nome, $cpf, $telefone, $email) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Docente inserido com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=docente&menu=consultar");
        } else {
            $_SESSION['msg'] = "Docente com CPF já cadastrado";
            #redirecionar
            header("location: ../view/modulo.php?modulo=docente&menu=consultar");
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
    function alterarDocente($dados) {

        #extração de dados do aluno
        $id = $dados['id_docente'][0];
        $nome = $dados['nome'][0];
        $cpf = $dados['cpf'][0];
        $telefone = $dados['telefone'][0];
        $email = $dados['email'][0];
        
           
        #invocar métódo  e passar parâmetros
        $objDocente = new modelDocente();

        if ($objDocente->alterarDocente($id, $nome, $cpf, $telefone, $email) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Docente alterado com sucesso!";
                     
            #redirecionar
            header("location: ../view/modulo.php?modulo=docente&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar docente!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=docente&menu=consultar");
        }
    }

    /**
     * Método utilizado para validar os dados dos clientes e invocar o método excluirAluno no model
     * @access public 
     * @param Int $id id do Aluno
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluirDocente($dados) {

        #extração de dados do cliente
        $id = $dados['id_docente'][0];
        
        #invocar métódo  e passar parâmetros
        $objDocente = new modelDocente();

        #invocar métódo  e passar parâmetros
        if ($objDocente->excluirDocente($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Docente excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=docente&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir docente!";
            header("location: ../view/modulo.php?modulo=docente&menu=consultar");
        }
    }

}
