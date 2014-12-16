<meta charset="utf8" />
<?
require_once '../sistema/funcoes.php';

$CONEXAO = array();
$EMPRESA = array();
$CAMINHO = array();
$USUARIO = array();
$PAGINA  = array();

$CAMINHO['inicial'] = __DIR__;

$CONEXAO = mysqli_connect('localhost', 'root', '', 'refatoracao');

$EMPRESA['ESTACIONADO'] = 'swdorigon';

//USUARIO ======================================================================
$usuario = strtolower('suporte'); //1 - Técnico
//$usuario = strtolower('pitoco');    //3 - Funcionário
$senha   = md5(strtolower('dlmsulucoesweb').'DLM2014');

$sql = "SELECT USU.PMS_CODIGO
          FROM USUARIO USU 
          JOIN PERMISSAO PMS
            ON (    USU.PMS_CODIGO = PMS.PMS_CODIGO
                 AND PMS.PMS_ATIVO = 'S'
                )
         WHERE USU.USU_LOGIN = '%s'
           AND USU.USU_SENHA = '%s' 
           AND USU.USU_ATIVO = 'S'";
$sql = sprintf($sql,$usuario,$senha);
$qry = mysqli_query($CONEXAO, $sql);
if(!$USUARIO = mysqli_fetch_array($qry,MYSQLI_ASSOC)) {
    fErroMensagem('Usuário');
}

//MENU =========================================================================
$tag_menuSuperior = '
    <body style="background-color: whitesmoke">
        <div id="wrap">
            <div class="container">
                <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #0a2d42">
                    <div class="container" style="background-color: #0a2d42">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="brand" href="#"><img src="../../empresa/testeswdorigon/imagens/logo.png" width="111" height="50" /></a>
                        </div>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav" style="font-weight:bold">
                                %s
                            </ul>
                            <div class="navbar-right">
                                <a class="navbar-brand" href="?acao=desconectar">Desconectar</a>
                            </div>
                        </div>
                    </div>
                </div><br>';
                   $tag_menu = '<li class="dropdown">
                                    <a %s >%s</a>
                                    <ul class="dropdown-menu" style="background-color: whitesmoke">
                                        %s
                                    </ul>
                                </li>';

$tag_subMenu = '<li><a href="?pg=%s" style="font-weight: bold">%s</a></li>';

$atr_subMenu = 'href="#" data-toggle="dropdown"';
$atr_Menu    = 'href="?pg=%s"';

$sql = "SELECT DISTINCT 
               MEN.MEN_NOME,
               PAG.PAG_NOME,
               PAG.SUB_CODIGO,
               SUB.SUB_NOME
          FROM PAGINA PAG
          JOIN MENU MEN
            ON (    MEN.MEN_CODIGO = PAG.MEN_CODIGO
                AND MEN.MEN_ATIVO  = 'S'
               )
     LEFT JOIN SUBMENU SUB
            ON (     SUB.MEN_CODIGO = MEN.MEN_CODIGO
                 AND SUB.MEN_CODIGO = PAG.SUB_CODIGO
                 AND SUB.SUB_ATIVO = 'S'
               )
          JOIN PERMISSAO_PAGINA_ACAO PPA
            ON (PPA.PAG_CODIGO = PAG.PAG_CODIGO)
         WHERE PAG.PAG_PRINCIPAL = 'S'
           AND PAG.PAG_ATIVO = 'S'
           AND PPA.PMS_CODIGO = %s
      ORDER BY MEN.MEN_ORDEM, SUB.SUB_ORDEM";

$impressaoMenu = array();

$sql = sprintf($sql,$USUARIO['PMS_CODIGO']);
$qry = mysqli_query($CONEXAO, $sql);
while($MENU = mysqli_fetch_array($qry, MYSQLI_ASSOC)) {
    
    $aux_Menu       = sprintf($atr_Menu,$MENU['PAG_NOME']);
    $menuSecundario = fSimNao($MENU['SUB_CODIGO'],$atr_subMenu,$aux_Menu);
    $setaSubMenu    = fSimNao($MENU['SUB_CODIGO'],'<b class="caret"></b>');
    $aux_subMenu    = sprintf($tag_subMenu,$MENU['PAG_NOME'],$MENU['SUB_NOME']);

    $impressaoMenu[] = sprintf($tag_menu, $menuSecundario,
                                          $MENU['MEN_NOME'].$setaSubMenu,
                                          fSimNao($menuSecundario,$aux_subMenu)
                              );
}

