<?php

class Empresa extends Crud {
    
    function __construct() {
        $this->sqlConsulta = "
                SELECT EMP.*,
                       CID.CID_NOME AS CID_CODIGO
                  FROM CIDADE CID, EMPRESA EMP
                 WHERE CID.CID_CODIGO = EMP.CID_CODIGO";
            parent::__construct();
    }

        public function iniciarCampos() {

        $this->setCampo("EMP_NOME", "Empresa", 100, "texto", true, true);
        $this->setCampo("EMP_CPFCNPJ", "CPF - CNPJ", 100, "cpfcnpj", true, true);
        $this->setCampo("EMP_RGIE", "RG - IE", 100, "texto");

        $this->setCampo("CID_CODIGO", "Cidade", 100, "combo", true);
        $this->setCombo("CIDADE");
        $this->this->setApelido('CID',"CID_NOME");
        
        $this->setCampo("EMP_ENDERECO", "Endereço", 100, "texto");
        $this->setCampo("EMP_BAIRRO", "Bairro", 100, "texto");
        $this->setCampo("EMP_EMAIL", "E-mail", 100, "texto", true);
        $this->setCampo("EMP_TELEFONE", "Telefone", 100, "fone", true);
        
        $this->setCampo("PER_CODIGO[]", "Perfil", 20, "combo", false, true);
        $this->setCombo("PERFIL");
        $this->setMulti("EMPRESA_PERFIL");
        
        $this->setCampo("EMP_OBSERVACAO", "Observação", 100, "memo");
    }

}