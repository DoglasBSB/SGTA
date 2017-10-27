<?php
session_start();

require_once ("model/classes/DAO/usuarioDAO.php");

$usuarioDAO = new usuarioDAO();
  
# Verifica se o usúario esta logado
if ($_SESSION['logado'] = !1) {
    ?>
    <script type="text/javascript">
        document.location.href = "view/modulo.php?modulo=principal";
    </script>
    <?php 
  }
?>
    

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="bootstrap/css/style.css">

<!-- Link para o font icones (menu)-->
<!--<link rel = "stylesheet" href = "http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css"> -->
<link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
<link rel="stylesheet" href="bootstrap/css/font-awesome.css">


<!-- Latest compiled and minified JavaScript -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../bootstrap/js/jquery.js"></script>
<script src="../bootstrap/js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="../bootstrap/js/jquery.validate.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <script type="text/javascript" src="jquery.js"></script>
        <title>.::Sistema - SGTA::.</title>

        <script type="text/javascript"></script>
        <link rel="shortcut icon" href="bootstrap/img/iconpagsgta.ico" type="image/x-icon"/>
        
   </head>
   <body>  
        <br><br><br>

        <br><div class="container">
            <div class="row vertical-offset-100">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">                                
                            <div class="row-fluid user-row">
                                <img src="bootstrap/img/logosgta.png" class="img-responsive" alt="Conxole Admin"/>
                            </div>
                        </div>

                        <div class="panel-body">
                            <form method="post" name="">
                                <fieldset>
                                    <label class="panel-login">

                                        <div class="login_result"></div>
                                    </label>

                                    <div class="input-group margin-bottom-sm">
                                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" style="font-size:20px;color:DarkOrange;text-shadow:2px 2px 4px #Black;"> </i></span>
                                        <input class="form-control" name="txtEmail"  id="email" type="text" placeholder="E-mail" required=""onsubmit="return validaEmail(this)">
                                    </div>

                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key fa-fw" style="font-size:20px;color:DarkOrange;text-shadow:2px 2px 4px #Black;"> </i></span>
                                        <input class="form-control" required="" name="txtPassword" type="password"  placeholder="Senha" automplete="off">
                                    </div>
                                    <br>


                                    <input class="btn btn-block btn-primary" type="submit"  name="btnSubmit" id="login"   class="btnSubmitLogin"value="Login" style="font-size:20px;color:DarkOrange;"> <br>

                                    <div class="form-group">

                                        <span class="pull-left">
                                            <i class="fa fa-thumbs-up" style="font-size:20px;color:DarkOrange;text-shadow:2px 2px 4px #Black;"></i>
                                            <a href=recuperarSenha.php>  Recuperar Senha? </a>
                                        </span>

                                        <span class="pull-right">
                                            <i class="fa fa-user" style="font-size:20px;color:DarkOrange;text-shadow:2px 2px 4px #Black;"></i>
                                            <a href=cadastro.php> Cadastre-se </a>
                                        </span>                                           

                                    </div>

                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>


  
<?php
if (isset($_POST['btnSubmit'])) {

    if ($usuarioDAO->login($_POST['txtEmail'], $_POST['txtPassword'])) {

        $_SESSION['logado'] = '1';
        ?>

        <script type="text/javascript">
            document.location.href = "view/modulo.php?modulo=principal";
        </script>
        <?php
    } else {
        ?>
        <script type="text/javascript">
            alert("Usuário ou senha inválido.");
            alert("Você não tem permissão para acessar o Sistema.");
        </script>
        <?php
    }
}

if (isset($_GET['erro'])) {
    switch ($_GET['erro']) {
        case "1":
            ?>
            <script type="text/javascript">
                alert("Você não tem permissão para acessar o Sistema.");
            </script>
            <?php
            break;
        case "2":
            ?>
            <script type="text/javascript">
                alert("Você saiu do Sistema.");
             </script>
            <?php
            break;
    }
}
?>