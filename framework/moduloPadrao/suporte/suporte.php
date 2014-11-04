<?php

class Suporte extends Crud {

    public function iniciarCampos() {
        
        //Campos
        $this->setCampo("SUP_NOME", "Título", 100, "texto", true, true);
        $this->setCampo("SUP_DESCRICAO", "Suporte Solicitado", 1000, "memo", true, true);
    }

}

?>