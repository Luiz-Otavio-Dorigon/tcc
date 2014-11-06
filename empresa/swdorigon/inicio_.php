<html>
    <head>
        <meta charset="UTF-8">
        <link href="framework/lib/bootstrap/3.0.3/css/paginacao.css" rel="stylesheet">
    </head>
</html>
<?php
if (!empty($_POST['finalizar'])) {
    $sql = "UPDATE tarefa SET tar_fim = CURRENT_TIMESTAMP(), tar_ativo = 'N', tar_finalizada = 'S' WHERE tar_codigo = {$_SESSION['tar_codigo']}";
    mysql_query($sql);
    if (!$sql) {
        echo"<div class='alert alert-danger'>Erro ao finalizar a tarefa.</div>";
    } else {
        echo"<div class='alert alert-info'>Tarefa finalizada com sucesso.</div>";
    }
}
echo '<h3><b>Tarefas Programadas</b></h3><br />';

//========================Paginação=========================================================================
$cont = 1;
$_SESSION['pagina_atual'] = isset($_REQUEST['pagina']) ? intval($_REQUEST['pagina']) : 1;

$CONEXAO->setSql("SELECT COUNT(*) AS total
                       FROM tarefa_usuario TU 
                       JOIN tarefa T ON (TU.tar_codigo = T.tar_codigo) 
                      WHERE TU.usu_codigo = {$_SESSION['USUARIO']['usu_codigo']}
                        AND T.tar_finalizada = 'N' 
                        AND T.tar_ativo = 'S'");

foreach ($CONEXAO->dadoBanco() as $TOTAL) {
    $total = $TOTAL['total'];
}

$_SESSION['paginas'] = ceil($total / $cont);
$fim = $cont * $_SESSION['pagina_atual'];
$inicio = ($fim - $cont);
//========================Fim Paginação=========================================================================

$CONEXAO->setSql("SELECT T.tar_codigo, T.tar_descricao, T.tar_nome 
                    FROM tarefa T
                    JOIN tarefa_usuario TU ON (T.tar_codigo = TU.tar_codigo)
                   WHERE TU.usu_codigo = {$_SESSION['USUARIO']['usu_codigo']}
                     AND T.tar_finalizada = 'N' 
                     AND T.tar_ativo = 'S' 
                ORDER BY tar_nome limit {$inicio}, {$cont}");

if ($_SESSION['paginas'] != 0) {
                
foreach ($CONEXAO->dadoBanco() as $ITEM) {
    $_SESSION['tar_codigo'] = $ITEM["tar_codigo"];
    echo '<form method="post">';
    echo '<table class="table table-striped table-bordered">';
    echo "<th colspan='3'><h4 style='color: #3276b1'><b>Tarefa: {$_SESSION['tar_codigo']}</b> </h4></th>";
    echo "<tr>";
    echo "<td colspan='2'><b>Titulo </b></td><td>{$ITEM["tar_nome"]}</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td colspan='2'><b>Descriçãoo</b> </td><td>{$ITEM["tar_descricao"]}</td>";
    echo "</tr>";

    $CONEXAO->setSql("SELECT COUNT(*) AS total
                        FROM tarefa_produto 
                       WHERE tar_codigo = {$_SESSION['tar_codigo']}");
    foreach ($CONEXAO->dadoBanco() as $PRODUTO) {
        $contP = $PRODUTO['total'];
    }

    $CONEXAO->setSql("SELECT P.pro_nome, P.pro_codigo, TP.pro_quantidade
                        FROM produto P
                        JOIN tarefa_produto TP ON (TP.pro_codigo = P.pro_codigo ) 
                        JOIN tarefa T ON (T.tar_codigo = TP.tar_codigo ) 
                       WHERE T.tar_codigo =  {$_SESSION['tar_codigo']}");
    if ($contP > 0) {
        echo '<th colspan="3" style="color: #3276b1">Produtos</th>';
        echo "<tr>";
        echo "<td><b>Código</b></td>";
        echo "<td><b>Descrição</b></td>";
        echo "<td><b>Quantidade</b></td>";
        echo '</tr>';
        foreach ($CONEXAO->dadoBanco() as $PRODUTO) {
            echo "<tr>";
            echo "<td>{$PRODUTO['pro_codigo']}</td>";
            echo "<td>{$PRODUTO['pro_nome']}</td>";
            echo "<td>{$PRODUTO['pro_quantidade']}</td>";
            echo '</tr>';
        }
    }

    $CONEXAO->setSql("SELECT COUNT(*) AS total
                        FROM tarefa_peca
                       WHERE tar_codigo =  {$_SESSION['tar_codigo']}");
    foreach ($CONEXAO->dadoBanco() as $PECA) {
        $contPeca = $PECA['total'];
    }
    $CONEXAO->setSql("SELECT PC.pec_nome, PC.pec_codigo, TP.pec_quantidade
                            FROM peca PC
                            JOIN tarefa_peca TP ON (TP.pec_codigo = PC.pec_codigo)
                            JOIN tarefa T ON (T.tar_codigo = TP.tar_codigo)
                           WHERE T.tar_codigo = {$_SESSION['tar_codigo']}");
    if ($contPeca > 0) {
        echo '<th colspan="3" style="color: #3276b1">Peças</th>';
        echo "<tr>";
        echo "<td><b>Código</b></td>";
        echo "<td><b>Descrição</b></td>";
        echo "<td><b>Quantidade</b></td>";
        echo '</tr>';
        foreach ($CONEXAO->dadoBanco() as $PECA) {
            echo "<tr>";
            echo "<td>{$PECA ['pec_codigo']}</td>";
            echo "<td>{$PECA['pec_nome'] }</td>";
            echo "<td>{$PECA['pec_quantidade'] }</td>";
            echo '</tr>';
        }
    }
    $CONEXAO->setSql("SELECT PS.pes_nome
                        FROM pessoa PS
                        JOIN usuario U ON (U.pes_codigo = PS.pes_codigo)
                        JOIN tarefa_usuario TU ON (TU.usu_codigo = U.usu_codigo)
                       WHERE TU.tar_codigo = {$_SESSION['tar_codigo']}");

    echo '<th colspan="3" style="color: #3276b1">Equipe</th>';

    foreach ($CONEXAO->dadoBanco() as $EQUIPE) {
        echo "<tr>";
        echo "<td colspan='3'>" . $EQUIPE['pes_nome'] . "</td>";
        echo '</tr>';
    }
    echo '<tr>';
    echo '<td colspan="3"><input type="submit" class="btn btn-primary" value="Finalizar Tarefa" name="finalizar" /></td>';
    echo '</tr>';
    echo '</table>';
    echo '</form>';
}
    echo fMontaLinksPaginacao();
} else {
    echo"<div class='alert alert-info'>Uau! Você não possui tarefas. :)</div>";
}