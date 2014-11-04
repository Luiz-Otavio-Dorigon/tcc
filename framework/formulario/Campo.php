<?php

require_once $DIR.'/framework/formulario/Atributo.php';

class Campo extends Atributo {

    protected $tipo;
    protected $multi;
    protected $descricao;
    protected $chave;
    protected $visivelFormulario;
    protected $visivelLista;
    protected $apelido;
    
    function __construct($id, $descricao, $tamanho, $tipo, $obrigatorio, $visivelLista) {
        $this->descricao = $descricao;
        $this->tipo = $tipo;
        $this->visivelLista = $visivelLista;
        $this->visivelFormulario = true;

        $this->atr_name = $id;
        $this->atr_id = $id;
        $this->atr_maxlength = $tamanho;
        $this->atr_required = fSimNao($obrigatorio, "required");
        $this->atr_type = "text";
    }
    
    public function setApelido($apelido,$nome="") {
        $this->apelido["APELIDO"] = $apelido;
        $this->apelido["NOME"] = $nome;
    }
    
    public function getApelido($apelido) {
        return $this->apelido;
    }
    
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setMulti($tabela) {
        $this->multi[$tabela] = str_replace("[]", "", $this->atr_name);
    }

    public function montaCampo($crud = "") {
            
        foreach ($this as $atributo => $valor) {
            
            if (empty($valor) || strpos($atributo, "atr_") !== 0)
                continue;
            
            $this->setAtributo($atributo, $valor);
        }
        if ($this->tipo == 'texto') {
            return "<input " . $this->getAtributo() . " />";
        } else if ($this->tipo == 'memo') {
            return "<textarea " . $this->getAtributo() . ">" . $this->getValor() . "</textarea>";
        } else if ($this->tipo == 'combo') {
            if (fPostGet("acao") == "alterar" && !fVazio($crud->getCampo($this->atr_name)->getMulti())) {

                foreach ($crud->getMulti() as $tabela => $chave) {
                    $sss = $crud->consulta($tabela, $crud->getChave() . " = " . $crud->getChaveValor());
                    $tag = '';
                    foreach ($sss as $item) {
                        $cod = $item[str_replace("[]", "", $this->atr_name)];
                        $tag .= "<select " . $this->getAtributo() . ">" . implode("", $crud->getCampo($this->atr_name)->getOption($cod)) . "</select>";
                        //Campo espaço SUPER GAMBIARRA to de saco cheio
                        if (!fVazio($crud->getCampo($chave[0])->getEspaco())) {
                            $campo = $crud->getCampo($chave[0]);
                            $nome = substr(str_replace("id  ", "", fApenasLetra(substr($campo->getEspaco(), strpos($campo->getEspaco(), 'id = \"')), '\"')), 0, strpos(str_replace("id  ", "", fApenasLetra(substr($campo->getEspaco(), strpos($campo->getEspaco(), 'id = \"')), '\"')), " "));
                            $quantidade = $item[$nome];
                            if(is_numeric($quantidade)) {
                                $quantidade = fValor($quantidade,'M');
                            }
                            $esquema = str_replace('id = \"', 'value = \"' . $quantidade . '\" id = \"', $campo->getEspaco());
                            $tag .= str_replace('\\', "", $esquema);
                        }

                        $tag .= '<BR>';
                    }
                    return $tag;
                }
            } else {
                return "<select " . $this->getAtributo() . ">" . implode("", $crud->getCampo($this->atr_name)->getOption($crud->getCampo($this->atr_name)->getValor())) . '</select>';
            }
        }
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function getChave() {
        return $this->chave;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getVisivelFormulario() {
        return $this->visivelFormulario;
    }

    public function getVisivelLista() {
        return $this->visivelLista;
    }

    public function setChave($chave) {
        $this->chave = $chave;
    }

    public function setVisivelFormulario($visivelFormulario) {
        $this->visivelFormulario = $visivelFormulario;
    }

    public function setVisivelLista($visivelLista) {
        $this->visivelLista = $visivelLista;
    }

    public function campoListar($dado, $campo) {
        if ($campo->getTipo() == 'data') {
            return fFormataData($dado);
        } else if ($campo->getTipo() == 'valor') {
            return fValor($dado,'M','R$');
        } else if ($campo->getTipo() == 'cpfcnpj') {
            return fFormataCpfCnpj($dado);
        } else if ($campo->getTipo() == "fone") {
            return fFormataTelefone($dado);
        }
        return $dado;
    }

    public function getMulti() {
        return $this->multi;
    }
}