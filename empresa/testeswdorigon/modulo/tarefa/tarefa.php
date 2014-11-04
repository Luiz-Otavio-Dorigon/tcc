<?php

class Tarefa extends Crud {

    function __construct() {
        $this->sqlConsulta = "
                SELECT  TAR.*, 
            substring_index(group_concat(SIT.SIT_NOME ORDER BY STA.STA_DATA DESC), ',', 1) AS `SIT_CODIGO[]`
                  FROM TAREFA TAR, TAREFA_SITUACAO STA, SITUACAO SIT";
        
             $this->sqlCondicao = "
                 WHERE TAR.TAR_CODIGO = STA.TAR_CODIGO
                   AND STA.SIT_CODIGO = SIT.SIT_CODIGO
                   AND TAR.TAR_ATIVO = 'S' ";
             
        if ($_SESSION['USUARIO']['PER_CODIGO'] == 3) {
            $this->sqlCondicao .= sprintf("
                    AND TAR.TAR_DATAINICIO <= NOW()
                    AND TAR.TAR_CODIGO IN (SELECT TAR_CODIGO FROM TAREFA_USUARIO WHERE USU_CODIGO = %s)", $_SESSION['USUARIO']['USU_CODIGO']);
        }
        $this->sqlOrdem = "GROUP BY TAR.TAR_CODIGO ";
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
        
        $this->setCampo("PEC_CODIGO[]", "Peça", 100, "combo", false, false);
        $this->setCombo("PECA");
        $this->setMulti("TAREFA_PECA");
        
        $PEC_QUANTIDADE = new Campo("PEC_QUANTIDADE[]", "Quantidade", 100, "valor");
        $this->this->setEspaco($this->tipoCampo($PEC_QUANTIDADE, "TAREFA_PECA"));
        
        $this->setCampo("PRO_CODIGO[]", "Produto", 100, "combo", false, false);
        $this->setCombo("PRODUTO");
        $this->setMulti("TAREFA_PRODUTO");
        
        $PRO_QUANTIDADE = new Campo("PRO_QUANTIDADE[]", "Quantidade", 100, "valor");
        $this->this->setEspaco($this->tipoCampo($PRO_QUANTIDADE, "TAREFA_PRODUTO"));
        
        $this->setCampo("USU_CODIGO[]", "Usuário", 100, "combo", false, true);
        $this->setCombo("USUARIO");
        $this->setMulti("TAREFA_USUARIO");
        
        $this->setCampo("SIT_CODIGO[]", "Situação", 100, "combo", true, false);
        $this->setCombo("SITUACAO");
        $this->setMulti("TAREFA_SITUACAO");
        
        
    }
    
    

}
?>