printf($tag_menuSuperior,implode('',$impressaoMenu));

//PAGINA =======================================================================
$sql = "SELECT PAG.MOD_CODIGO,
               PAG.PAG_CAMINHO,
               PAG.PAG_DESCRICAO,
               PAG.PAG_CODIGO
          FROM PAGINA PAG
         WHERE PAG.PAG_ATIVO = 'S' 
           AND PAG.PAG_NOME = '%s'";
$sql = sprintf($sql,get('pg'));
$qry = mysqli_query($CONEXAO, $sql);
$PAGINA = mysqli_fetch_array($qry, MYSQLI_ASSOC);

$tag_cabecalho = '<h2 class="page-header">%s</h2>';
printf($tag_cabecalho,$PAGINA['PAG_DESCRICAO']);

//ABA ==========================================================================

$tag_abaSuperior = '<ul class="nav nav-tabs">%s</ul>';

$tag_aba = '
    <li %s>
        <a href="?pg=%s">
            <span %s><span style="font-family: arial">&nbsp;%s</span></span>
        </a>
    </li>';
    
$sql = "SELECT DISTINCT
               ABA.ABA_NOME, 
               PAG.PAG_NOME,
               ABA_ATRIBUTO
	  FROM ABA ABA
	  JOIN PAGINA PAG
            ON (    ABA.PAG_CODIGO = PAG.PAG_CODIGO
                AND PAG.PAG_ATIVO = 'S'
                )
          JOIN PERMISSAO_PAGINA_ACAO PPA
            ON (PPA.PAG_CODIGO = PAG.PAG_CODIGO)
	 WHERE ABA.ABA_ATIVO = 'S'
           AND PAG.MOD_CODIGO = %s
           AND PPA.PMS_CODIGO = %s
      ORDER BY ABA.ABA_ORDEM ASC";

$sql = sprintf($sql,$PAGINA['MOD_CODIGO'],$USUARIO['PMS_CODIGO']);
$impressaoAba = array();

$qry = mysqli_query($CONEXAO, $sql);
while($ABA = mysqli_fetch_array($qry,MYSQLI_ASSOC)) {
    $nome = $ABA['PAG_NOME'];
    $atr  = $ABA['ABA_ATRIBUTO'];
    $ativo = fSimNao(get('pg') == $nome,'class="active"');            
    $impressaoAba[] = sprintf($tag_aba,$ativo,$nome,$atr,$ABA['ABA_NOME']);
}

printf($tag_abaSuperior,implode('',$impressaoAba));

if($PAGINA['PAG_CAMINHO']) {
    fRequire($PAGINA['PAG_CAMINHO']);
}

//AÇÕES ========================================================================
$sql = "SELECT GROUP_CONCAT(ACA.ACA_NOME) AS ACA_NOME 
	  FROM PAGINA_ACAO PAC
	  JOIN ACAO ACA
	    ON (    PAC.ACA_CODIGO = ACA.ACA_CODIGO
		AND ACA.ACA_ATIVO = 'S'
               )
          JOIN PERMISSAO_PAGINA_ACAO PPA
            ON (     PPA.PAG_CODIGO = PAC.PAG_CODIGO
                 AND PPA.ACA_CODIGO = PAC.ACA_CODIGO
	        )
         WHERE PAC.PAG_CODIGO = %s
           AND PPA.PMS_CODIGO = %s
      ORDER BY ACA_ORDEM";
$sql = sprintf($sql,$PAGINA['PAG_CODIGO'],$USUARIO['PMS_CODIGO']);
$qry = mysqli_query($CONEXAO,$sql);
$ACAO = mysqli_fetch_array($qry,MYSQLI_ASSOC);

//var_dump($ACAO);

?>
</div>
</div>
</body>
<link rel="stylesheet" href="../../framework/lib/bootstrap/3.0.3/css/bootstrap.css" />
<script src="../../framework/lib/jquery/2.11/jquery.js" ></script>
<script src="../../framework/lib/bootstrap/3.0.3/js/bootstrap.js"></script>