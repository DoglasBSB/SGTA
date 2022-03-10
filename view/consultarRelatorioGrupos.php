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
$objcc = new ControlRelatorio();

$objcc = new ControlGrupo();



#verfica o o botão 'consultar' foi acionado
/*if (isset($_POST["consultargrupos"])) {
    #passa o id e nome para consultar
    $grupos = $objcc->consultarGrupo($_POST["dados"]);
} else {
    #mostrar todos os grupos
    $grupos = $objcc->consultarGrupo($_POST["dados"]);
}
?>
*/

// verfica o o botão 'gerar' foi acionado
if (isset($_POST["gerar"])) {
// passa o id e nome para consultar
    $objcc->gerarRelatorioGrupo($_POST);
}

#verfica o botão 'consultar' foi acionado
if (isset($_POST["consultargrupos"])) {
    #passa o id e nome para consultar
    $grupos = $objcc->consultarGrupo($_POST["dados"]);
} else {
    #mostrar todos os grupos
    $grupos = $objcc->consultarGrupo($_POST["dados"]);
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
            ?> 

            <div class="jumbotron">
                <legend>Relatório dos Grupos  
                    <div align="right"> <a href=relatorios/relatorioGrupos.php>
                        <button type="submit" class="btn btn-primary" id="gerar" style="width: 15%;">
                             Gerar Relatório 
                        </button></a> 
                    </div> 
                    <br>
                </legend>

                 <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordred table-striped">
                                    <tbody>
                                        <?php
                                        #foreach para listar os dados dos grupos
                                        foreach ($grupos as $item) {
                                            echo "<tr>";
                                            echo "<td> Grupo: {$item['nome']} "
                                            . " <br>   Alunos: ";
                                            $objcc->listaAlunos($item['id']);
                                            echo ""
                                            . " <br> E-mail: {$item['email']} </td>";
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
         <!--
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
                        <!--
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <p class="navbar-text"> SGTA © 2016 - Todos os Direitos Reservados </p>
                        </div>
                    </div> <!-- conteiner fluid -->
                    <!--
                </nav>
            -->
         <!--
         </footer>
        -->

</body>
</html>

