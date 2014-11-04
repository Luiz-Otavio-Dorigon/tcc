<script src="framework/lib/jquery/<?= $_SESSION["jquery"]["versao"] ?>/jquery.js"></script>
<script src="framework/lib/jquery/1.11/jquery.dataTables.min.js"></script>
<script src="framework/lib/jquery/1.11/jquery.dataTables.min.js"></script>
<script src="framework/lib/bootstrap/3.0.3/js/bootstrap.js"></script>

<script>

    $(document).ready(function() {
    $('#example').dataTable( {
        "language": {
            "lengthMenu": "Registros por página _MENU_",
            "zeroRecords": "Nenhum dado encontrado",
            "info": "",
            "infoEmpty": "",
            "infoFiltered": "",
            "sSearch": "Buscar: "
       }
    } );
} );

    $(document).ready(function() {
        $('.btn-file :file').on('fileselect', function(event, numFiles, label) {

            var input = $(this).parents('.input-group').find(':text'),
                    log = numFiles > 1 ? numFiles + ' files selected' : label;

            if (input.length) {
                input.val(log);
            } else {
                if (log)
                    alert(log);
            }

        });
    });

    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
                numFiles = input.get(0).files ? input.get(0).files.length : 1,
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    function jMultiCombo(modulo, identificacao, opcoes, extra) {
        var html = '<select class="form-control" name="' + identificacao + '[]" id="' + identificacao + '[]" >' + opcoes + '</select>' + extra + '<br/ >';
        $('#multi_' + modulo).append(html);
        return false;
    }

    //Tipo Q para formatar quantidade.
    //Tipo C para formatar o valor que é setado no campo.
    function jValor(numero, tipo) {
        if (tipo == 'Q')
            return numero.replace(".", "").replace(",", ".");
        if (tipo == 'C')
            return numero.replace(".", ",");
    }

    function jNumeroVirgula(e) {
        var tecla = (window.event) ? event.keyCode : e.which;
        if ((tecla > 47 && tecla < 58) || tecla == 44)
            return true;
        else {
            if (tecla == 8 || tecla == 0)
                return true;
            else
                return false;
        }
    }

    /*
     function replaceAll(variavel, token, newtoken) {
     var teste = variavel;
     teste = teste.length - 1;
     for (i = 0; i < teste.length; i++) {
     if (variavel.charAt(i) == token) {
     variavel = variavel.replace(token, newtoken);
     }
     }
     return variavel;
     }
     
     function jValor(str, tipo) {
     str = str + '';
     if (!tipo) {
     if (str != '') {
     //str = str.replace(eval('/'+"."+'/g'), "");
     //var busca = "."
     //var pp = eval('/'+busca+'/g');
     //console.log(pp)
     //str = str.replace(pp, "");
     str = str.replace(/[\.-]/g, "");
     str = str.replace(",", ".");
     
     } else {
     str = '0';
     }
     } else {
     if (str != '') {
     str = str.replace(".", ",");
     } else {
     str = '0';
     }
     }
     var result = parseFloat(str.replace(",", "."));
     return result.toFixed(2);
     }
     
     function jQtd (qtd) {
     qtd = qtd.replace(".","");
     var nQtd = parseFloat(qtd.replace(",","."));
     return nQtd.toFixed(2);
     }
     */
</script>