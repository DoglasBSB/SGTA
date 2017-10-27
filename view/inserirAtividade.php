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
$objcc = new ControlAtividade();

#verfica o botão 'consultar' foi acionado
if (isset($_POST["inserir"])) {
    #passa o array de dados para inserir atividade
    $objcc->inserirAtividade($_POST["dados"]);
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

    </head>
    <body>

        <!-- Link para o JQuery do bootstrap -->
        <script src="../bootstrap/js/jquery.min.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>

        <div class="container">
            <!-- inserir o menu -->
            <?php
            #mostrar o menu
            $objcc->menu();
            $objcc->alerta($_SESSION['msg']);
            ?> 
            <!-- Main component for a primary marketing message or call to action    required id="fase" -->
            <div class="jumbotron">
                <fieldset>
                    <legend>Inserir Atividade</legend>
                    <form method="post">
                        <div class="form-group">
                            <label for="nome_atividade">Nome</label>
                            <input class="form-control" required="" type="text" name="dados[nome_atividade][]" id="nome_atividade"  maxlength="100" placeholder="Nome da atividade"/> <br>
                            <label for="fase">Fase</label> 
                            <select class="form-control" required="" name="dados[fase][]" >
                                <option value="PPTI">PPTI</option>
                                <option value="TCC">TCC</option>
                                <option value="OUTROS">OUTROS</option>
                            </select <br>
                            <label for="prazo">Prazo</label> <br>
                            <input class="form-control" required="" type="text" name="dados[prazo][]" id="nome"  maxlength="100" placeholder="Prazo da atividade"/> <br>
                            <label for="status">Status</label> <br>
                            <select class="form-control" required="" name="dados[status][]" >
                                <option value="Iniciada">Iniciada</option>
                                <option value="Em andamento">Em andamento</option>
                                <option value="Concluida">Concluida</option>
                            </select>
                            <label for="nome">Grupo</label> <br>
                            <?php $objcc->comboGrupos() ?>
                            <br><br>
                            <button type="submit" name="inserir" class="btn btn-primary" style="width: 100%;"> <span class="fa fa-plus-circle"></span> <b>Inserir</b></button>
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
