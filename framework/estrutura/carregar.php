<?php
require_once $DIR.'/framework/carregar.php';
if ($_SERVER["HTTP_HOST"] == 'localhost') {
    if (fVazio($_SESSION["EMPRESA"]["CAMINHO"])) {
        $_SESSION["EMPRESA"]["CAMINHO"] = strtoupper(get('empresa'));
        $_SESSION["EMPRESA"]["ACESSO"] = 'empresa/'.strtolower($_SESSION["EMPRESA"]["CAMINHO"]);
    }
    if (!fVazio($_SESSION["EMPRESA"]["CAMINHO"])) {
        $CONEXAO = new Conexao("localhost", "lod310893");
          if(file_exists($DIR.'/'.$_SESSION["EMPRESA"]["ACESSO"].'/configuracao.php')){
              require_once $DIR.'/'.$_SESSION["EMPRESA"]["ACESSO"].'/configuracao.php';
          } else {
              session_destroy();
          }
        
    }else {
        require_once $DIR.'/framework/estrutura/head.php';
        require_once $DIR.'/framework/empresas.php';
    }
} else {
    $server = explode(".", $_SERVER['HTTP_HOST']);
    $server = $server[0];
    $_SESSION["EMPRESA"]["CAMINHO"] = strtoupper($server);
    $_SESSION["EMPRESA"]["ACESSO"] = 'empresa/'.strtolower($_SESSION["EMPRESA"]["CAMINHO"]);
    if (!fVazio($_SESSION["EMPRESA"]["CAMINHO"]) || !fVazio($server)) {
        $CONEXAO = new Conexao("mysql.hostinger.com.br", "lod310893");
        require_once $DIR.'/'.$_SESSION["EMPRESA"]["ACESSO"].'/configuracao.php';
    } else {
        exit("Nenhuma empresa selecionada!");
    }
}