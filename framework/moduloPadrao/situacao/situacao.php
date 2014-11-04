<?php

class Situacao extends Crud {

    public function iniciarCampos() {
        
        $this->setCampo("SIT_NOME", "Situação", 50, "texto", true);
        $this->setCampo("SIT_ORDEM", "Ordem", 50, "texto", true);
    }

}
