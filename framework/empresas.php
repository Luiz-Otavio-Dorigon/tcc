<link href="framework/lib/bootstrap/3.0.3/css/signin.css" rel="stylesheet">
<?php
if (fVazio(get("empresa"))) {
    ?>
    <div>
        <h3><b>Empresas</b></h3><br />
        <table class="table table-hover">
            <th>Selecione sua empresa</th>
            <tr>
                <td>
                    <a href="?empresa=swdorigon">SWDorigon</a>
                </td>
            </tr>
        </table>
    </div>
    <?php
    exit();
}