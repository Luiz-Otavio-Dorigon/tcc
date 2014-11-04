<?php

class Cidade extends Crud {
    
    function __construct() {
        $this->sqlConsulta = "
                SELECT EST.*, CID.*,
                       EST.EST_NOME AS EST_CODIGO
                  FROM ESTADO EST, CIDADE CID
                 WHERE EST.EST_CODIGO = CID.EST_CODIGO";

            parent::__construct();
    }

    public function iniciarCampos() {
        $this->setCampo("CID_NOME", "Cidade", 100, "texto", true, true);
        $this->setCampo("EST_CODIGO", "Estado", 100, "combo", true, true);
        $this->setCombo("ESTADO");
        $this->this->setApelido('EST',"EST_NOME");
    }

}
?>