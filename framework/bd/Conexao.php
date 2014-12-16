<?php

require_once $DIR.'/framework/bd/LibBd.php';

class Conexao extends LibBd {

    protected $conexao;
    protected $servidor;
    protected $base;
    protected $senha;
    protected $usuario;

    function __construct($servidor, $senha) {
        $this->servidor = $servidor;
        $this->senha = $senha;

        if (get("acao") == "desconectar") {
            $this->desconectar();
            session_destroy();
            header("Location: index.php");
        }
    }
    
    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
    
    public function setBase($base) {
        $this->base = $base;
    }

    public function desconectar() {
        mysqli_free_result($this->query);
        return mysqli_close($this->conexao);
    }

    public function conectar() {
        if(!$this->conexao = mysqli_connect($this->servidor, $this->usuario, $this->senha)){
            exit("ERRO DE CONEXAO - Contate o Suporte");
        }
        mysqli_select_db($this->conexao, $this->base);
        mysqli_query($this->conexao,"SET time_zone = '-3:00';");
    }
}
