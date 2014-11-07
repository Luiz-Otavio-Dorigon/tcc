<?php

class Peca extends Crud {
    
    function iniciarCampos() {
        $this->setCampo("PEC_NOME", "Peça", 100, "texto",true);
        $this->setCampo("PEC_VALOR", "Valor", 13, "valor",true);
    }
    
}