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
 * Classe de controle do gerenciar TCC
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */
class ControlGerenciarTCC extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos Alunos cadastrados e invocar o método consultarGerenciarTCC no model
     * @access public 
     * @param Int $id id do gerenciarTCC
     * @param String $tema tema do TCC
     * @return Array dados do TCC
     */
    function consultarGerenciarTCC($dados) {

        #extração de dados do gerenciar tcc
        $id = $dados[id_gerenciartcc][0];
        $tema = $dados[tema][0];
        $ano = $dados[ano][0];
        $semestre = $dados[semestre][0];
       
        $objGerenciarTCC = new modelGerenciarTCC();
        return $listaGerenciarTCC = $objGerenciarTCC->consultarGerenciarTCC($id, $tema, $ano, $semestre);
}

    /**
     * Método utilizado validar os dados dos Alunos cadastrados e invocar o método inserirAluno no model
     * @access public 
     * @param Array $dados com os dados do Aluno
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */


    
      


  


    function inserirGerenciarTCC($dados) {

        #extração de dados do Aluno
        $tema = $dados[tema][0];
        $ano = $dados[ano][0];
        $semestre = $dados[semestre][0];
        $id_grupo = $dados[id_grupo][0];
        $id_docente = $dados[id_docente][0];
        
        #invocar métódo  e passar parâmetros
        $objGerenciarTCC = new modelGerenciarTCC();
        
        #se for válido invocar o método de iserir
        if ($objGerenciarTCC->inserirGerenciarTCC($tema, $ano, $semestre, $id_grupo, $id_docente) == true) {
            #se for inserido com sucesso mostrar a mensagem
            $_SESSION['msg'] = "TCC inserido com sucesso!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=gerenciartcc&menu=consultar");
        } else   {
            $_SESSION['msg'] = "Erro ao inserir TCC!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=gerenciartcc&menu=consultar");
        }
    }

    /**
     * Método utilizado validar os dados dos Alunos e invocar o método alterarAluno no model
     * @access public 
     * @param Int $id id do Aluno
     * @param String $tema tema do Aluno
     * @param String $cpf CPF do Aluno
     * @param String $matricula do Aluno
     * @param String $telefone telefone do Aluno
     * @param String $email telefone do Aluno
     * @return Boolean retorna TRUE se os dados forem salvos com sucesso
     */
    function alterarGerenciarTCC($dados) {

        #extração de dados do aluno
        $id = $dados[id_gerenciartcc][0];
        $tema = $dados[tema][0];
        $ano = $dados[ano][0];
        $semestre = $dados[semestre][0];
      
       
   
        #invocar métódo  e passar parâmetros
        $objGerenciarTCC = new modelGerenciarTCC();

        if ($objGerenciarTCC->alterarGerenciarTCC($id, $tema, $ano, $semestre) == true) {
            #se for alterado com sucesso mostrar a mensagem
            $_SESSION['msg'] = "TCC alterado com sucesso!";
                     
            #redirecionar
            header("location: ../view/modulo.php?modulo=gerenciartcc&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao alterar TCC!";
            #redirecionar
            header("location: ../view/modulo.php?modulo=gerenciartcc&menu=consultar");
        }
    }

    /**
     * Método utilizado para validar os dados dos clientes e invocar o método excluirAluno no model
     * @access public 
     * @param Int $id id do Aluno
     * @return Boolean retorna TRUE se os dados for excluído sucesso
     */
    function excluirGerenciarTCC($dados) {

        #extração de dados do cliente
        $id = $dados[id_gerenciartcc][0];
        
        #invocar métódo  e passar parâmetros
        $objGerenciarTCC = new modelGerenciarTCC();

        #invocar métódo  e passar parâmetros
        if ($objGerenciarTCC->excluirGerenciarTCC($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "TCC excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=gerenciartcc&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir TCC!";
            header("location: ../view/modulo.php?modulo=gerenciartcc&menu=consultar");
        }
    } 
    
    
    
   /* 
    function cronogramaGerenciarTCC($dados) {

        #extração de dados do cliente
        $id = $dados[id_gerenciartcc][0];
        
        #invocar métódo  e passar parâmetros
        $objGerenciarTCC = new modelGerenciarTCC();

        #invocar métódo  e passar parâmetros
        if ($objGerenciarTCC->excluirGerenciarTCC($id) == true) {
            #se for excluído com sucesso mostrar a mensagem e redirecionar
            $_SESSION['msg'] = "TCC excluído com sucesso!";
            header("location: ../view/modulo.php?modulo=gerenciartcc&menu=consultar");
        } else {
            $_SESSION['msg'] = "Erro ao excluir TCC!";
            header("location: ../view/modulo.php?modulo=gerenciartcc&menu=consultar");
        }
    } 
    */
    
     

    
    function comboGrupos() {

        $objGrupos = new modelGrupo();
        $listarGrupos = $objGrupos->consultarGrupo(null,NULL,NULL);

        echo '<select class="form-control" name="dados[id_grupo][]" >';
        foreach ($listarGrupos as $item) {
            echo '<option value="' . $item[id] . '">' . $item[nome] . '</option>';
        }
        echo '</select>';
    }
    
    
    function comboDocentes() {

        $objDocentes = new modelDocente();
        $listarDocentes = $objDocentes->consultarDocente(null,NULL,NULL);

        echo '<select class="form-control" name="dados[id_docente][]" >';
        foreach ($listarDocentes as $item) {
            echo '<option value="' . $item[id] . '">' . $item[nome] . '</option>';
        }
        echo '</select>';
    }
    
    
    
    
    public function listaGrupos($id_grupo)
    {
        $objGrupo = new modelGrupo();
        
        $grupos = $objGrupo->consultarNomeGrupo($id_grupo);
        
         foreach ($grupos as $item) {
            
             echo $item[nome].'  ';
        }
    }
    
    
    
     public function listaDocentes($id_docente)
    {
        $objDocente = new modelDocente();
        
        $docentes = $objDocente->consultarNomeDocente($id_docente);
        
         foreach ($docentes as $item) {
            
             echo $item[nome].'  ';
        }
    }
    
    
}
    
    
    
 
    
    
   
   
    
    


