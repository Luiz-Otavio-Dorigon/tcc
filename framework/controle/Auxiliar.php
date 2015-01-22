<?php
require_once $DIR.'/framework/outros/ferramentas.php';

class Auxiliar {

    protected $modulo;
    protected $chave;
    protected $chaveValor;
    protected $campo;
    protected $aba;
    protected $conexao;
    protected $nomePagina;
    protected $this;
    protected $sql;
    protected $sqlConsulta;
    protected $sqlCondicao;
    protected $multi;
    protected $apelido;
    protected $sqlOrdem;
    protected $atrForm;
    
    function __construct() {
        global $CONEXAO;

        //Geral
        $this->modulo = strtolower(get_called_class());
        $this->apelido = $CONEXAO->dadoBanco("MODULO",sprintf("MOD_NOME LIKE '%s'", $this->modulo))[0]["MOD_APELIDO"];
        $this->chave = $this->apelido . "_CODIGO";
        $this->nome = $this->apelido . "_NOME";
        
        $this->sqlCondicao = fCoalesce($this->sqlCondicao, fSimNao(!$this->sqlConsulta," ","  AND ")  .$this->apelido . "_ATIVO = " . fSimNao(fIsPagina($this->modulo . '_lixeira'), "'N'", "'S'"));
        
         $this->sqlOrdem = "ORDER BY $this->apelido"."_NOME";
        
        $this->sqlConsulta = fCoalesce( fSimNao($this->sqlConsulta, $this->sqlConsulta .$this->sqlCondicao), "SELECT * FROM ".strtoupper($this->modulo)." WHERE $this->sqlCondicao ");
//        $this->sqlConsulta = fCoalesce( fSimNao($this->sqlConsulta, $this->sqlConsulta .$this->sqlCondicao), "SELECT * FROM '".strtoupper($this->modulo)."' `$this->apelido` WHERE $this->sqlCondicao");
        $this->sqlConsulta .= " " . $this->sqlOrdem;

        if (strtolower($_SESSION["MODULO"]) == $this->modulo) {

            //Outros
            $this->aba = $_SESSION["PAGINA"];
            $modulo = $this->consulta("MODULO", "MOD_CODIGO = (SELECT MOD_CODIGO FROM MODULO WHERE MOD_NOME = '$this->modulo')")[0];
            
            $this->nomePagina = $modulo["MOD_DESCRICAO"];
            
            $this->chaveValor = fPostGet(strtolower($this->chave));

            //Seta Chave
            $this->setCampo($this->chave, "Código", 100, "texto", false);
            $this->this->setChave(true);
            $this->this->setVisivelFormulario(false);

            //Seta Nome
            $this->setCampo($this->nome, "Nome", 100, "texto", true, true);

            //Incia os campos
            $this->iniciarCampos();

            //Inicia os valores
            $this->setValores();

            //Fazer permissão para imprimir num futuro
            if($_SESSION["PAGINA"] == "impressao"){
                $this->listar();
                exit();                
            }   
            
            if($_SESSION["PAGINA"] == "imprimir"){
                $this->imprimir();
                exit();
            }
            
            //Verifica permissao
            $this->verificaPermissao();
            //Monta Descrição e Aba
            $this->montaCabecalho();                

            //Verifica ações padrão
            $this->acaoPadrao();

            //Listar ou Formulario
            $this->paginaPadrao();
        }
    }
    
    public function setAtrForm($str){
        $this->atrForm = $str;
    }
    
    public function getAtrForm(){
        return $this->atrForm;
    }


    public function setCombo($clase,$adicional="") {
        global $DIR;
        if(file_exists($DIR."/".$_SESSION["EMPRESA"]["ACESSO"]."/modulo/".strtolower($clase)."/".strtolower($clase).".php")){
            require_once $DIR."/".$_SESSION["EMPRESA"]["ACESSO"]."/modulo/".strtolower($clase)."/".strtolower($clase).".php";
        } else {
            require_once $DIR."/framework/moduloPadrao/".strtolower($clase)."/".strtolower($clase).".php";
        }
        $PADRAO = new $clase();
        $this->setSql($PADRAO->getSqlConsulta());
        foreach ($this->consulta() as $ITENS) {
            if(empty($adicional)) {
                $this->this->setOption($ITENS[$PADRAO->chave], $ITENS[$PADRAO->nome]);
            } else {
                $this->this->setOption($ITENS[$PADRAO->chave], $ITENS[$PADRAO->nome],$adicional."@=@". fValor($ITENS[$adicional],'G') );
            }
        }
    }

