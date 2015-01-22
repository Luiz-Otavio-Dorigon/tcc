<?php

class Atividade extends Crud {
    
    public function iniciarCampos() {
        $this->setCampo("PRD_NOME", "Descrição", 200, "texto", true, true);
    }
}