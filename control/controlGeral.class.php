<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="jquery.js"></script>
        <title>.::Sistema - SGTA::.</title>


        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript"> </script>
         <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>


</head>
</html>

<?php

#iniciar_sessao
session_start();

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

/**
 * Criado em 25/02/2015
 * Classe de controle geral
 * @author Francisco Dôglas (doglas.bsb@gmail.com)
 * @version 1.0.0
 */
class ControlGeral {

    /**
     * Método utilizado para transforma para para o formato brasileiro
     * @access public 
     * @param Date $data data no formato americado (Y-m-d)
     * @return Date data no formato brasileiro (d/m/Y)
     */
    function dataBrasileiro($data) {

        if ($data == null) {
            return '';
        } else {
            return date('d/m/Y', strtotime($data));
        }
    }

    /**
     * Método utilizado para transforma para para o formato americado
     * @access public 
     * @param Date $data data no formato brasileiro (d/m/Y) 
     * @return Date data no formato americano (Y-m-d)
     */
    function dataAmericano($data) {

        if ($data == null) {
            return '';
        } else {
            return date('Y-m-d', strtotime($data));
        }
    }

    /**
     * Método utilizado para transforma para validar e-mail
     * @access public 
     * @param String $email e-mail a ser validado
     * @return Boolean retorna TRUE se o e-mail for válido
     */
    public static function validarEmail($email) {
        return preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email);
    }

   
  
    /**
     * Método utilizado para mostrar mensagens do sistema
     * @access public 
     * @param String $msg mensagem a ser exibida
     */
    function alerta($msg) {
        $alerta = '';
        if (!empty($msg)) {
            $alerta = '<div class="alert alert-info" role="alert">';
            $alerta.='<button type="button" class="close" data-dismiss="alert" >×</button>';
            $alerta.='<strong>Informação: </strong>' . $msg . '</div>';          
            echo $alerta;                
        }
    }
    
   
    /**
     * Método utilizado para mostrar o menu do sistema
     * @access public 
     * @param String $sgta nome do sistema a ser exibido
     */
    function menu($sgta =  'Sistema SGTA') {
        echo' <!--Static navbar -->';
        echo' <nav class = "navbar navbar-inverse">'; 
        
        echo' <div class = "container-fluid">';
        echo' <div class = "navbar-header">';
        echo' <button type = "button" class = "navbar-toggle collapsed" data-toggle = "collapse" data-target = "#navbar" aria-expanded = "false" aria-controls = "navbar">';
        echo' <span class = "sr-only"></span>';
        echo' <span class = "icon-bar"></span>';
        echo' <span class = "icon-bar"></span>';
        echo' <span class = "icon-bar"></span>';
        echo' </button>';
        echo' <a class = "navbar-brand" href = "modulo.php?modulo=principal"> <i class="fa fa-home" style="font-size:25px;color:DarkOrange;text-shadow:2px 4px 4px #000000; "></i>  </a>';
        echo' </div>';
        echo'  <div id = "navbar" class = "navbar-collapse collapse">';
        echo' <ul class = "nav navbar-nav">';
        
        
        #menu aluno
        echo' <li class = "dropdown">';
        echo'  <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role = "button" aria-haspopup = "true" aria-expanded = "false"> <i class="fa fa-user" style="font-size:25px;color:DarkOrange;text-shadow:2px 4px 4px #000000; "></i> Aluno <span class = "caret"></span></a>';
        echo'  <ul class = "dropdown-menu">';
        echo' <li><a href = "modulo.php?modulo=aluno&menu=consultar"><i class="icon-large icon-search"></i><span class="fa fa-search"></span> Consultar</a></li>';
        echo'  <li><a href = "modulo.php?modulo=aluno&menu=inserir"><span class="fa fa-plus"></span> Inserir</a></li>';
        echo' </ul>';
        echo' </li>';
        
        #menu docente
        echo' <li class = "dropdown">';
        echo'  <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role = "button" aria-haspopup = "true" aria-expanded = "false"> <i class="fa fa-user" style="font-size:25px;color:DarkOrange;text-shadow:2px 4px 4px #000000; "></i> Docente <span class = "caret"></span></a>';
        echo'  <ul class = "dropdown-menu">';
        echo' <li><a href = "modulo.php?modulo=docente&menu=consultar"><i class="icon-large icon-search"></i><span class="fa fa-search"></span> Consultar</a></li>';
        echo'  <li><a href = "modulo.php?modulo=docente&menu=inserir"><span class="fa fa-plus"></span> Inserir</a></li>';
        echo' </ul>';
        echo' </li>';

   
        
        
        #menu grupo
        echo' <li class = "dropdown">';
        echo'  <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role = "button" aria-haspopup = "true" aria-expanded = "false"> <i class="fa fa-group" style="font-size:25px;color:DarkOrange;text-shadow:2px 4px 4px #000000; "></i> Grupo <span class = "caret"></span></a>';
        echo'  <ul class = "dropdown-menu">';
        echo' <li><a href = "modulo.php?modulo=grupo&menu=consultar"><i class="icon-large icon-search"></i><span class="fa fa-search"></span> Consultar</a></li>';
        echo'  <li><a href = "modulo.php?modulo=grupo&menu=inserir"><span class="fa fa-plus"></span> Inserir</a></li>';
        echo' </ul>';
        echo' </li>';
        
        #menu Gerenciar TCC
        echo' <li class = "dropdown">';
        echo'  <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role = "button" aria-haspopup = "true" aria-expanded = "false"> <i class="fa fa-graduation-cap" style="font-size:25px;color:DarkOrange;text-shadow:2px 4px 4px #000000; "></i> Gerenciar TCC <span class = "caret"></span></a>';
        echo'  <ul class = "dropdown-menu">';
        echo' <li><a href = "modulo.php?modulo=gerenciartcc&menu=consultar"><i class="icon-large icon-search"></i><span class="fa fa-search"></span> Consultar</a></li>';
        echo'  <li><a href = "modulo.php?modulo=gerenciartcc&menu=inserir"><span class="fa fa-plus"></span> Inserir</a></li>';
            
        #DOWNLOAD E UPLOAD
        echo'  <li><a href = "modulo.php?modulo=gerenciartcc&menu=download"><span class="fa fa-download"></span> Download Doc. TCC</a></li>';
        echo'  <li><a href = "modulo.php?modulo=gerenciartcc&menu=upload"><span class="fa fa-upload"></span> Upload</a></li>';
       
        #CRONOGRAMA TCC (ATIVIDADES)
        echo' <li><a href = "modulo.php?modulo=gerenciartcc&menu=consultarcronograma"><i class="icon-large icon-search"></i><span class="fa fa-calendar-o"></span> Cronograma </a></li>';
             
        echo' </ul>';
        echo' </li>';
        
        #menu Atividade
        echo' <li class = "dropdown">';
        echo'  <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role = "button" aria-haspopup = "true" aria-expanded = "false"> <i class="fa fa-file-text" style="font-size:25px;color:DarkOrange;text-shadow:2px 4px 4px #000000; "></i> Atividade <span class = "caret"></span></a>';
        echo'  <ul class = "dropdown-menu">';
        echo' <li><a href = "modulo.php?modulo=atividade&menu=consultar"><i class="icon-large icon-search"></i><span class="fa fa-search"></span> Consultar</a></li>';
        echo'  <li><a href = "modulo.php?modulo=atividade&menu=inserir"><span class="fa fa-plus"></span> Inserir</a></li>';
        echo' </ul>';
        echo' </li>';
        
        #menu Relatorio
        echo' <li class = "dropdown">';
        echo'  <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role = "button" aria-haspopup = "true" aria-expanded = "false"> <i class="fa fa-clipboard" style="font-size:25px;color:DarkOrange;text-shadow:2px 4px 4px #000000; "></i> Relatório <span class = "caret"></span></a>';
        echo'  <ul class = "dropdown-menu">';
        echo' <li><a href = "modulo.php?modulo=relatorio&menu=consultaralunos"><i class="icon-large icon-search"></i><span class="fa fa-search"></span> Alunos </a></li>';
        echo' <li><a href = "modulo.php?modulo=relatorio&menu=consultargrupos"><i class="icon-large icon-search"></i><span class="fa fa-search"></span> Grupos </a></li>';
        #echo' <li><a href = "modulo.php?modulo=relatorio&menu=consultarcronograma"><i class="icon-large icon-search"></i><span class="fa fa-calendar"></span> Cronograma </a></li>';
        
        echo' </ul>';
        echo' </li>';
        
       
        echo' </ul>';
        echo'<ul class="nav navbar-nav navbar-right">';
        echo'<li class="dropdown">';
        echo' <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Usuário <span class="caret"></span></a>';
        echo'<ul class="dropdown-menu">';
        echo'<li><a href="#"> <i class="fa fa-key" style="font-size:20px;color:DarkOrange;text-shadow:2px 4px 4px #000000; "></i> Alterar senha </a></li>';
                
     
        echo'<li><a href="#"> <i class="fa fa-info-circle" style="font-size:20px;color:DarkOrange;text-shadow:2px 4px 4px #000000; "></i> Sobre </a></li>';
        echo'<li role="separator" class="divider"></li>';
        echo'<li> <a href="?acao=sair"> <i class="fa fa-sign-out" style="font-size:20px;color:DarkOrange;text-shadow:2px 4px 4px #000000;  "></i> Sair </a></li>';          
        echo' </ul>';
        echo'</li>';
        echo'</ul>';
        echo' </div><!--/.nav-collapse -->';
        echo' </div><!--/.container-fluid -->';
        echo' </nav>';
        
       
        
    }
}
?>