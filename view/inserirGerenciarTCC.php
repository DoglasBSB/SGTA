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
$objcc = new ControlGerenciarTCC();


#verfica o botão 'consultar' foi acionado
if (isset($_POST["inserir"])) {
    #passa o array de dados para inserir informações do Gerenciar TCC
    $objcc->inserirGerenciarTCC($_POST["dados"]);
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
                    <form method="post">
                        <legend>Inserir TCC</legend>
                        <div class="form-group">
                            <label for="nome">Grupo</label> <br>
                            <?php $objcc->comboGrupos() ?>
                            <label for="nome">Tema</label>
                            <input id="tema" class="form-control input-md" type="text" name="dados[tema][]" required="" placeholder="Digite o tema do TCC" maxlength="150"/>                             
                            <label for="ano">Ano</label>
                            <input id="ano" class="form-control input-md" type="text" name="dados[ano][]" required="" placeholder="Digite o ano do TCC" maxlength="6"/>                              
                            <label for="semestre">Semestre</label>
                            <select class="form-control" name="dados[semestre][]" >
                                <option value="1º Semestre">1º Semestre</option>
                                <option value="2º Semestre">2º Semestre</option>
                                <option value="3º Semestre">3º Semestre</option>
                                <option value="4º Semestre">4º Semestre</option>
                                <option value="5º Semestre">5º Semestre</option>
                                <option value="6º Semestre">6º Semestre</option>
                                <option value="7º Semestre">7º Semestre</option>
                                <option value="8º Semestre">8º Semestre</option>
                            </select> 
                            <label for="nome">Docente</label> <br>
                            <?php $objcc->comboDocentes() ?>
                            <br><br>
                            <button type="submit" name="inserir" class="btn btn-primary" style="width: 100%;"><span class="fa fa-plus-circle"></span> <b>Inserir</b></button>
                        </div>
                    </form>
                </fieldset> 
            </div>
            <!-- RODAPÉ--onsubmit="return validarEmail(this)"> -->
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
                            <!--      <a class="navbar-brand" href="#"> meu rodape</a> -->
                        </div> <!-- navbar collapse -->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <p class="navbar-text"> SGTA © 2016 - Todos os Direitos Reservados </p>
                        </div>
                    </div> <!-- conteiner fluid -->
                </nav>
            </footer>
    </body>
</html>