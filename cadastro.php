<?php
require_once ("model/classes/DAO/usuarioDAO.php");
require_once("model/classes/Entidade/usuario.php");

require_once ("model/classes/DAO/senhaDAO.php");
require_once("model/classes/Entidade/senha.php");

$usuarioDAO = new usuarioDAO();
$senhaDAO = new senhaDAO();

$usuario = new usuario();
$senha = new senha();
?>

<!DOCTYPE html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css"> 
<link rel="stylesheet" href="bootstrap/css/style.css">

<link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">

<!-- Link para o font icones (menu)-->
<link rel = "stylesheet" href = "http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<script src="../bootstrap/js/jquery.js"></script>
<script src="../bootstrap/js/jquery.maskedinput.js" type="text/javascript"></script>
<script src="../bootstrap/js/jquery.validate.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="../bootstrap/js/bootstrap-datepicker.pt-BR.min.js" type="text/javascript"></script>
<script src="../bootstrap/js/ie10-viewport-bug-workaround.js"></script>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="pt-br">
    <head>
        <meta charset="UTF-8"> 
        <title>.::Cadastro - SGTA.::</title>
        <script type="text/javascript" src="jquery.js"></script>
        <script type="text/javascript"></script>
        <!-- <link rel="shortcut icon" href="bootstrap/img/iconpagsgta.png" >  -->
        <link rel="shortcut icon" href="bootstrap/img/iconpagsgta.ico" type="image/x-icon"/> 
    </head>
    <body> 
        <br><div class="container">
            <div class="row vertical-offset-100">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">                                
                            <div class="row-fluid user-row">
                                <img src="bootstrap/img/logosgtacad.png" class="img-responsive" alt="Conxole Admin"/>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form method="post" name="">
                                <fieldset>
                                    <div class="input-group margin-bottom-sm">
                                        <span class="input-group-addon"><i class="fa fa-user fa-fw" style="font-size:20px;color:DarkOrange;text-shadow:2px 2px 4px #Black;"> </i></span> 
                                        <input class="form-control"  name="txtNome"  id="nome" type="text" placeholder="Digite seu nome de Usuário" required="" autocomplete="off" >
                                    </div>
                                    <br>          
                                    <div class="input-group margin-bottom-sm">
                                        <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" style="font-size:20px;color:DarkOrange;text-shadow:2px 2px 4px #Black;"> </i></span> 
                                        <input class="form-control input-md"  name="txtEmail"  id="email" type="email" placeholder="Digite seu Email" required="" onsubmit="validarEmail(this)" autocomplete="off" >
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key fa-fw" style="font-size:20px;color:DarkOrange;text-shadow:2px 2px 4px #Black;"> </i></span>
                                        <input onKeyUp="validarSenha('txtPass', 'txtPassAccept', 'resultadoCadastro');" required="" id="txtPass" name="txtPass" type="password" class="form-control"   placeholder="Digite sua Senha" autocomplete="off">
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key fa-fw" style="font-size:20px;color:DarkOrange;text-shadow:2px 2px 4px #Black;"> </i></span>
                                        <input onKeyUp="validarSenha('txtPass', 'txtPassAccept', 'resultadoCadastro');" required=""  id="txtPassAccept" name="txtPassAccept" type="password" class="form-control" name="txtPassword"  placeholder="Confirme sua Senha" autocomplete="off">
                                    </div>
                                    <td colspan="2"> <p id="resultadoCadastro" style="font-weight: bold;"> &nbsp;</p></td>
                                    <tr>
                                        <td colspan="2">
                                            <input class="btn btn-block btn-default " type="submit"  name="btnSubmit" id="login"   class="btnSubmit" value="Cadastrar" style="font-size:17px;color:#d58512;">
                                        </td>
                                    </tr>
                                    <br>
                                    <tr>
                                        <td colspan="2" >
                                            <a href="index.php"><input class="btn btn-block btn-default"   value="Voltar" style="font-size:17px;color:#d58512;">  </a>
                                        </td>
                                    </tr>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>     


<?php
if (isset($_POST['btnSubmit'])) {
    $usuario->setUs_nome($_POST['txtNome']);
    $usuario->setUs_email($_POST['txtEmail']);


    if (!$usuarioDAO->consultarEmail($_POST['txtEmail'])) {

        if ($usuarioDAO->cadastrar($usuario)) {

            $codigoUsuario = $usuarioDAO->consultarCodUsuario($_POST['txtEmail']);

            /* @var $_POST type */
            $senha->setUs_senha($_POST['txtPassAccept']);
            $senha->setUs_cod($codigoUsuario);

            if ($senhaDAO->cadastrar($senha)) {
                ?>
                <script type = "text/javascript">
                    document.getElementById("resultadoCadastro").innerHTML = "Usuário cadastrado com sucesso.";
                    document.getElementById("resultadoCadastro").style.color = "green";</script>
                <?php
            } else {
                ?>
                <script type="text/javascript">
                    document.getElementById("resultadoCadastro").innerHTML = "Erro ao cadastrar.";
                    document.getElementById("resultadoCadastro").style.color = "red";</script>
                <?php
            }
        }
    } else {
        ?>
        <script type="text/javascript">
            document.getElementById("resultadoCadastro").innerHTML = "O E-mail informado já esta cadastrado.";
            document.getElementById("resultadoCadastro").style.color = "red";</script>
        <?php
    }
}
?>
