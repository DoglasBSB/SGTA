<?php

#não mostrar erros de notice
error_reporting(E_ALL & ~E_NOTICE & E_WARNING);

#carrega todas as classes dinamicamente
function __autoload($classes) {
    #pastas onde tem classes
    $diretorios = array('../control/', '../model/', '../view/');
    foreach ($diretorios as $valor) {
        if (file_exists($valor . $classes . '.class.php')) {
            require_once $valor . $classes . '.class.php';
        }
    }
}

?>