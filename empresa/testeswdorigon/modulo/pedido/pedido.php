<?php

class Pedido extends Crud {
    
    public function imprimir(){
        require_once 'imprimir.php';
    }
    
    public function acaoFK() {
        global $CONEXAO;
        parent::acaoFK();
        //Acrescenta valor na tabela PRODUTO_PECA
        foreach($_POST["pro_codigo"] as $codigo) {
            //$DADOS = Array("pec_valorunitario" => sprintf("(SELECT pec_valor FROM PECA WHERE pec_codigo = %s)",$codigo));
            $sql = sprintf("UPDATE PEDIDO_PRODUTO SET PRO_VALORUNITARIO = (SELECT PRO_VALOR FROM PRODUTO WHERE PRO_CODIGO = %s)
                             WHERE PRO_CODIGO =  %s AND PED_CODIGO = %s",$codigo,$codigo,fCoalesce($this->chaveValor, $this->getValorChave()));
            $CONEXAO->query($sql);
//            $this->conexao->query($sql);
        }
    }
    
    function __construct() {
        $this->sqlConsulta = "
                SELECT  PED.*,
                       EMP.EMP_NOME AS EMP_CODIGO, 
                       SIT.SIT_NOME AS SIT_CODIGO 
                     FROM EMPRESA EMP, PEDIDO PED, SITUACAO SIT
		    WHERE EMP.EMP_CODIGO = PED.EMP_CODIGO
                      AND PED.SIT_CODIGO = SIT.SIT_CODIGO";
        parent::__construct();
    }

    public function iniciarCampos() {
        
        $this->setCampo("PED_NOME", "Descricao", 100, "texto", true, true);
        
        $this->setCampo("SIT_CODIGO", "Situação", 100, "combo", true, true);
        $this->setCombo("SITUACAO");
        $this->this->setValor(1);
        $this->this->setApelido('SIT',"SIT_NOME");
        
        $this->setCampo("EMP_CODIGO", "Empresa", 100, "combo", true, true);
        $this->setCombo("EMPRESA");
        $this->this->setApelido('EMP',"EMP_NOME");
        
        $this->setCampo("PED_TRANSPORTADORA", "Transportadora", 100, "texto", false, true);

        $this->setCampo("PED_FRETE", "Tipo do Frete", 100, "combo", false, true);
        $this->setOption("CIF", "CIF");
        $this->setOption("FOB", "FOB");

        $this->setCampo("PED_VALORFRETE", "Valor do Frete", 100, "valor");
        $this->setCampo("PED_DATA", "Data do Pedido", 100, "data", true, true);
        $this->this->setVisivelFormulario(false);

        $this->setCampo("PED_DATAENTREGA", "Data de Entrga", 100, "data", true, true);
        
        //itens que compõem o pedido 
        $this->setCampo("PRO_CODIGO[]", "Produto", 100, "combo", false, true);
        $this->setCombo("PRODUTO", "PRO_VALOR");
        $this->setMulti("PEDIDO_PRODUTO");

        $PRO_QUANTIDADE = new Campo("PRO_QUANTIDADE[]", "Quantidade", 100, "valor");
        $this->this->setEspaco($this->tipoCampo($PRO_QUANTIDADE, "PEDIDO_PRODUTO"));
        $this->setCampo("PED_TOTAL", "Total do Pedido", 100, "valor", true);
        $this->this->setVagabundo('<br /><input type="button" class="btn btn-primary" onclick="jTotalizaPedido()" value="Calcular">');
        
        $this->setCampo("PED_OBSERVACAO", "Observação", 100, "memo");
    }
}

?>
<script>
    function jTotalizaPedido() {
        var total = 0;
        //Percorre todos os elementos ativos de peça, depois verifica
        //se tem quantidade, e ultiplica o valor da peça pela quantidade
        //E soma todas essas interações e coloca o total no campo valor
        $('[name^=PRO_CODIGO] option:selected').each(function(i,e) {
            var valorProduto = $(this).data("pro_valor");
            if(valorProduto) {
                var quantidadeProduto = jValor($('[name^=PRO_QUANTIDADE]')[i].value, 'Q');
                if(quantidadeProduto) {
                    total += valorProduto * quantidadeProduto;
                }
            }
         });
        $('[name=PED_TOTAL]').val(jValor(total.toString(),'C'));
    }
</script>