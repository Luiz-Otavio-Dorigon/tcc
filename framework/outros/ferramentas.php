<?
//Retira caracteres de uma string ==============================================
function fApenasLetra($string) {
    return preg_replace("/[^a-zA-Z_\s]/", "", $string);
}

function fApenasNumeros($string) {
    return preg_replace("/[^0-9]/", "", $string);
}

//Formata valor ================================================================
function fFormataData($data) {
    if (empty($data)) {
        return '';
    } else if (strlen($data) == 10 ) {
        return date('d/m/Y', strtotime($data));
    }
    return str_replace(" ", " às ", date('d/m/Y H:i', strtotime($data)));
}

function fValor($numero, $tipo='', $prefixo='') {
    //Tipo M utilizado para formatar o número em listas com o prefixo especificado
    if($tipo == 'M')
//        return $prefixo.' '.number_format($numero,2,',','');
        return trim(fCoalesce($prefixo,'').' '.number_format($numero,2,',',''));
    //Tipo G retorna o número para gravar no Banco de Dados
    if($tipo == 'G')
        return $numero;
    return str_replace(",", ".", str_replace(".", "", $numero));   
}

function fFormataCpfCnpj($cpfcnpj) {
    $output = fApenasNumeros($cpfcnpj);
    $size = (strlen($output) - 2);
    if ($size != 9 && $size != 12) {
        return false;
    }
    $mask = ($size == 9) ? '###.###.###-##' : '##.###.###/####-##';
    $index = -1;
    for ($i = 0; $i < strlen($mask); $i++) {
        if ($mask[$i] == '#') {
            $mask[$i] = $output[++$index];
        }
    }
    return $mask;
}

function fFormataTelefone($fone) {
    $fone = fApenasNumeros($fone);
    $fone = '(' . substr($fone, 0, 2) . ') ' . substr($fone, 2, 4) . '-' . substr($fone, 6);
    return $fone;
}

//Pega valor ===================================================================
function get($string) {
    return fCoalesce($_GET[$string]);
}

function post($string) {
    return fCoalesce($_POST[$string]);
}

function fPostGet($str) {
    return fCoalesce($_POST[$str], $_GET[$str], $_FILES[$str]);
}

//Validações ===================================================================
function fIsPagina($pagina) {
    return $_GET["pg"] == $pagina;
}

function fVazio($str) {
    return !empty($str) ? false : true;
}

function fSimNao($cond, $s, $n = "") {
    return !empty($cond) ? $s : $n;
}

function fCoalesce() {
    foreach (func_get_args() as $arg)
        if (!empty($arg))
            return $arg;
    return "";
}

function fIn($string) {
    foreach (func_get_args() as $indice => $arg) {
        if ($indice == 0)
            continue;
        if ($string == $arg)
            return true;
    }
    return false;
}

function fAdministrador() {
    return $_SESSION["USUARIO"]["PER_CODIGO"] == 2;
}

//Outros =======================================================================
function pr($string) {
    echo "<pre>";
    print_r($string);
    echo "</pre>";
}

function fEnviaScript($script) {
    $_SESSION["SCRIPT"] =  " <script> ";
    $_SESSION["SCRIPT"] .= $script;
    $_SESSION["SCRIPT"] .= " </script> ";
}

function fMontaLinksPaginacao() {
    ?>
    <div style="text-align: center;">
        <ul class="navegacao">
            <? if ($_SESSION['pagina_atual'] == 1) { ?>
                <li class="active">Primeira</li>
                <li class="active">Anterior</li>
            <? } else { ?>
                <li>
                    <a href="?pagina=1">Primeira</a>
                </li>
                <li>
                    <a href="?pagina=<?= $_SESSION['pagina_atual'] - 1; ?>">Anterior</a>
                </li>
                <?
            }
            foreach (array_reverse(range($_SESSION['pagina_atual'] - 1, $_SESSION['pagina_atual'] - 5)) as $_SESSION['pagina']) {
                if ($_SESSION['pagina'] > 0) {
                    ?>
                    <li>
                        <a href="?pagina=<?= $_SESSION['pagina']; ?>">
                            <?= $_SESSION['pagina']; ?>
                        </a>
                    </li>
                    <?
                }
            }
            ?>
            <li class="active"><?= $_SESSION['pagina_atual']; ?></li>
            <? foreach (range($_SESSION['pagina_atual'] + 1, $_SESSION['pagina_atual'] + 5) as $_SESSION['pagina']) { ?>
                <? if ($_SESSION['pagina'] < $_SESSION['paginas']) { ?>
                    <li>
                        <a href="?pagina=<?= $_SESSION['pagina']; ?>">
                            <?= $_SESSION['pagina']; ?>
                        </a>
                    </li>
                    <?
                }
            }
            ?>
            <? if ($_SESSION['pagina_atual'] == $_SESSION['paginas']) { ?>
                <li class="active">Pr&oacute;xima</li>
                <li class="active">&Uacute;ltima</li>
                <? } else { ?>
                <li>
                    <a href="?pagina=<?= $_SESSION['pagina_atual'] + 1; ?>">Pr&oacute;xima</a>
                </li>
                <li>
                    <a href="?pagina=<?= $_SESSION['paginas']; ?>">
                        &Uacute;ltima
                    </a>
                </li>
            <? } ?>
        </ul>
    </div>
    <?
}
?>