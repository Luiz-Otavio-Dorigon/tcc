<?
//Configurações básicas
$_SESSION["EMPRESA"]["DESCRICAO_ABA"] = "Artigos em Madeira e MDF";
$_SESSION["EMPRESA"]["INICIO"] = "SWDorigon";

if ($_SERVER["HTTP_HOST"] == 'localhost') {
    $CONEXAO->setUsuario("root");
    $CONEXAO->setBase("TCC");
} else {
    //ConfiguraÃ§Ã£o do banco de dados
    $CONEXAO->setUsuario("u455146490_tcc");
    $CONEXAO->setBase("u455146490_tcc");
}