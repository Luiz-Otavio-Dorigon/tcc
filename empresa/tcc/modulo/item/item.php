<?php

class Item extends Crud {
    
    function iniciarCampos() {
        $this->setCampo("ITE_NOME", "Item", 100, "texto",true);
        $this->setCampo("ITE_VALOR", "Valor", 13, "valor",true);
    }
    
}