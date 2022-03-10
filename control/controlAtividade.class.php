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
 * Classe de controle da atividade
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */
class ControlAtividade extends ControlGeral {

    /**
     * Método utilizado para validar os dados das atividades cadastradas e invocar o método consultarAtividade no model
     * @access public 
     * @param Int $id id da atividade
     * @param String $nome_atividade nome_atividade da atividade
     * @return Array fase da atividade
     */
    function consultarAtividade($dados) {

        #extração de dados da atividade
        $id = $dados['id_atividade'][0];
        $nome_atividade = $dados['nome_atividade'][0];
        $fase = $dados['fase'][0];
        $prazo = $dados['prazo'][0];
        $status = $dados['status'][0];
        
        
        $objAtividade = new modelAtividade();
        return $listaAtividade = $objAtividade->consultarAtividade($id, $nome_atividade, $fase, $prazo, $status);
      
    }

    /**
     * Método utilizado validar os dados dos Alunos cadastrados e invocar o método inserirAluno no model
     * @access public 
     * @param Array $dados com os dados do Aluno
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function inserirAtividade($dados) {

        #extração de dados do Aluno
        $nome_atividade = $dados['nome_atividade'][0];
        $fase = $dados['fase'][0];
        $prazo = $dados['prazo'][0];
        $status = $dados['status'][0];       
        $id_grupo = $dados['id_grupo'][0];
        

        #invocar métódo  e passar parâmetros
        $objAtividade = new modelAtividade();

       
        #se for válido invocar o método de iserir
        if ($objAtividade->inserirAtividade($nome_atividade, $fase, $prazo, $status ,$id_grupo) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Atividade inserida com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=atividade&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao inserir atividade!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=atividade&menu=consultar");
        }
    }

    /**
     * Método utilizado validar os dados dos Alunos e invocar o método alterarAluno no model
     * @access public 
     * @param Int $id id do Aluno
     * @param String $nome_atividade nome_atividade do Aluno
     * @param String $cpf CPF do Aluno
     * @param String $matricula do Aluno
     * @param String $telefone telefone do Aluno
     * @param String $email telefone do Aluno
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function alterarAtividade($dados) {

        #extração de dados do aluno
        $id = $dados['id_atividade'][0];
        $nome_atividade = $dados['nome_atividade'][0];
        $fase = $dados['fase'][0];
        $prazo = $dados['prazo'][0];
        $status = $dados['status'][0];       
       
            
           
        #invocar métódo  e passar parâmetros
        $objAtividade = new modelAtividade();

        if ($objAtividade->alterarAtividade($id, $nome_atividade, $fase, $prazo, $status) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "Atividade alterada com sucesso!";
                     
            #redirecionar
            header("location: ../view/modulo.php?modulo=atividade&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar atividade!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=atividade&menu=consultar");
        }
    }

    /**
     * Método utilizado para validar os dados dos clientes e invocar o método excluirAluno no model
     * @access public 
     * @param Int $id id do Aluno
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluirAtividade($dados) {

        #extração de dados do cliente
        $id = $dados['id_atividade'][0];
        
        #invocar métódo  e passar parâmetros
        $objAtividade = new modelAtividade();

        #invocar métódo  e passar parâmetros
        if ($objAtividade->excluirAtividade($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "Atividade excluída com sucesso!";
            header("location: ../view/modulo.php?modulo=atividade&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir!";
            header("location: ../view/modulo.php?modulo=atividade&menu=consultar");
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
    
    public function listaGrupos($id_grupo)
    {
        $objGrupo = new modelGrupo();
        
        $grupos = $objGrupo->consultarNomeGrupoParaAtividade($id_grupo);
        
         foreach ($grupos as $item) {
            
             echo $item['nome'].'  ';
        }
    }
    
    
    

}
