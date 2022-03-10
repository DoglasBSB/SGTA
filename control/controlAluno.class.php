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
 * Classe de controle do cliente
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */
class ControlAluno extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos Alunos cadastrados e invocar o método consultarAluno no model
     * @access public 
     * @param Int $id id do Aluno
     * @param String $nome nome do Aluno
     * @return Array dados do Aluno
     */
    function consultarAluno($dados) {

        #extração de dados do aluno
        $id = $dados['id_aluno'][0];
        $nome = $dados['nome'][0];
        $cpf = $dados['cpf'][0];
        $matricula = $dados['matricula'][0];

        $objAluno = new modelAluno();
        return $listaAluno = $objAluno->consultarAluno($id, $nome, $cpf, $matricula);
    }

    /**
     * Método utilizado validar os dados dos Alunos cadastrados e invocar o método inserirAluno no model
     * @access public 
     * @param Array $dados com os dados do Aluno
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirAluno($dados) {

        #extração de dados do Aluno
        $nome = $dados['nome'][0];
        $cpf = $dados['cpf'][0];
        $matricula = $dados['matricula'][0];
        $telefone = $dados['telefone'][0];
        $email = $dados['email'][0];
        $id_grupo = $dados['id_grupo'][0];

        #invocar métódo  e passar parâmetros
        $objAluno = new modelAluno();



        #se for válido invocar o método de iserir
        if ($objAluno->inserirAluno($nome, $cpf, $matricula, $telefone, $email, $id_grupo) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Aluno inserido com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=aluno&menu=consultar");
        } else {
            $_SESSION['msg'] = "Aluno com CPF já cadastrado!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=aluno&menu=consultar");
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
    function alterarAluno($dados) {

        #extração de dados do aluno
        $id = $dados['id_aluno'][0];
        $nome = $dados['nome'][0];
        $cpf = $dados['cpf'][0];
        $matricula = $dados['matricula'][0];
        $telefone = $dados['telefone'][0];
        $email = $dados['email'][0];


        #invocar métódo  e passar parâmetros
        $objAluno = new modelAluno();

        if ($objAluno->alterarAluno($id, $nome, $cpf, $matricula, $telefone, $email) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Aluno alterado com sucesso!";

            #redirecionar
            header("location: ../view/modulo.php?modulo=aluno&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar aluno!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=aluno&menu=consultar");
        }
    }

    /**
     * Método utilizado para validar os dados dos clientes e invocar o método excluirAluno no model
     * @access public 
     * @param Int $id id do Aluno
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluirAluno($dados) {

        #extração de dados do cliente
        $id = $dados['id_aluno'][0];

        #invocar métódo  e passar parâmetros
        $objAluno = new modelAluno();

        #invocar métódo  e passar parâmetros
        if ($objAluno->excluirAluno($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Aluno excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=aluno&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir aluno!";
            header("location: ../view/modulo.php?modulo=aluno&menu=consultar");
        }
    }

    function comboGrupos() {

        $objGrupos = new modelGrupo();
        $listarGrupos = $objGrupos->consultarGrupo(null,NULL,NULL);

        echo '<select class="form-control" name="dados[id_grupo][]" >';
        foreach ($listarGrupos as $item) {
            echo '<option value="' . $item['id'] . '">' . $item['nome'] . '</option>';
        }
        echo '</select>';
    }

}
