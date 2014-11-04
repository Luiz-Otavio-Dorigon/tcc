<?php

class Produto extends Crud {

    public function acaoFK() {
        global $CONEXAO;
        parent::acaoFK();

        //Acrescenta valor na tabela PRODUTO_PECA
        foreach ($_POST["PEC_CODIGO"] as $codigo) {
            $sql = sprintf("UPDATE PRODUTO_PECA SET PEC_VALORUNITARIO = (SELECT PEC_VALOR FROM PECA WHERE PEC_CODIGO = %s)
                             WHERE PEC_CODIGO = %s AND PRO_CODIGO = %s", $codigo, $codigo, fCoalesce($this->chaveValor, $this->getValorChave()));
            $CONEXAO->query($sql);
        }
        
        if (!empty($_FILES['arquivo']['name'])) {
            if (empty($_POST['PRO_CODIGO'])) {
                $CONEXAO->setSql("SELECT PRO_CODIGO FROM PRODUTO ORDER BY PRO_CODIGO DESC LIMIT 1");
                $_POST['PRO_CODIGO'] = $CONEXAO->dadoBanco()[0]["PRO_CODIGO"];
                $_POST['PRO_CODIGO']+1;
            }
            
            require_once 'recebe_upload.php';
            
            $sql = sprintf("UPDATE PRODUTO SET PRO_ARQUIVO = '".$_SESSION['NOME_ARQUIVO']."' WHERE PRO_CODIGO = {$_POST['PRO_CODIGO']}");
            $CONEXAO->query($sql);
    //        $renomeiaImagemProduto = rename($_UP['pasta'] . $this->nomeProduto, $_UP['pasta'] . $NOME);
        }
    }

    public function iniciarCampos() {
        $this->setAtrForm("enctype='multipart/form-data'");

        $this->setCampo("PEC_CODIGO[]", "Peça", 100, "combo");
        $this->setCombo("PECA", "PEC_VALOR");
        $this->setMulti("PRODUTO_PECA");

        $PEC_QUANTIDADE = new Campo("PEC_QUANTIDADE[]", "Quantidade", 100, "valor", false);
        $this->this->setEspaco($this->tipoCampo($PEC_QUANTIDADE, "PRODUTO_PECA"));

        $this->setCampo("PRO_PERCENTUAL", "Margem de Lucro %", 100, "valor", false, true);

        $this->setCampo("PRO_VALOR", "Valor", 100, "valor", true, true);
        $this->this->setVagabundo('<br /><input type="button" class="btn btn-primary" onclick="jTotalizaProduto()" value="Calcular">');

        $this->setCampo("PRO_OBSERVACAO", "Observação", 1000, "memo");
        $this->this->setVagabundo('<br />
            <label>Selecionar Imagem</label>
            <div class="input-group">
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        Buscar <input type="file" name="arquivo" multiple="">
                    </span>
                </span>
                <input type="text" class="form-control" readonly="">
            </div>');
    }

}
?>

<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        background: red;
        cursor: inherit;
        display: block;
    }
    input[readonly] {
        background-color: white !important;
        cursor: text !important;
    }
</style>

<script>    
    function jTotalizaProduto() {
        var total = 0;
        var percentual = document.getElementById("PRO_PERCENTUAL").value;
        //Percorre todos os elementos ativos de peça, depois verifica
        //se tem quantidade, e multiplica o valor da peça pela quantidade
        //E soma todas essas interações e coloca o total no campo valor
        $('[name^=PEC_CODIGO] option:selected').each(function(i, e) {
            var valorPeca = $(this).data("pec_valor");
            if (valorPeca) {
                var quantidadePeca = jValor($('[name^=PEC_QUANTIDADE]')[i].value, 'Q');
                if (quantidadePeca) {
                    total += valorPeca * quantidadePeca;
                }
            }
        });
        total = total * ((parseFloat(percentual) + 100) / 100);
        $('[name=PRO_VALOR]').val(jValor(total.toString(), 'C'));
    }
</script>