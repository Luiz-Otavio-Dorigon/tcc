<?php

class Atributo {

    protected $atr_name;
    protected $atr_id;
    protected $atr_maxlength;
    protected $atr_valor;
    protected $atr_required;
    protected $atr_class;
    protected $atr_value;
    protected $atr_type;
    protected $atr_placeholder;
    protected $atr_onChange;
    protected $atributo;
    protected $espaco;
    protected $option;
    protected $vagabundo;
    
    public function getVagabundo() {
        return $this->vagabundo;
    }
    
    public function getAtr_onChange() {
        return $this->atr_onChange;
    }

    public function setAtr_onChange($atr_onChange) {
        $this->atr_onChange = $atr_onChange;
    }

    public function getNome() {
        return $this->atr_name;
    }

    public function setValor($atr_value) {
        $this->atr_value = $atr_value;
    }

    public function getObrigatorio() {
        return $this->atr_required;
    }

    public function getTamanho() {
        return $this->atr_maxlength;
    }

    public function getValor() {
        return $this->atr_value;
    }

    public function getEspaco() {
        return str_replace("'", '"', addslashes($this->espaco)) . ' ' . $this->vagabundo;
    }

    public function setType($atr_type) {
        $this->atr_type = $atr_type;
    }

    public function setClasse($atr_class) {
        $this->atr_class = $atr_class;
    }

    public function setEspaco($espaco) {
        $this->espaco = $espaco;
    }
    
    public function setVagabundo($vagabundo) {
        $this->vagabundo = $vagabundo;
    }

    public function setMaxlenght($tamanho) {
        $this->atr_maxlength = $tamanho;
    }

    public function setPlaceholder($descricao) {
        $this->atr_placeholder = $descricao;
    }

    public function getPlaceholder() {
        return $this->atr_placeholder;
    }

    public function getName() {
        return $this->atr_name;
    }

    public function getAtributo() {
        return implode(" ", $this->atributo) . " " . $this->espaco;
    }

    public function setAtributo($atributo, $valor) {
        $this->atributo[] = str_replace("atr_", "", $atributo) . " = '" . $valor . "'";
    }

    public function getOption($codigo) {
        $option = '';
        foreach ($this->option as $campo) {
            if (!strpos($campo, 'value="' . $codigo . '"') === FALSE) {

                $option[] = str_replace('@=@', "selected", $campo);
                continue;
            }
            $option[] = str_replace('@=@', "", $campo);
        }
        return $option;
    }

    public function setOption($valor, $descricao, $auxiliar="") {
        $this->option[0] = "<option></option>";
        
        if(!empty($auxiliar)) {
            list($coluna,$valorAdicional) = explode("@=@", $auxiliar);
            $atr_auxiliar = "data-$coluna=$valorAdicional";
            $descricao = $descricao . ' - ' .$valorAdicional;
        } else {
            $atr_auxiliar = '';
        }
        
        $this->option[$valor] = '<option @=@ '.$atr_auxiliar.' value="' . $valor . '">' . $descricao . '</option>';
    }
}