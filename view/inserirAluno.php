<?php
#iniciar_sessao
session_start();

#função para resolver problema de header
ob_start();

#define codificação
header('Content-Type: text/html; charset=UTF-8');

#carrega as classes automaticamente
include_once 'autoload.php';

#cria o objeto de controle
$objcc = new ControlAluno();

#verfica o botão 'consultar' foi acionado
if (isset($_POST["inserir"])) {
    #passa o array de dados para inserir o aluno
    $objcc->inserirAluno($_POST["dados"]);
}
?>

<html lang="pt-br">
    <head>
        <!-- define a codificação do HTML -->
        <meta charset="utf-8">

        <!-- define a o titulo do HMTL -->
        <title>Sistema SGTA</title>

        <!-- Link para o CSS do bootstrap -->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Link para o CSS do bootstrap (menu) -->
        <link href="../bootstrap/css/navbar.css" rel="stylesheet">

        <!-- Link para o JQuery do bootstrap -->
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>
        <script src="../public/js/mascara.js"></script> 
        <script src="../bootstrap/js/jquery.maskedinput.js" type="text/javascript"></script>
        <script src="../bootstrap/js/jquery.validate.js" type="text/javascript"></script>
        <script src="../public/js/aluno.js"></script>
        <script src="../bootstrap/js/bootstrap-datepicker.js" type="text/javascript"></script>
        <script src="../bootstrap/js/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>

    </head>
    <body>

        <div class="container">
            <!-- inserir o menu -->
            <?php
            #mostrar o menu
            $objcc->menu();

            #mostra  as mensagens para o ator
            $objcc->alerta($_SESSION['msg']);
            ?> 

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <fieldset>
                    <form method="post"  id="formAluno">
                        <legend>Inserir Aluno</legend>
                        <div class="form-group">
                            <div>
                                <label for="nome">Nome</label>
                                <input id="nome" class="form-control input-md" type="text" name="dados[nome][]" required="" placeholder="Digite seu nome" maxlength="150"/>                             
                            </div>
                            <div>                      
                                <label for="cpf">CPF</label>
                                <input id="cpf" class="form-control input-md"  name="dados[cpf][]" type="text" required="" placeholder="Digite o CPF somente números"  maxlength="14" title="" >                   
                                <span id="validacaocpf" style="display: none" class="help-block"> <b>CPF Inválido!</b> </span>
                            </div>
                            <div>
                                <label for="matricula">Matrícula</label>
                                <input class="form-control" id="matricula" name="dados[matricula][]" type="text" required="" placeholder="Digite a sua matricula"   maxlength="6">
                            </div>
                            <div>
                                <label for="telefone">Telefone</label>
                                <input class="form-control input-md" id="telefone" name="dados[telefone][]" type="text" required="" placeholder="Qual seu telefone?" maxlength="14" >
                            </div>
                            <div>
                                <label for="email">E-mail</label>
                                <input id="email" class="form-control input-md" name="dados[email][]" type="email"  required="" placeholder="Digite o seu e-mail para contato" maxlength="150"> 
                            </div>
                            <br>
                            <label for="nome">Grupo</label> <br>
                            <?php $objcc->comboGrupos() ?>
                            </br>
                            <button type="submit" name="inserir" class="btn btn-primary" style="width: 100%;"><span class="fa fa-plus-circle"></span> <b>Inserir</b></button>
                        </div>
                    </form>
                </fieldset> 
            </div>
            <!-- RODAPÉ-->
            <footer> 
                <nav class=" navbar navbar-inverse">
                    <div class='container-fluid'>
                        <div class='navbar-header'>
                            <button type="button" class="navbar-toggle collapse" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only"> roda pe </span> 
                                <span class="icon-bar">  </span> 
                                <span class="icon-bar">  </span> 
                                <span class="icon-bar">  </span> 
                            </button>
                        </div> <!-- navbar collapse -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <p class="navbar-text"> SGTA © 2016 - Todos os Direitos Reservados </p>
                        </div>
                    </div> <!-- conteiner fluid -->
                </nav>
            </footer>
    </body>
</html>


