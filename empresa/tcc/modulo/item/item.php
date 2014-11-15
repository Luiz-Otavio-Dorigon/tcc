<?php

class Item extends Crud {
    
    function iniciarCampos() {
        $this->setCampo("PEC_NOME", "Item", 100, "texto",true);
        $this->setCampo("PEC_VALOR", "Valor", 13, "valor",true);
    }
    
}