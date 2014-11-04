<?php

class Historico extends Crud {
    
    function __construct() {
        global $CONEXAO;
        
        //Modulos
        $CONEXAO->setSql("
            SELECT `MOD`.MOD_NOME, 
                   `MOD`.MOD_APELIDO
              FROM MODULO `MOD`
             WHERE `MOD`.MOD_ATIVO = 'S'");
        
        //PR($CONEXAO->dadoBanco());
        $sql_item = "(";
        foreach($CONEXAO->dadoBanco() as $ind => $modulo) {
            if($modulo["MOD_NOME"] == 'historico') continue;
            
            if($ind != 0)
                $sql_item .= "UNION \n";
            
            $pre = $modulo["MOD_APELIDO"];
            $sql_item .= " SELECT CONCAT({$pre}_CODIGO,' - ',{$pre}_NOME) AS ITE_NOME, {$pre}_CODIGO AS ITE_CODIGO, '$modulo[MOD_NOME]' AS ITE_MODULO FROM ".strtoupper($modulo[MOD_NOME])." ";
        }
        
        $sql_item .= " )";
        
        $this->sqlConsulta = "
            SELECT EMP.EMP_NOME AS EMP_NOME, 
	           USU.USU_LOGIN,
	           HIS.HIS_MODULO,
                   ITEM.ITE_NOME,
		   HIS.HIS_ACAO,
		   HIS.HIS_DATA
	      FROM HISTORICO HIS, 
		   USUARIO USU,
		   EMPRESA  EMP,
                   $sql_item ITEM";
        $this->sqlCondicao = " WHERE HIS.USU_LOGIN = USU.USU_LOGIN
	       AND USU.EMP_CODIGO = EMP.EMP_CODIGO
               AND ITEM.ITE_CODIGO = HIS.HIS_MOD_CODIGO 
               AND ITEM.ITE_MODULO = HIS.HIS_MODULO";
        
        $this->sqlOrdem = "GROUP BY HIS.HIS_MODULO, HIS.HIS_MOD_CODIGO
                           ORDER BY HIS.HIS_DATA DESC";
        
        parent::__construct();
        
    }
    
    function iniciarCampos() {
        
        $this->getCampo("HIS_NOME")->setVisivelLista(false);
        $this->setCampo("EMP_NOME",       "Empresa", 100, "texto", true);
        $this->setCampo("USU_LOGIN",       "Usuário", 100, "texto", true);
        $this->setCampo("HIS_MODULO",     "Módulo",  100, "texto", true);
        $this->setCampo("ITE_NOME", "Item",    100, "texto", true);
        $this->this->setApelido('ITEM');
        $this->setCampo("HIS_ACAO",       "Ação",    100, "texto", true);
        $this->setCampo("HIS_DATA",       "Data",    100, "data", true);
    }
}