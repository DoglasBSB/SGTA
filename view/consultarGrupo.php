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
$objcc = new ControlGrupo();

#verfica  o botão 'consultar' foi acionado
if (isset($_POST["consultar"])) {
    #passa o id e nome para consultar
    $grupos = $objcc->consultarGrupo($_POST["dados"]);
} else {
    #mostrar todos as grupos
    $grupos = $objcc->consultarGrupo($_POST["dados"]);
}

#verificar se o botão "alterar" foi acionado
if (isset($_POST["alterar"])) {
    #passa os novos dados dos grupos para o controle realizar a alteração
    $objcc->alterarGrupo($_POST["dados"]);
    #mostrar dados dos grupos selecionado depois de alterado
    $grupos = $objcc->consultarGrupo(null);
}

#verificar se o botão "excluir" foi acionado
if (isset($_POST["excluir"])) {
    #passa o id do grupo para o controle realizar a exclusão
    $objcc->excluirGrupo($_POST["dados"]);
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
            #mostrar o menu para o ator
            $objcc->menu();

            #mostra  as mensagens para o ator
            $objcc->alerta($_SESSION['msg']);
            ?> 

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <fieldset>
                    <legend>Consultar Grupo</legend>
                    <form method="post">
                        <div class="form-group">

                            <label for="nome" class="control-label">Nome do Grupo</label>
                            <input type="text" class="form-control" required=" " placeholder="nome" name="dados[nome][]">
                        </div>
                        <button type="submit" class="btn btn-primary" name="consultar" style="width: 100%;"> <span class="fa fa-search"></span><b> Consultar</b></button>
                    </form>
                </fieldset> 
            </div>

            <div class="jumbotron">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordred table-striped">
                                    <thead>
                                    <th>Nome do Grupo</th>
                                    <th>Nome dos Alunos</th>
                                    <th>Email</th>
                                    <th>Alterar</th>
                                    <th>Excluir</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        #foreach para listar os dados dos grupos
                                        foreach ($grupos as $item) {
                                            echo "<tr>";
                                            echo "<td> {$item['nome']} </td>";
                                            echo "<td>";
                                            $objcc->listaAlunos($item['id']);
                                            echo "</td>";
                                            echo "<td> {$item['email']} </td>";

                                            echo "<td><p data-placement='top' data-toggle='tooltip' title='Alterar'><button class='btn btn-primary btn-sm' data-title='Alterar' data-toggle='modal' data-target='#alterar{$item['id']}'><span class='fa fa-pencil'></span></button></p></td>";
                                            echo "<td><p data-placement='top' data-toggle='tooltip' title='Excluir'><button class='btn btn-primary btn-sm' data-title='Delete' data-toggle='modal' data-target='#excluir{$item['id']}'><span class='fa fa-trash'></span></button></p></td>";
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            #foreach para listar os dados do grupo e define cada modal para alterar
            foreach ($grupos as $item) {
                ?>
                <!-- modal de alterar -->
                <div class="modal fade" id="alterar<?php echo $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Alterar Grupo</h4>
                            </div>
                            <div class="modal-body">

                                <?php
                                #pegar o valor do id do grupo
                                $dados['id_grupo'][0] = $item['id'];

                                #método para selecionar o grupo desejado
                                $grupos_alterar = $objcc->consultarGrupo($dados);

                                #inclui a view alterar atividade
                                include 'alterarGrupo.php';
                                ?>       

                            </div>
                        </div>
                    </div>
                </div> 
                <?php
            }
            ?>

            <?php
            #foreach para listar os grupos 
            foreach ($grupos as $item) {
                ?>
                <!-- modal de exluir -->
                <div class="modal fade" id="excluir<?php echo $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="fa fa-remove" aria-hidden="true"></span></button>
                                <h4 class="modal-title custom_align" id="Heading">Excluir Grupo</h4>
                            </div>
                            <div class="modal-body">

                                <?php
                                #pegar o valor do id do grupo
                                $dados['id_grupo'][0] = $item['id'];

                                #método para selecionar o grupo desejado
                                $grupos_excluir = $objcc->consultarGrupo($dados);
                                #inclui a view alterar grupo
                                include 'excluirGrupo.php';
                                ?>       
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?> 

            <!-- Script -->
            <script>
                $(document).ready(function () {
                    $("#mytable #checkall").click(function () {
                        if ($("#mytable #checkall").is(':checked')) {
                            $("#mytable input[type=checkbox]").each(function () {
                                $(this).prop("checked", true);
                            });

                        } else {
                            $("#mytable input[type=checkbox]").each(function () {
                                $(this).prop("checked", false);
                            });
                        }
                    });

                    $("[data-toggle=tooltip]").tooltip();
                });
            </script>

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

