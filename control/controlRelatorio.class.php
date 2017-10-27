<?php
#iniciar_sessao
session_start();

#carregar as classes dinamicamente
require_once 'autoload.php';
require('relatorios/fpdf/fpdf.php');

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

/**
 * Criado em 25/02/2015
 * Classe de controle do emitir relatorio
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */
class ControlRelatorio extends ControlGeral {

    /**
     * Método utilizado para validar os dados dos Alunos cadastrados e invocar o método consultarAluno no model
     * @access public 
     * @param Int $id id do Aluno
     * @param String $nome nome do Aluno
     * @return Array dados do Aluno
     */
    function consultarAluno($dados) {

        #extração de dados do aluno
        $nome = $dados[nome][0];
        $id = $dados[id_aluno][0];

        $objAluno = new modelAluno();
        return $listaAluno = $objAluno->consultarAluno($id, $nome,$cpf,$matricula);
    }

    /**
     * Método utilizado para validar os dados dos Grupos cadastrados e invocar o método consultarGrupo no model
     * @access public 
     * @param Int $id id do Grupo
     * @param String $nome nome do Grupo
     * @return Array dados do Grupo
     */
    function consultarGrupo($dados) {

        #extração de dados do cliente
        $nome = $dados[nome][0];
        $id = $dados[id_grupo][0];
        $email = $dados[email][0];
        $nomealunos = $dados[nomealunos][0];

        $objGrupo = new modelGrupo();
        return $listaGrupo = $objGrupo->consultarGrupo($id, $nome, $email, $nomealunos);
    }

   
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
     * Método utilizado para validar os dados dos docentes cadastrados e invocar o método consultarAluno no model
     * @access public 
     * @param Int $id id da atividade
     * @param String $nome_atividade nome_atividade da atividade
     * @return Array fase da atividade
     */
    function consultarAtividade($dados) {

        #extração de dados do cliente
        $id = $dados[id_atividade][0];
        $nome_atividade = $dados[nome_atividade][0];
        $fase = $dados[fase][0];
        $prazo = $dados[prazo][0];
        $status = $dados[status][0];
        
        
        $objAtividade = new modelAtividade();
        return $listaAtividade = $objAtividade->consultarAtividade($id, $nome_atividade, $fase, $prazo, $status);
      
    }
    
    
    
    
}
