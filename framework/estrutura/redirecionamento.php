<?php
//Conectado
if (!empty($_SESSION["USUARIO"])) {
    
    list($modulo, $pagina) = explode("_", $_GET["pg"]);
    $_SESSION["MODULO"] = $modulo;
    $_SESSION["PAGINA"] = $pagina;
    
    if($_SESSION["PAGINA"] != "impressao" && $_SESSION["PAGINA"] != "imprimir" ) {
        require_once $DIR.'/framework/estrutura/menu.php';
    }
    
    if (empty($_GET["pg"])) {
        if(file_exists($DIR."/".$_SESSION["EMPRESA"]["ACESSO"].'/inicio.php')) {
            require_once $DIR."/".$_SESSION["EMPRESA"]["ACESSO"].'/inicio.php';
        } else {
            header("Location: ?acao=desconectar");
        }
    } else {
        if(file_exists($_SESSION["EMPRESA"]["ACESSO"]."/modulo/$modulo/$modulo.php")){
            require_once $DIR."/".$_SESSION["EMPRESA"]["ACESSO"]."/modulo/$modulo/$modulo.php";
        } else {
            require_once $DIR."/framework/moduloPadrao/$modulo/$modulo.php";
        }
        $CONSTROLER = new $modulo(); 
    }
    
//Tela de Login    
} else {
    require_once $DIR.'/framework/moduloPadrao/usuario/usuario.php';
    require_once $DIR.'/framework/acesso.php';
    $CONSTROLER = new Usuario(); 
}

