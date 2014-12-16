<?php
$tag_menuSuperior = '
    <div class="container" style="text-align: center; padding:2%% 1%% 2%% 0%%; margin-top: -50px;">
        <ul class="pull-right" style="margin-right: 22px">
            <a href="?pg=usuario_novo&acao=alterar&usu_codigo=%s">%s</a>
            <a>|</a>
            <a href="?acao=desconectar">Sair</a>
        </ul>

        <span class="font-titulo">%s</span>
        
        <a class="pull-left" href="?pg">
            <img src="%s/imagens/logo.png" 
               style="max-width:100px; max-height: 150px"/>
        </a>
    </div>
    <div class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            %s
        </ul>
    </div>
    ';

$tag_menu = '
    <li class="dropdown">
        <a href="?pg=%s" %s >%s</a>
        <ul class="dropdown-menu">
        %s
        </ul>
     </li>';

$tag_subMenu = '<li><a href="?pg=%s">%s</a></li>';

$menuSuspenso = array();
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
               $menuSuspenso[] = sprintf($tag_menu, $MENU["PAG_NOME"], fSimNao($aux_subMenu,'data-toggle="dropdown"'), $MENU["MEN_NOME"]."<b class='caret'></b>", $aux_subMenu); 
            }
printf($tag_menuSuperior,$_SESSION['USUARIO']['USU_CODIGO'],
                         $_SESSION['USUARIO']['USU_NOME'],
                         $_SESSION['EMPRESA']['INICIO'],
                         $_SESSION['EMPRESA']['ACESSO'],
                         implode('',$menuSuspenso)
      );