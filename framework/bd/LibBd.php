<?php

class LibBd {

    protected $query;
    protected $sql;
    protected $valorChave;

    public function getValorChave() {
        return $this->valorChave;
    }

    public function setValorChave($valorChave) {
        $this->valorChave = $valorChave;
    }

    public function setSql($sql) {
        $this->sql = $sql;
    }

    public function getSql($tabela, $condicao) {
        return fSimNao($tabela, "SELECT * FROM $tabela " . fSimNao($condicao, " WHERE " . $condicao), $this->sql);
    }

    public function query($sql) {
        $this->query = mysqli_query($this->conexao,$sql);

        if (!fVazio(get("debug")))
            $_SESSION["debug"] = get("debug");
        else if (!fVazio(get("DEBUG")))
            $_SESSION["debug"] = get("DEBUG");

        //Se debug = on mostra todos as querys da página.
        if ($_SESSION["debug"] == 'on' || $_SESSION["debug"] == 'ON')
            pr($sql);
        else if ($_SESSION["debug"] == 'error' || $_SESSION["debug"] == 'ERROR')
            error_reporting(E_ALL);
        else if ($_SESSION["debug"] == 'insert' || $_SESSION["debug"] == 'INSERT')
            if(substr(trim($sql),0,6) == "insert" || substr(trim($sql),0,6) == "INSERT")
                pr($sql);
        else if ($_SESSION["debug"] == 'delete' || $_SESSION["debug"] == 'DELETE')
            if(substr(trim($sql),0,6) == "delete" || substr(trim($sql),0,6) == "DELETE")
                pr($sql);
        else if ($_SESSION["debug"] == 'update' || $_SESSION["debug"] == 'UPDATE')
            if(substr(trim($sql),0,6) == "update" || substr(trim($sql),0,6) == "UPDATE")
                pr($sql);
        else if ($_SESSION["debug"] == 'select' || $_SESSION["debug"] == 'SELECT')
            if(substr(trim($sql),0,6) == "select" || substr(trim($sql),0,6) == "SELECT")
                pr($sql);
        else if ($_SESSION["debug"] == 'error' || $_SESSION["debug"] == 'ERROR')
            error_reporting(E_ALL);


        $this->sql = null;
        if(substr(trim($sql),0,6) != "SELECT") {
        
            $CONEXAO_LOG = new Conexao($this->servidor, $this->senha);
            $CONEXAO_LOG->setUsuario($this->usuario);
            $CONEXAO_LOG->setBase($this->base);
            $LOG = array(
                "HIS_NOME" => addslashes((fVazio(mysql_error()) ? 'sucesso' : mysql_error())),
                "USU_LOGIN" => $_SESSION["USUARIO"]["USU_LOGIN"],
                "HIS_MODULO" => $_SESSION["MODULO"],
                "HIS_MOD_CODIGO" => fCoalesce(mysqli_insert_id($this->conexao),$_SESSION["CHAVE_MODULO"]),
                "HIS_ACAO" => fPostGet("acao"),
                "HIS_SQL" => addslashes($sql)
            );
            $_SESSION["CHAVE_MODULO"] = fCoalesce(mysqli_insert_id($this->conexao),$_SESSION["CHAVE_MODULO"]);

            $sql_log = "INSERT INTO HISTORICO ( " . strtoupper(implode(",", array_keys($LOG))) . ")
                         VALUES ('" . implode("','", array_values($LOG)) . "')";

//            var_dump($sql_log);
            $CONEXAO_LOG->conectar();
            mysqli_query($CONEXAO_LOG->conexao,$sql_log);
            $CONEXAO_LOG->desconectar();
            
        }
        return $this->query;
    }

    public function dadoBanco($tabela, $condicao) {
        $this->query($this->getSql($tabela, $condicao));
        $REGISTRO = array();
        while ($registro = mysqli_fetch_array($this->query, MYSQLI_ASSOC)) {
            $REGISTRO[] = $registro;
        }
        return $REGISTRO;
    }

    public function retornaColunaValor($dados) {
        $dados = array_filter($dados);
        $DADOS = array();

        $DADOS["COLUNA"] = str_replace(' ', ', ', fApenasLetra(implode(', ', array_keys($dados))));
        $DADOS["VALOR"] = implode("', '", array_values($dados));
        return $DADOS;
    }

    public function inserir($tabela, $dados, $gravaCodigoPrinciapal = false) {
        $DADOS = $this->retornaColunaValor($dados);
        $sql = "INSERT INTO $tabela ( $DADOS[COLUNA] ) VALUES ('$DADOS[VALOR]')";
        $qry = $this->query($sql);

        if ($gravaCodigoPrinciapal) {
            $this->valorChave = mysqli_insert_id($this->conexao);
        }
        return $qry;
    }

    public function atualizar($tabela, $dados, $condicao,$multi = '') {
        if(!empty($multi)) {
            foreach($multi as $naosei) {
                foreach($naosei as $nome) {
                    unset($dados[str_replace("[]", "", $nome)]);
                }
                
            }
        }
        
        $sql = "UPDATE $tabela SET ";


        foreach ($dados as $coluna => $valor) {
            $sql .= fApenasLetra($coluna) . " = '$valor',";
        }
        $sql = substr($sql, 0, strlen($sql) - 1) . " WHERE $condicao";
        return $this->query($sql);
    }

    public function excluir($tabela, $condicao) {
        $sql = "DELETE FROM $tabela WHERE $condicao";
        return $this->query($sql);
    }
}
