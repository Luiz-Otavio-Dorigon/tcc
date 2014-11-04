<?php
$sql = "SELECT P.PED_NOME, 
                       P.PED_DATA,
                       P.PED_DATAENTREGA,
		       P.PED_TRANSPORTADORA, 
                       P.PED_FRETE, 
                       P.PED_VALORFRETE, 
                       P.PED_TOTAL, 
                       P.PED_OBSERVACAO,
                       PP.PRO_QUANTIDADE, 
                       PP.PRO_VALORUNITARIO, 
                       (PP.PRO_QUANTIDADE * PP.PRO_VALORUNITARIO) AS PRECOCUSTO,
                       PRO.PRO_NOME,
                       EM.EMP_NOME,
                       EM.EMP_CPFCNPJ,
                       EM.EMP_ENDERECO,
                       EM.EMP_BAIRRO,
                       EM.EMP_TELEFONE,
                       C.CID_NOME,
                       E.EST_UF
                  FROM PEDIDO P
                  JOIN PEDIDO_PRODUTO PP ON ( P.PED_CODIGO = PP.PED_CODIGO )
                  JOIN PRODUTO       PRO ON ( PRO.PRO_CODIGO = PP.PRO_CODIGO )
                  JOIN EMPRESA        EM ON ( EM.EMP_CODIGO = P.EMP_CODIGO )
                  JOIN CIDADE          C ON ( C.CID_CODIGO = EM.CID_CODIGO )
                  JOIN ESTADO          E ON ( E.EST_CODIGO = C.EST_CODIGO )
                 WHERE PP.PED_CODIGO = ".get("ped_codigo")."";
        
        $this->setSql($sql);
        $registro = $this->consulta();

        echo '<table class="table table-condensed">';
        echo '<tr>';
        echo '<td style="width: 43%"><img src="empresa/'.strtolower($_SESSION["EMPRESA"]["CAMINHO"]).'/imagens/logo.png" width="80px"></td>';
        echo '<td><h3><b>PEDIDO</b></h3></td>';
        echo '</tr>';
        echo '</table>';
        
        $tag_unica = '<tr><th style="width:20%%;">%s</th><td>%s</td></tr>';
        $tag_empresa = '<tr><th style="width:8%%;">%s</th><td>%s</td><th style="width:8%%;">%s</th><td>%s</td><th style="width:8%%;">%s</th><td>%s</td></tr>';
        $tag_tres = '<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>';

        foreach ($registro as $indice => $pedido) {
            
            if($indice == 0){
                echo'<table class="table table-condensed">';
                printf($tag_unica,"Descrição:",$pedido["PED_NOME"]);
                printf($tag_unica,"Data do Pedido:",  fFormataData($pedido["PED_DATA"]));
                printf($tag_unica,"Data de Entrega:",  fFormataData($pedido["PED_DATAENTREGA"]));
                printf($tag_unica,"Transportadora:",$pedido["PED_TRANSPORTADORA"]);
                printf($tag_unica,"Frete:",$pedido["PED_FRETE"]);
                printf($tag_unica,"Observação:",$pedido["PED_OBSERVACAO"]);
                echo '</table>';
                echo '<br />';
                echo '<table class="table table-condensed">';
                echo '<th colspan="6" style="text-align: center; font-size:18px"><b>DADOS DO CLIENTE</b></th>';
                printf($tag_empresa,"Cliente",$pedido['EMP_NOME'],"CPF/CNPJ",  fFormataCpfCnpj($pedido['EMP_CPFCNPJ']), "Telefone",  fFormataTelefone($pedido['EMP_TELEFONE']));
                printf($tag_empresa,"Endereço",$pedido['EMP_ENDERECO'],"Bairro",  $pedido['EMP_BAIRRO'], "Cidade",  $pedido['CID_NOME']." - ".$pedido['EST_UF']);
                echo '</table>';
                echo '<br />';
                echo'<table class="table table-striped table-condensed">';
                echo '<th colspan="4" style="text-align: center; font-size:18px"><b>PRODUTOS</b></th>';
                printf($tag_tres,"<b>Produto</b>","<b>Quantidade</b>","<b>Valor Unitário</b>", "<b>Valor Total</b>");
            }
            printf($tag_tres,$pedido["PRO_NOME"],
                             $pedido["PRO_QUANTIDADE"],
                             fValor($pedido["PRO_VALORUNITARIO"],"M","R$"),
                             fValor($pedido["PRECOCUSTO"],"M","R$")
                  );
        }
            
        echo '<tr>';
        echo '  <td style="text-align: right" colspan="3"><b>Subtotal</b></td>';
        echo '  <td ><span style="color: red">R$ '.number_format($pedido["PED_TOTAL"],2,",",".").'</span></td>';
        echo '</tr>';
        echo '<tr>';
        echo '  <td style="text-align: right" colspan="3"><b>Valor do Frete</b></td>';
        echo '  <td ><span style="color: red">R$ '.number_format($pedido["PED_VALORFRETE"],2,",",".").'</span></td>';
        echo '</tr>';
        echo '<tr>';
        echo '  <td style="text-align: right" colspan="3"><b>Total do Pedido</b></td>';
        echo '  <td ><span style="color: red">R$ '.number_format($pedido["PED_TOTAL"]+$pedido["PED_VALORFRETE"],2,",",".").'</span></td>';
        echo '</tr>';
        echo'</table>';