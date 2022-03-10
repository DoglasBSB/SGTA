<?php
#iniciar_sessao
session_start();

if ($_SESSION['logado'] != 1) {
    ?>
    <script type="text/javascript">
        document.location.href = "index.php?erro=1";
    </script>
    <?php
} else {
    ?>

    <?php
#função para resolver problema de header
    ob_start();

#define codificação
    header('Content-Type: text/html; charset=UTF-8');

#cria o objeto de controle
    $objcg = new ControlGeral();
    ?>


    <html lang="pt-br" >
        <head>
            <!-- define a codificação do HTML -->
            <meta charset="utf-8">
            <script type="text/javascript"></script>

            <!-- define a o titulo do HMTL -->
            <title>.::Sistema - SGTA::.</title>

            <script type="text/javascript" src="jquery.js"></script>
            <script type="text/javascript"></script>
            
            <link rel="shortcut icon" href="bootstrap/img/favicon.ico" type="image/x-icon"/>

            <!-- Optional theme -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
            <link rel="stylesheet" href="bootstrap/css/style.css">
            <link rel="stylesheet" href="bootstrap/css/footer.css">

            <!-- Link para o CSS do bootstrap -->
            <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

            <!-- Link para o CSS do bootstrap (menu) -->
            <link href="../bootstrap/css/navbar.css" rel="stylesheet"> 

            <!-- Link para o font 
            <link rel = "stylesheet" href = "http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
            <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css"> -->

            <link rel = "stylesheet" href = "../bootstrap/css/font-awesome.min.css">

            <!-- Link para o rodapé -->
            <!--<link rel="stylesheet" href="css/footer.css"> -->
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
                $objcg->menu();
                ?> 

                <br><br>
                <div>
                    <br><br>
                </div>
                <!--arrumar-->
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <!--RODAPÉ-->
                <footer> 
                    <nav class=" navbar navbar-inverse ">
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
            </div>
        </body>
    </html>
    <?php
}

if (isset($_GET["acao"])) {

    if ($_GET["acao"] == "sair") {
        $_SESSION['logado'] = 0;
        ?>
        <script type="text/javascript">
        document.location.href = "http://localhost/sgta/index.php?erro=2";
        </script>
        <?php
    }
}
?>