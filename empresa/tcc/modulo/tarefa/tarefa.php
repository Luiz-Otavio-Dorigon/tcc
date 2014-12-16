<?php

class Tarefa extends Crud {

    function __construct() {
        
        $this->sqlConsulta = "
                SELECT  TAR.*, 
                            group_concat(STA.SIT_CODIGO ORDER BY STA.SIT_CODIGO DESC) as TESTE,
            substring_index(group_concat(SIT.SIT_NOME ORDER BY STA.STA_DATA DESC), ',', 1) AS `SIT_CODIGO[]`
                  FROM TAREFA TAR, TAREFA_SITUACAO STA, SITUACAO SIT";
        
            $this->sqlCondicao = "
                 WHERE TAR.TAR_CODIGO = STA.TAR_CODIGO
                   AND STA.SIT_CODIGO = SIT.SIT_CODIGO
                   AND TAR.TAR_ATIVO = IF ('" . get('pg') . "' = 'tarefa_lixeira', 'N','S')";
             
            $this->sqlCondicao .= sprintf("
                    AND TAR.TAR_DATAINICIO <= NOW()
                    AND TAR.TAR_CODIGO IN (SELECT TAR_CODIGO FROM TAREFA_USUARIO WHERE USU_CODIGO = %s)", $_SESSION['USUARIO']['USU_CODIGO']);

        $sqlTarefa = "
            GROUP BY TAR.TAR_CODIGO 
              HAVING TESTE %s";
        if (!empty($_POST['listar'])) {
            $this->sqlOrdem = sprintf($sqlTarefa, fCoalesce($_POST['opcao-tarefa'],"< 5"));
        } else {
            $this->sqlOrdem = sprintf($sqlTarefa, "< 5");
        }
        parent::__construct();
    }
    
    
    public function listar() {
        if($_GET["acao"] == 'detalhar_tarefa') {
            require_once 'detalhes_tarefa.php';
        } else {
            parent::listar();
        }
    }
    
    public function iniciarCampos() {
        
        $this->setCampo("TAR_NOME", "Título", 100, "texto", true, true);
        $this->setCampo("TAR_DESCRICAO", "Descricao", 1000, "memo", false, true);

        $this->setCampo("TAR_DATAINICIO", "Data de início", 100, "data", true, true);
        $this->this->setValor(date("Y-m-d"));
        
        $this->setCampo("ITE_CODIGO[]", "Item", 100, "combo", false, false);
        $this->setCombo("ITEM");
        $this->setMulti("TAREFA_ITEM");
        
        $ITE_QUANTIDADE = new Campo("ITE_QUANTIDADE[]", "Quantidade", 100, "valor");
        $this->this->setEspaco($this->tipoCampo($ITE_QUANTIDADE, "TAREFA_ITEM"));
        
        $this->setCampo("PRO_CODIGO[]", "Produto", 100, "combo", false, false);
        $this->setCombo("PRODUTO");
        $this->setMulti("TAREFA_PRODUTO");
        
        $PRO_QUANTIDADE = new Campo("PRO_QUANTIDADE[]", "Quantidade", 100, "valor");
        $this->this->setEspaco($this->tipoCampo($PRO_QUANTIDADE, "TAREFA_PRODUTO"));
        
        $this->setCampo("USU_CODIGO[]", "Usuário", 100, "combo", false, true);
        $this->setCombo("USUARIO");
        $this->setMulti("TAREFA_USUARIO");
        
        if (get("pg") == "tarefa_listar") {
            $this->setCampo("SIT_CODIGO[]", "Situação", 100, "combo", true, false);
            $this->setCombo("SITUACAO");
            $this->setMulti("TAREFA_SITUACAO");
        }
    }
}
