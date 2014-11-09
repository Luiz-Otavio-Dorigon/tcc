<?php
$DIR = dirname(__FILE__);
session_start();
$_SESSION["SCRIPT"] = '';

//Controle de Versões
$_SESSION["jquery"]["versao"] = '2.11'; //1.11

require_once $DIR.'/framework/estrutura/carregar.php';
?> 
<!DOCTYPE HTML>
<html lang="pt-br">
    <?
    $CONEXAO->conectar();
    require_once $DIR.'/framework/estrutura/head.php';
    require_once $DIR.'/framework/estrutura/body.php';
    require_once $DIR.'/framework/estrutura/script.php';
    $CONEXAO->desconectar();
    
    $_SESSION["SCRIPT"] = '';
    ?>
</html>