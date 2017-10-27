<?php

class conexao {//abre o escopo da classe

    var $host = "localhost"; //atributos da classe
    var $user = "root";
    var $senha = "";
    var $banco = "sgta";

//metodos da classes
    function conecta_banco() {
        @mysql_connect($this->host, $this->user, $this->senha) or die(mysql_error());
        mysql_select_db($this->banco);
    }

// Fecha função
}
//fecha o escopo da classe

//criando um objeto
$objeto = new conexao; // instanciando a classe conexao
$objeto->conecta_banco(); // Chama a função que conecta com o servidor
?>