    public function mensagem($cond, $msg = "") {
        $this->setSql("SELECT A.ACA_NOME AS ERRO,
        IF((SELECT MOD_GENERO FROM MODULO WHERE MOD_NOME = '$this->modulo') = 'M', A.ACA_OK,
        CONCAT(SUBSTR(A.ACA_OK, 1, LENGTH(A.ACA_OK)-1), 'a')) AS OK
        FROM ACAO A
        WHERE A.ACA_NOME = '" . fPostGet("acao") . "'");

        $msg_banco = $this->consulta()[0];
        
        $this->setSql("SELECT MOD_DESCRICAO FROM MODULO WHERE MOD_NOME = '{$_SESSION["MODULO"]}'");
        
        $mod_descricao = $this->consulta()[0];
        
        $acao["OK"] = $msg_banco["OK"];
        $acao["ERRO"] = $msg_banco["ERRO"];

        $acao["MSG"] = fSimNao($cond, $acao["OK"], $acao["ERRO"]);
        $sim = $mod_descricao["MOD_DESCRICAO"] . " " . $acao["MSG"] . " com sucesso!";
        $nao = "Erro ao " . fSimNao($cond, $acao["OK"], $acao["ERRO"]) . " " . $mod_descricao["MOD_DESCRICAO"];
        echo '<div class="alert alert-' . fSimNao($cond, "success", "danger") . '">' . fSimNao($msg, $msg, fSimNao($cond, $sim, $nao)) . '</div>';
    }

    public function listar() {
        global $DIR;
        
        if (get("pg") == $this->modulo."_impressao") {
            echo '<table width="100%">';
            echo '<tr>';
            echo '<td style="width:20%"><img src="empresa/'.strtolower($_SESSION["EMPRESA"]["CAMINHO"]).'/imagens/logo.png" width="80px"></td>';
            echo '<td><h3>Listagem de '.  ucfirst($this->modulo).'s</h3></td>';
            echo '</tr>';
            echo '</table><hr>';
        }
        
        if (get('pg') == "tarefa_listar") {
            $checkbpx = '
                <form method="post" name="form_tarefa">
                    <table>
                        <tr>
                            <td>
                            <label>Situação:&nbsp</label>
                            </td>
                            <td>
                                <select class="form-control"  name="opcao-tarefa" onchange="form_tarefa.submit()"  >
                                    <option value="">Todas</option>
                                    <option %s value="= 6">Canceladas</option>
                                    <option %s value="= 5">Concluídas</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <br />
                </form>';
         printf(
                $checkbpx,
                fSimNao($_POST["opcao-tarefa"] =='= 6' ,'selected="selected"'),
                fSimNao($_POST["opcao-tarefa"] =='= 5' ,'selected="selected"')
        );
        }
        $tag_listagem = '<table id="example" class="table table-striped">
                <thead>
                    <tr>%s
                        <th></th>
                    </tr>
                </thead>';

        $tag_campo = '';

        //Cabeçalho
            $cont = 0;
        foreach ($this->getCampo() as $campo) {
            if ($campo->getVisivelLista($campo)) {
                $tag_campo .= '<th>' . $campo->getDescricao() . '</th>';
                if(get("pg") == "produto_listar" && $cont == 0) {
                    $tag_campo .= '<th>Imagem</th>';
                    $cont = 1;
                }
            }
        }

        $tag_listagem = sprintf($tag_listagem, $tag_campo);

        //Listagem Vazia
        $this->setSql($this->sqlConsulta);
        $registro = $this->consulta();

        if (count($registro) == 0) {
            $tag_listagem .= '
                <tr>
                    <td colspan="100%">
                        <br>
                        <div class="alert alert-info">
                            Não há registros de ' . ucfirst($this->modulo) .
                    '</div>
                    </td>
                </tr>
            </table>';
            echo $tag_listagem;
            return;
        }
        
        //Listagem
        $ex[] = array();
        foreach ($registro as $key => $REGISTRO) {
            $tag_campo = '';
            foreach ($this->getCampo() as $nome => $campo) {
                if ($campo->getVisivelLista($campo)) {
                    $dado = $campo->campoListar($REGISTRO[$nome], $campo);
                    $tag_campo .= '<td>' . $dado . '</td>';
                    if(get("pg") == "produto_listar") {
                        $img = $_SESSION['EMPRESA']['ACESSO'].'/arquivos/produto/'.$REGISTRO['PRO_CODIGO'].'.jpg';
                        if (!in_array($img, $ex)) {
                            $ex[] = $img;
                            if (file_exists($DIR."/".$img)) {
                                $tag_campo .= '<td><a href="'.$img.'" target="_blank">Visualizar Produto</a></td>';
                            } else {
                                $tag_campo .= '<td></td>';
                            }
                        }
                    }
                }
            }

            $tag_listagem .= '<tr> %s %s </tr>';

            $condicao = $this->consulta("MODULO", "MOD_CODIGO = (SELECT MOD_CODIGO FROM MODULO WHERE MOD_NOME = '$this->modulo')")[0];
            $mod_codigo = $condicao['MOD_CODIGO'];
            
            $condicao = $this->consulta("ABA", "PAG_CODIGO = (SELECT PAG_CODIGO FROM PAGINA WHERE PAG_NOME = '" . get("pg") . "' AND MOD_CODIGO = '$mod_codigo')")[0];
            $aba_codigo = $condicao['ABA_CODIGO'];

            $sql_acao = "
                SELECT DISTINCT 
                       AB.ABC_NOME,
	               A.ACA_NOME,
	               A.ACA_DESCRICAO,
                       A.ACA_ATRIBUTO,
                       A.ACA_ACTION
	          FROM ABCABAACAO AB, ACAO A
                 WHERE AB.ACA_CODIGO = A.ACA_CODIGO
                    %S
                   AND AB.MOD_CODIGO = '$mod_codigo'
                   AND A.ACA_NOME <> 'listar'
                   AND AB.ABA_CODIGO = '$aba_codigo'";
            $this->setSql(sprintf($sql_acao, fSimNao(fAdministrador(), "", "AND AB.PER_CODIGO = 3")));
            $tag_acao = '<td></td>';
            if ($acao = $this->consulta()) {
                if ($_POST['listar'] && !empty($_POST['opcao-tarefa'])) {
                    unset($acao[0]);
                    unset($acao[1]);
                }
                $tag_acao = '<td class="text-right">
                             <div class="btn-group">
                                 <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                     <span class="glyphicon glyphicon-align-justify"></span> <span class="caret"></span>
                                 </button>
                                 <ul class="dropdown-menu" role="menu">
                                     %s 
                                 </ul>
                             </div>
                         </td>';

                $tag_botao = '';
                foreach ($acao as $ACAO) {
                    $action = fSimNao($ACAO[ACA_ACTION],get("pg"),$this->modulo."_".$ACAO[ABC_NOME]);
                        $tag_botao .= "
                        <li>
                            <a class='btn' href='?pg=$action&".strtolower($this->chave)."={$REGISTRO[$this->chave]}&acao=$ACAO[ACA_NOME]''>
                                <span {$ACAO[ACA_ATRIBUTO]}> <span style='color: black; font-family: arial;'>$ACAO[ACA_DESCRICAO]</span></span>
                            </a>
                        </li>";
                }
                $tag_acao = sprintf($tag_acao, $tag_botao);
            }
            $tag_listagem = sprintf($tag_listagem, $tag_campo, $tag_acao);
        }
        $tag_listagem .= '</table>';
        echo $tag_listagem;
    }

    public function verificaPermissao() {
        global $CONEXAO;
        $CONEXAO->setSql("SELECT A.ACA_CODIGO FROM ACAO A WHERE A.ACA_NOME = '".fPostGet("acao")."'");
        $condicao = "MOD_CODIGO = (SELECT MOD_CODIGO FROM MODULO WHERE MOD_NOME = '$this->modulo')" . fSimNao(fPostGet("acao"), " AND ACA_CODIGO = '" . $this->consulta()[0]['ACA_CODIGO'] . "'");
        
        $condicao .= fSimNao(fAdministrador(), "", " AND PER_CODIGO = 3");
        $permiteAcao = $this->consulta("ABCABAACAO", $condicao)[0];
        
        $condicao1 = "PAG_NOME = '".get('pg')."'";
        $condicao1 .= fSimNao(fAdministrador(), "", " AND PER_CODIGO = 3");        
        $permitePagina = $this->consulta("PAGINA", $condicao1)[0];

        if (empty($permiteAcao) || empty($permitePagina)) {
            exit($this->mensagem("", "Você não tem privilégio para acessar essa ação ou página"));
        }
    }

    public function acaoPadrao() {
        //Inserir Padrão
        if (fPostGet("acao") == "Incluir") {
            $this->mensagem($this->inserir(strtoupper($this->modulo), $this->getCampoValorArray(), true));
            if ($this->modulo == "tarefa") {
                $this->setSql("SELECT TAR.TAR_CODIGO FROM TAREFA TAR ORDER BY TAR.TAR_CODIGO DESC LIMIT 1");
                $this->setSql("INSERT INTO TAREFA_SITUACAO (TAR_CODIGO, SIT_CODIGO, USU_CODIGO) VALUES (".$this->consulta()[0][TAR_CODIGO].", 1, ".$_SESSION[USUARIO][USU_CODIGO].")");
                $this->consulta();
            }
        }

        //Excluir ou Restaurar Padrão
        if (fIn(fPostGet("acao"), "excluir", "restaurar")) {
            $this->mensagem($this->atualizar(strtoupper($this->modulo), array($this->apelido . "_ATIVO" => fSimNao(fPostGet("acao") == "excluir", "N", "S")), $this->chave . " = " . $this->chaveValor));
        }

        //Altera Padrão
        if (fPostGet("acao") == "Alterar") {
            $this->chaveValor = fPostGet($this->chave);
            $this->mensagem($this->atualizar(strtoupper($this->modulo), $this->getCampoValorArray(), $this->chave . ' = ' . $this->chaveValor,$this->multi));
        }
        
        //Trocar Situação Padrão
        if (fPostGet("acao") == "trocar") {
             $sit_codigo = $this->consulta("PEDIDO", $this->chave . ' = ' . $this->chaveValor)[0]['SIT_CODIGO'];
             
             $this->setSql("SELECT GROUP_CONCAT(SIT_CODIGO) SITUACAO
                              FROM  SITUACAO SIT 
                                   ,MODULO `MOD`
                             WHERE SIT.MOD_CODIGO = `MOD`.MOD_CODIGO
                               AND `MOD`.MOD_NOME LIKE '%$this->modulo%'
                       ORDER BY SIT.SIT_ORDEM");
            $situacao = $this->consulta()[0]['SITUACAO'];
            $sit_nova = explode(',',strstr($situacao,$sit_codigo));
            $sit_nova = fCoalesce($sit_nova[1],$sit_nova[0]);
             
            $msg = "Situação Trocada com Sucesso!";
            $this->mensagem($this->atualizar(strtoupper($this->modulo),array("SIT_CODIGO" => $sit_nova) , $this->chave . ' = ' . $this->chaveValor),$msg);
        
        }

        if (fIn(post("acao"), "Alterar", "Incluir")) {
            $this->acaoFK();
        }
    }

    public function paginaPadrao() {
        global $DIR;
        //Listar Padrão
        if ($_SESSION["PAGINA"] == 'listar' || $_SESSION["PAGINA"] == 'lixeira') {
            $this->listar();
        }
        if ($_SESSION["PAGINA"] == 'relatorio') {
            require_once $DIR."/".$_SESSION["EMPRESA"]["ACESSO"]."/modulo/relatorio/$this->modulo.php";
        }

        //Formulario Padrão
        if ($_SESSION["PAGINA"] == 'novo') {
            $this->form();
        }
    }

    public function consulta($tabela = "", $condicao = "") {
        global $CONEXAO;
        return $CONEXAO->dadoBanco(strtoupper($tabela), $condicao);
    }

    public function setSql($sql) {
        global $CONEXAO;
        $CONEXAO->setSql($sql);
    }

    public function montaCabecalho() {
        global $CONEXAO;
        if ($_SESSION["PAGINA"] == "listar"){
            echo '<div style="text-align: right"><a target="_blank" href="?pg='.$this->modulo.'_impressao" title="Clique aqui para imprimir"><span class="glyphicon glyphicon-print" style="color: silver"></span></a></div>';
        }
        
        $tag_cabecalho = '<div class="h2">%s %s</div><hr/>';
        $CONEXAO->setSql("SELECT P.PAG_DESCRICAO FROM PAGINA P, ABA A WHERE P.PAG_CODIGO = A.PAG_CODIGO AND P.MEN_CODIGO = A.MEN_CODIGO AND P.PAG_NOME = '" . get("pg") . "'");
        printf($tag_cabecalho, fSimNao(fIsPagina($this->modulo . '_novo'), fSimNao($this->chaveValor, "Alterar", "Incluir")), (get("acao") == "detalhar_tarefa") ? "Detalhes da Tarefa" : $this->consulta()[0]["PAG_DESCRICAO"]);

        echo "<ul class='nav nav-tabs'>";
        $item = "<li %s><a href='?pg=%s'><span %s> <span style='font-family: arial'>%s</span></span></a></li>";
        $sql_aba = "
        SELECT DISTINCT
        A.ABA_NOME,
        A.ABA_ATRIBUTO,
        P.PAG_NOME
        FROM ABA A
        LEFT JOIN ABCABAACAO AC
        ON( A.ABA_CODIGO = AC.ABA_CODIGO
        AND A.MOD_CODIGO = AC.MOD_CODIGO)
        LEFT JOIN PAGINA P
        ON (P.PAG_CODIGO = A.PAG_CODIGO 
        AND P.MEN_CODIGO = A.MEN_CODIGO)
        WHERE A.MOD_CODIGO = (SELECT MOD_CODIGO FROM MODULO WHERE MOD_NOME = '$this->modulo')
        %S
        %S
        AND A.ABA_ATIVO = 'S'
        ORDER BY A.ABA_ORDEM";
        $this->setSql(sprintf($sql_aba, fSimNao(fAdministrador(), "", "AND AC.PER_CODIGO = 3"), fSimNao(fAdministrador(), "", "AND P.PER_CODIGO = 3")));
        foreach ($this->consulta() as $ABA) {
            printf($item, fSimNao(fIsPagina($ABA["PAG_NOME"]), 'class="active"'), $ABA["PAG_NOME"], $ABA["ABA_ATRIBUTO"], $ABA["ABA_NOME"]);
        }

        echo '</ul><br/>';
    }

    function setValores() {
        foreach ($this->getCampo() as $nome => $campo) {
            $campo->setValor(fCoalesce($_POST[$nome],$campo->getValor()));
        }
    }

    public function getCampoValorArray() {
        $DADOS = array();
        foreach ($this->campo as $nome => $campo) {
            $DADOS[str_replace("[]", "", $nome)] = $this->retornaFormatado($campo);
        }
        return $DADOS;
    }

    public function retornaFormatado($campo) {
        if ($campo->getTipo() == 'valor') {
            return str_replace(',', '.', str_replace('.', '', $campo->getValor()));
        }
        return $campo->getValor();
    }

    public function getCampo($nome = "") {
        if (!empty($nome)) {
            return $this->campo[$nome];
        }
        return $this->campo;
    }

    public function getSqlConsulta() {
        return $this->sqlConsulta;
    }

    public function setOption($valor, $descricao) {
        $this->this->setOption($valor, $descricao);
    }

    public function setCampo($nome, $descricao, $tamanho, $tipo, $visivelLista = false, $obrigatorio = false) {
        $this->campo[$nome] = new Campo($nome, $descricao, $tamanho, $tipo, $obrigatorio, $visivelLista);
        $this->this = $this->campo[$nome];
    }

    public function this() {
        return $this->this;
    }

    public function getChave() {
        return $this->chave;
    }

    public function getChaveValor() {
        return $this->chaveValor;
    }

    public function setVisivelFormulario($visivel) {
        return $this->this->setVisivelFormulario($visivel);
    }

    public function getMulti() {
        return $this->multi;
    }

    public function setMulti($tabela) {
        $this->this->setMulti();
        $this->multi[$tabela][] = $this->this->getNome();
    }

    public function destruirMulti($tabela) {
        unset($this->multi[$tabela]);
    }

    public function getValorChave() {
        global $CONEXAO;
        return $CONEXAO->getValorChave();
    }

    public function inserir($tabela, $dados, $gravaCodigoPrincipal = false) {
        global $CONEXAO;
        if ($tabela != "TAREFA_SITUACAO") {
            return $CONEXAO->inserir($tabela, $dados, $gravaCodigoPrincipal);
        }
    }

    public function atualizar($tabela, $dados, $condicao, $multi = '') {
        global $CONEXAO;
        return $CONEXAO->atualizar($tabela, $dados, $condicao,$multi);
    }

    public function excluir($tabela, $condicao) {
        global $CONEXAO;
        if ($tabela != "TAREFA_SITUACAO") {
            return $CONEXAO->excluir($tabela, $condicao);
        }
    }
    
    function iniciarCampos() {}
}
