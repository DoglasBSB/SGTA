<?php

#carrega as classes automaticamente
include_once 'autoload.php';

#verifica qual modulo e qual menu é o escolhido
$modulo = $_GET["modulo"];
$menu = $_GET["menu"];

switch ($modulo) {
    #modulo aluno
    case 'aluno':
        switch ($menu) {
            #menu consultar
            case 'consultar':
                include 'consultarAluno.php';
                break;
            #menu inserir
            case 'inserir':
                include 'inserirAluno.php';
                break;
        }
        break;
    #modulo docente   
    case 'docente':
        switch ($menu) {
            #menu consultar
            case 'consultar':
                include 'consultarDocente.php';
                break;
            #menu inserir
            case 'inserir':
                include 'inserirDocente.php';
                break;
        }
        break;
    #modulo grupo   
    case 'grupo':
        switch ($menu) {
            #menu consultar
            case 'consultar':
                include 'consultarGrupo.php';
                break;
            #menu inserir
            case 'inserir':
                include 'inserirGrupo.php';
                break;
        }

        break;

    #modulo atividade   
    case 'atividade':
        switch ($menu) {
            #menu consultar
            case 'consultar':
                include 'consultarAtividade.php';
                break;
            #menu inserir
            case 'inserir':
                include 'inserirAtividade.php';
                break;
        }
        break;

    #modulo gerenciar tcc
    case 'gerenciartcc':
        switch ($menu) {
            #menu consultar
            case 'consultar':
                include 'consultarGerenciarTCC.php';
                break;
            #menu inserir
            case 'inserir':
                include 'inserirGerenciarTCC.php';
                break;
            // menu Download
            case 'download':
                include 'DownloadDocTCC.php';
                break;
            // menu Upload
            case 'upload':
                include 'UploadDocTCC.php';
                break;

            #    consultar relatorio Cronogrma TCC
            case 'consultarcronograma':
                include 'consultarCronogramaTCC.php';
                break;
        }
        break;


    // modulo relatorio
    case 'relatorio':
        switch ($menu) {
            // menu consultar relatorio alunos
            case 'consultaralunos':
                include 'consultarRelatorioAlunos.php';
                break;
            //menu consultar relatorio grupos
            case 'consultargrupos':
                include 'consultarRelatorioGrupos.php';
                break;
            //menu consultar relatorio Cronogrma TCC
            case 'consultarcronograma':
                include 'consultarCronogramaTCC.php';
                break;
        }
        break;

    default:
        #menu padrão
        include 'principal.php';
        break;
}
