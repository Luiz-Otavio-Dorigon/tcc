<?php
$tag_menu = '
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="redireciona.php"> '.$_SESSION["EMPRESA"]["INICIO"].'</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">';
         $tag_menuAux = '
             <li class="dropdown">
                <a href="?pg=%s" class="dropdown-toggle" %s>%s<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    %s
                </ul>
             </li>';
         $tag_subMenu .= '
            <li><a href="?pg=%s">%s</a></li>';
            $CONEXAO->setSql("SELECT * FROM MENU M, PAGINA P 
                    WHERE P.MEN_CODIGO = M.MEN_CODIGO 
                    AND P.PAG_ORDEM = 1 
                    AND M.MEN_ATIVO = 'S' 
                    AND P.PAG_ATIVO = 'S' 
                    ORDER BY M.MEN_ORDEM");
            foreach ($CONEXAO->dadoBanco() as $MENU){
                $CONEXAO->setSql("SELECT * FROM SUBMENU S, PAGINA P 
                       WHERE P.SUB_CODIGO = S.SUB_CODIGO 
                       AND S.MEN_CODIGO = {$MENU["MEN_CODIGO"]} 
                       AND S.SUB_ATIVO = 'S' 
                       AND P.PAG_ATIVO = 'S' 
                       ORDER BY S.SUB_ORDEM");
               $aux_subMenu = '';
               foreach ($CONEXAO->dadoBanco() as $SUBMENU) {
                   $aux_subMenu .= sprintf($tag_subMenu, $SUBMENU['PAG_NOME'], $SUBMENU["SUB_NOME"]);
               }
               $tag_menu .= sprintf($tag_menuAux, $MENU["PAG_NOME"], fSimNao($aux_subMenu,'data-toggle="dropdown"'), $MENU["MEN_NOME"], $aux_subMenu); 
            }
            $tag_menu .= '
            </ul>
            <div class="navbar-right">
                <a class="navbar-brand" href="?acao=desconectar">Desconectar</a>
            </div>
        </div>
    </div>
</div>';
echo $tag_menu;