<?php

class Categoria extends Crud {

    public function iniciarCampos() {
        $this->setCampo("CAT_NOME", "Nome da Categoria", 50, "texto", true, true);
        
        $this->setCampo("MOD_CODIGO[]", "Módulo", 100, "combo", false, true);
        $this->setCombo("MODULO");
        $this->setMulti("CATEGORIA_MODULO");
        
        $this->setCampo("CAT_ATIVO", "Ativo", 50, "combo", true, true);
        $this->setOption("S", "Sim");
        $this->setOption("N", "Não");
    }
}