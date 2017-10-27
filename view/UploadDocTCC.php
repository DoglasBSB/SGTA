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
                <legend>Gerenciar Doc. TCC (Upload)</legend> 
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">

                                <?php
                                if (isset($_POST['botao'])) {
                                    $arq = $_FILES['arquivo']['name'];

                                    $arq = str_replace(" ", "_", $arq);
                                    $arq = str_replace("Ç", "C", $arq);

                                    if (file_exists("arquivos/$arq")) {
                                        $a = 1;

                                        while (file_exists("arquivos/[$a]$arq")) {
                                            $a++;
                                        }

                                        $arq = "[" . $a . "]" . $arq;
                                    }


                                    if (move_uploaded_file($_FILES['arquivo']['tmp_name'], "arquivos/" . $arq)) {


                                        $zip = new Zipar();
                                        $zip->ziparArquivos($arq, $arq . ".zip", "arquivos/");
                                        unlink("arquivos/$arq");

                                        $sqlInto = "INSERT INTO tb_arquivos (nome) VALUES (:nome)";
                                        try {

                                            $into = $db->prepare($sqlInto);
                                            $into->bindValue(":nome", $arq . ".zip", PDO::PARAM_STR);
                                            if ($into->execute()) {

                                                echo '<div class="res"> <b> Upload realizado com sucesso! <span></span></b></div>';
                                                echo '<br>';
                                            }
                                        } catch (PDOException $e) {
                                            echo $e->getMessage();
                                        }
                                    } else {

                                        echo'<div class="res"> <b>Upload não realizado !<span></span></b>  </div>';
                                        echo '<br>';
                                    }
                                }
                                ?>                       



                                <form action="" enctype="multipart/form-data" name="upload" method="post">
                                    <div id="nome_arquivo">
                                        <span class="nome_arquivo"></span>

                                        <input type="file" name="arquivo"/>
                                    </div>
                                    <br>
                                    <button type="submit" name="botao"  value="Upload" class="btn btn-primary" style="width: 15%;"><span class="fa fa-upload"></span> <b>Upload</b></button>
                                </form>
                                </tbody>
                                </table>                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
            <div class="jumbotron">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordred table-striped">
                                    <thead>
                                    <th>Nome do Documento</th> 
                                    <th>Excluir</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sqlReady = "SELECT * FROM tb_arquivos WHERE id=id";
                                        try {

                                            $ready = $db->prepare($sqlReady);
                                            $ready->execute();
                                        } catch (PDOException $e) {
                                            echo $e->getMessage();
                                        }

                                        while ($rs = $ready->fetch(PDO::FETCH_OBJ)) {
                                            ?>

                                            <tr>
                                               <!-- <td> <?php echo $rs->id ?></td>-->
                                                <td> <?php echo $rs->nome ?></td>

                                                <td><p data-placement='top' data-toggle='tooltip' title='Excluir'><button class='btn btn-primary btn-sm' data-title='Delete' data-toggle='modal' data-target='#excluir{$item[id]}'><span class='fa fa-trash'></span></button></p></td>

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