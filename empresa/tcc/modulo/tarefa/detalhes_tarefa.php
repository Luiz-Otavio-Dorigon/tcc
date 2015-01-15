<?
global $CONEXAO;
$CONEXAO->setSql("
    SELECT TAR.TAR_CODIGO, TAR.TAR_NOME, TAR.TAR_DATAINICIO, TAR.TAR_DESCRICAO
      FROM TAREFA TAR
     WHERE TAR.TAR_CODIGO = " . get("tar_codigo") . "");

foreach ($CONEXAO->dadoBanco() as $TAREFA) {
    $detalhesTarefa = '
        <br />
        <table class="table table-bordered">
            <th colspan="6"> <h4 style="color: #3276b1" > Dados da tarefa <h4></th>
            <tr>
                <td> <b> Nome da tarefa </b> </td>
                <td> ' . $TAREFA['TAR_NOME'] . ' </td>
                <td> <b> Código da tarefa </b> </td>
                <td> ' . $TAREFA['TAR_CODIGO'] . ' </td>
                <td> <b> Data de início da tarefa </b> </td> 
                <td> ' . fFormataData($TAREFA['TAR_DATAINICIO']) . ' </td>
            </tr>
            <tr>
                <td> <b> Descrição da tarefa </b> </td>
                <td colspan="5"> ' . $TAREFA['TAR_DESCRICAO'] . ' </td>
            </tr>';

    $CONEXAO->setSql("SELECT COUNT(*) AS total
                        FROM TAREFA_ITEM
                       WHERE TAR_CODIGO = " . get("tar_codigo") . "");

    if ($CONEXAO->dadoBanco()[0]['total'] > 0) {
        $detalhesTarefa .= '<th colspan="6"> <h4 style="color: #3276b1" > Dados do(s) iten(s) <h4></th>';

        $CONEXAO->setSql("
                SELECT ITE.ITE_NOME, TAP.ITE_QUANTIDADE
                  FROM TAREFA_ITEM TAP, ITEM ITE
                 WHERE TAP.TAR_CODIGO = " . get("tar_codigo") . "
                   AND TAP.ITE_CODIGO = ITE.ITE_CODIGO");

        foreach ($CONEXAO->dadoBanco() as $ITENS) {
            $detalhesTarefa .= '
                <tr>
                    <td> <b> Descrição do item </b> </td>
                    <td> ' . $ITENS['ITE_NOME'] . ' </td>
                    <td> <b> Quantia para produção </b> </td>
                    <td> ' . $ITENS['ITE_QUANTIDADE'] . ' </td>
                    <td colspan="2"></td>
                </tr>';
        }
    }
    
    $CONEXAO->setSql("SELECT COUNT(*) AS total
                        FROM TAREFA_PRODUTO 
                       WHERE TAR_CODIGO = " . get("tar_codigo") . "");

    if ($CONEXAO->dadoBanco()[0]['total'] > 0) {
        $detalhesTarefa .= '<th colspan="6"> <h4 style="color: #3276b1" > Dados do(s) produto(s) <h4> </th>';

        $CONEXAO->setSql("
                SELECT PRO.PRO_NOME, TAP.PRO_QUANTIDADE, PRO.PRO_SEQPRODUCAO
                  FROM TAREFA_PRODUTO TAP, PRODUTO PRO
                 WHERE TAP.TAR_CODIGO = " . get("tar_codigo") . "
                   AND TAP.PRO_CODIGO = PRO.PRO_CODIGO");

        foreach ($CONEXAO->dadoBanco() as $PRODUTOS) {
            $detalhesTarefa .= '
                <tr>
                    <td> <b> Descrição do produto </b> </td>
                    <td> ' . $PRODUTOS['PRO_NOME'] . ' </td>
                    <td> <b> Quantia para produção </b> </td>
                    <td> ' . $PRODUTOS['PRO_QUANTIDADE'] . ' </td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td> <b> Sequência de produção </b> </td>
                    <td colspan="5"> '. $PRODUTOS['PRO_SEQPRODUCAO'] .' </td>
                </tr>';
        }
    }
    
    $detalhesTarefa .= '<th colspan="6"> <h4 style="color: #3276b1" > Integrantes da equipe <h4></th>';

    $CONEXAO->setSql("
            SELECT USU.USU_NOME
              FROM TAREFA_USUARIO TAU, USUARIO USU
             WHERE TAU.TAR_CODIGO = " . get("tar_codigo") . "
               AND TAU.USU_CODIGO = USU.USU_CODIGO");

    foreach ($CONEXAO->dadoBanco() as $USUARIOS) {
        $detalhesTarefa .= '
            <tr>
                <td> <b> Nome do funcionário </b> </td>
                <td colspan="5"> ' . $USUARIOS['USU_NOME'] . ' </td>
            </tr>';
    }

    $detalhesTarefa .= '</table>';
    print_r($detalhesTarefa);
}

$option = array();
$tag_option = '<option value="%s" %s >%s</option>';
$tag_selected = 'selected = ';

$CONEXAO->setSql("
        SELECT SIT.SIT_CODIGO
          FROM TAREFA_SITUACAO STA, SITUACAO SIT
         WHERE STA.TAR_CODIGO = " . get('tar_codigo') . "
           AND STA.SIT_CODIGO = SIT.SIT_CODIGO
      GROUP BY STA.STA_DATA DESC");

$sitCodigo = $CONEXAO->dadoBanco()[0]['SIT_CODIGO'];

if ($sitCodigo == 5 || $sitCodigo == 6) {
    $tagDisabled = "disabled";
}

$CONEXAO->setSql("SELECT * FROM SITUACAO");
foreach ($CONEXAO->dadoBanco() as $SITUACAO) {
    $option[] = sprintf($tag_option, $SITUACAO["SIT_CODIGO"], ($sitCodigo == $SITUACAO["SIT_CODIGO"]) ? $tag_selected . $sitCodigo : "", $SITUACAO["SIT_NOME"]);
}
?>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal1" <?=$tagDisabled?>>Trocar Situação</button>

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Alterar Situação da Terefa</h4>
                </div>
                <div class="modal-body">
                    <?
                    printf('
                        <label>Situação atual da Tarefa</label>
                        <select CLASS="form-control" name="SIT_CODIGO">%s</select> <br />
                        <label>Observação</label>
                        <textarea class="form-control" required name="STA_OBSERVACAO"></textarea> <br />                        
                    ', implode('', $option));
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <input class="btn btn-primary" type="submit" name="acao_trocar" value="Salvar" />
                    <?
                    if ($_POST["acao_trocar"] == 'Salvar') {
                        $CONEXAO->setSql("INSERT INTO  TAREFA_SITUACAO (TAR_CODIGO, SIT_CODIGO, USU_CODIGO, STA_OBSERVACAO) VALUES ( " . get('tar_codigo') . ", " . $_POST['SIT_CODIGO'] . ", " . $_SESSION['USUARIO']['USU_CODIGO'] . ", '" . $_POST['STA_OBSERVACAO'] . "')");
                        $CONEXAO->dadoBanco();
                        if ($_POST['SIT_CODIGO'] == 5 || $_POST['SIT_CODIGO'] == 6) {
                            $CONEXAO->setSql("UPDATE TAREFA SET TAR_FINALIZADA = 'S' WHERE TAR_CODIGO = ".get('tar_codigo')."");
                            $CONEXAO->dadoBanco();
                        }
                    }
                    ?>
                </div>
            </form>
        </div>
    </div>
</div>

<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal2">Listar Situações</button>

<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Listagem de Situações da Terefa</h4>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <th> Situação </th>
                        <th> Data </th>
                        <th> Usuário Modificação </th>
                        <th> Observação </th>
                        <?
                        $CONEXAO->setSql("
                            SELECT USU.USU_NOME, SIT.SIT_NOME, STA.STA_DATA, STA.STA_OBSERVACAO
                             FROM SITUACAO SIT, TAREFA_SITUACAO STA, USUARIO USU
                            WHERE STA.TAR_CODIGO = ".  get("tar_codigo")."
                              AND STA.SIT_CODIGO = SIT.SIT_CODIGO
                              AND STA.USU_CODIGO = USU.USU_CODIGO
                         ORDER BY STA.STA_DATA");
                        foreach ($CONEXAO->dadoBanco() as $TAREFA_SITUACAO) {
                            echo'
                                <tr>
                                    <td>' . $TAREFA_SITUACAO['SIT_NOME'] . '</td>
                                    <td>' . fFormataData($TAREFA_SITUACAO['STA_DATA']) . '</td>
                                    <td>' . $TAREFA_SITUACAO['USU_NOME'] . '</td>
                                    <td>' . $TAREFA_SITUACAO['STA_OBSERVACAO'] . '</td>
                                </tr>
                                ';
                        }
                        ?>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </form>
        </div>
    </div>
</div>