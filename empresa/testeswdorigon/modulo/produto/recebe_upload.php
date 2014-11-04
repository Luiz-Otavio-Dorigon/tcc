<?php
error_reporting(~E_ALL);

$_UP['pasta'] = $DIR.$_SESSION['EMPRESA']['ACESSO'].'/arquivos/produto/';
$_UP['tamanho'] = 1024 * 1024 * 2; //2Mb
$_UP['extensoes'] = array('jpg', 'png', 'gif');
$_UP['renomeia'] = true;
$_UP['erros'][1] = 'o arquivo excede o limite do PHP.';
$_UP['erros'][2] = 'o arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'o upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'não foi possível efetuar o upload do arquivo';

$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));

if (array_search($extensao, $_UP['extensoes']) === false) {
    $_UP['erros'][5] = 'por favor, selecione arquivos com as seguintes extensões: jpg, png ou gif';
    $_FILES['arquivo']['error'] = 5;
}
if ($_FILES['arquivo']['error'] != 0) {
    echo '<div class="alert alert-danger">A imagem não foi enviada, '.$_UP['erros'][$_FILES['arquivo']['error']].'</div>';
} else {
    if ($_UP['renomeia'] == true) {
        $_SESSION['NOME_ARQUIVO'] = $_POST['PRO_CODIGO'].'.jpg';
    } else {
        $_SESSION['NOME_ARQUIVO'] = $_FILES['arquivo']['name'];
    }
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'].$_SESSION['NOME_ARQUIVO']);
}