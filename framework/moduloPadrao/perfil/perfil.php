<?php

class Perfil extends Crud {

    public function iniciarCampos() {
        $this->setCampo("PER_NOME", "Nome", 50, "texto", true);
    }

}
