<?php

require_once $DIR.'/framework/formulario/Campo.php';
require_once $DIR.'/framework/controle/Auxiliar.php';

class Crud extends Auxiliar {
    
    protected $nomeProduto;

    public function acaoFK() {
        foreach ($this->multi as $tabela => $chave) {
            
            $DADOS = array();
            $DADOS[$this->chave] = fCoalesce($this->chaveValor, $this->getValorChave());
            
            $this->excluir($tabela, $this->chave . "=" . $DADOS[$this->chave]);
            
            //Assume as colunas existentes
            $COLUNAS = array();
            foreach (str_replace("[]", "", $chave) as $coluna) {
                $COLUNAS[] = $coluna;
            }
            
            //pega a quantidade de multis para assumir para o foreach
            foreach(fPostGet($COLUNAS[0]) as $indice => $valor) {
                foreach($COLUNAS as $coluna) {
                   
		    $kkkkk = fPostGet($coluna)[$indice];
                    
                    if(in_array($coluna,array("ITE_QUANTIDADE","PRO_QUANTIDADE"))) {
                        $kkkkk = str_replace(',', '.', str_replace('.', '', $kkkkk));
                    }
                    
                    $DADOS[$coluna] = $kkkkk;
                }
                $this->inserir($tabela, $DADOS);
            }
        }
    }

    function form() {
        if (fPostGet("acao") == 'alterar') {
            $_SESSION["CHAVE_MODULO"] = $this->chaveValor;
            $DADOS = $this->consulta($this->modulo, $this->chave . ' = ' . $this->chaveValor)[0];
            foreach ($this->campo as $nome => $campo) {
                if($campo->getTipo() == 'valor') {
                    $campo->setValor(fValor($DADOS[$nome],'M'));
                } else {
                    $campo->setValor($DADOS[$nome]);   
                }
            }
        }
        $tag_formulario = "
            <form method='post' action='?pg={$this->modulo}_listar' {$this->getAtrForm()}>
                <input type='hidden' name='$this->chave' value='$this->chaveValor'/>";

        foreach ($this->campo as $campo) {
            if ($campo->getVisivelFormulario()) {
                if ($campo->getMulti()) {
                    $opcoes = addslashes(implode('', $campo->getOption($campo->getValor())));
                    $tag_multi = "<div id='multi_" . str_replace("[]", "", $campo->getNome()) . "'><a onclick='jMultiCombo(\"" . str_replace("[]", "", $campo->getNome()) . "\",\"" . str_replace("[]", "", $campo->getNome()) . "\",\"" . $opcoes . "\",\"" . $campo->getEspaco() . "\")' style='cursor: pointer' ><span class='glyphicon glyphicon-plus' title='Adicionar campos'></span> </a>%s</div>";
                    $tag_formulario .= sprintf($tag_multi, $this->tipoCampo($campo));
                    $this->destruirMulti(array_keys($this->getMulti())[0]);
                    continue;
                }
                $tag_formulario .= $this->tipoCampo($campo);
            }
        }

        $tag_formulario .= '
            <input type = "submit" class = "btn btn-primary center-block" name = "acao" value = "' . fCoalesce(ucfirst(get("acao")), "Incluir") . '" />
            </form>';

        echo $tag_formulario;
    }

    public function tipoCampo($campo, $acoplado = false) {
        global $DIR;
        if (!$acoplado) {
            $tag_campo = "
            <div class='form-group'><label for='" . $campo->getNome() . "'>" . $campo->getDescricao() . "</label>";
        } else {
            $this->multi[$acoplado][] = $campo->getNome();
            $tag_campo = '<BR>';
        }
        

        $c = new Campo($campo->getNome(), $campo->getDescricao(), $campo->getTamanho(), 'texto', $campo->getObrigatorio(), true);

        if ($acoplado)
            $c->setPlaceholder(fCoalesce($campo->getPlaceholder(), $campo->getDescricao()));

        $c->setClasse("form-control");
        
        $c->setValor($campo->getValor());
        
        if ($campo->getTipo() == 'texto') {
            $tag_campo .= $c->montaCampo($this);
        } else if ($campo->getTipo() == 'cpfcnpj') {
            $tag_campo .= $c->montaCampo($this);
        } else if ($campo->getTipo() == 'fone') {
            $tag_campo .= $c->montaCampo($this);
        } else if ($campo->getTipo() == 'data') {
            $c->setType("date");
            $tag_campo .= $c->montaCampo($this);
        } else if ($campo->getTipo() == 'valor') {
//            $c->setEspaco("data-mask='#.##0,00' data-mask-reverse='true' data-mask-maxlength='false'");
            $c->setEspaco("onkeypress='return jNumeroVirgula(event)'");
            $c->setMaxlenght(10);
            $tag_campo .= $c->montaCampo($this);
        } else if ($campo->getTipo() == 'senha') {
            $c->setType("password");
            $tag_campo .= $c->montaCampo($this);
        } else if ($campo->getTipo() == 'memo') {
            $c->setType("");
            $c->setTipo("memo");
            $tag_campo .= $c->montaCampo($this);
        } else if ($campo->getTipo() == 'combo') {
            $c->setType("");
            $c->setTipo("combo");

            if (fPostGet("acao") == "alterar" && !empty($this->multi)) {
                foreach ($this->multi as $tabela => $chave) {
                    foreach ($this->consulta($tabela, "$this->chave = $this->chaveValor") as $item) {
                        $cod = $item[str_replace("[]", "", $campo->getNome())];
                        $tag_option .= "<br/><select $atributo_padrao_completo>" . implode("", $campo->getOption($cod));
                        $tag_option .= implode("", $campo->getOption($campo->getValor()));
                        $tag_option .= '<select>';
                    }
                }
                $tag_campo .= $c->montaCampo($this);
            } else {
                $tag_campo .= $c->montaCampo($this);
            }
        }
        return $tag_campo . fSimNao(fPostGet("acao") != "alterar", str_replace('\\', "", $campo->getEspaco()),  fCoalesce($campo->getVagabundo(),'')).  fSimNao($acoplado, "", '</div>');
    }

}
