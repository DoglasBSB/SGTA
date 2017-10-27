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

require_once("Zipar.php");
require_once("bd_arquivos.php");
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
        <link rel="stylesheet" type="text/css" media="all" href="css/estilo.css"/>
        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="/bootstrap/js/funcoes.js"></script>

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
            ?> 

            <div class="jumbotron">               
                <legend>Gerenciar Doc. TCC (Download)</legend> 
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table cellpadding="3" cellspacing="0" border="0">
                                    <thead>
                                        <tr>
                                            <!-- <td width="30"><b>Id</b></td>-->
                                            <td width="200"><b>Nome do Documento</b></td>
                                            <td width="130"><b>Download</b></td>    
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $sqlReady = "SELECT * FROM tb_arquivos";
                                        try {

                                            $ready = $db->prepare($sqlReady);
                                            $ready->execute();
                                        } catch (PDOException $e) {
                                            echo $e->getMessage();
                                        }

                                        while ($rs = $ready->fetch(PDO::FETCH_OBJ)) {
                                            ?>

                                            <tr> 
                                              <!--  <td> <?php echo $rs->id ?></td>-->
                                                <td> <?php echo $rs->nome ?></td>
                                                <td> <br><a href="arquivos/<?php echo $rs->nome ?>"> <button type="submit" name="botao"  value="download" class="btn btn-primary" style="width: 35%;"><span class="fa fa-download"></span> <b></b></button></a></td>
                                        <br>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
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
                                <span class="sr-only">  </span> 
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