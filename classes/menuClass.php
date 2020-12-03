<?php

class menuClass {

    private $conn;
    private $IdUsuario;
    private $IdModulo;
    private $IdPrograma;
    public $retorno;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function SearchById($CpoKey) {
        $querySql = "SELECT * FROM tbwamenu " .
                "WHERE " . $CpoKey;
        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->IdUsuario = $row['idusuario'];
            $this->IdPrograma = $row['idprograma'];
            $this->IdModulo = $row['idmodulo'];
            $this->retorno = '00';
        } else {
            $this->retorno = '02';
        }
    }

    public function insertRegistro() {

        $querySql = "INSERT INTO tbwamenu VALUES ('$this->IdUsuario', " .
                "'$this->IdModulo', " .
                "'$this->IdPrograma')";
        $stmt = $this->conn->prepare($querySql);

        if ($stmt->execute()) {
            $this->retorno = '00';
            return true;
        } else {
            $this->retorno = '02';
            return false;
        }
    }

    public function deletarRegistro() {
        $querySql = "DELETE from tbwamenu WHERE idusuario = ". $this->IdUsuario  .
                    " and idmodulo = " . $this->IdModulo . 
                    " and idprograma = " . $this->IdPrograma;
        $stmt = $this->conn->prepare($querySql);
        if ($stmt->execute()) {
            $this->retorno = '00';
            return true;
        } else {
            $this->retorno = '02';
            return false;
        }
    }

    /* ========================================================
     * GETTER 
      ======================================================== */
    
    public function getIdUsuario() {
        return $this->IdUsuario;
    }

    public function getIdModulo() {
        return $this->IdModulo;
    }

    public function getIdPrograma() {
        return $this->IdPrograma;
    }

    /* ========================================================
     * SETTER 
      ======================================================== */

    public function setIdUsuario($IdUsuario) {
        $this->IdUsuario = $IdUsuario;
    }

    public function setIdModulo($IdModulo) {
        $this->IdModulo = $IdModulo;
    }

    public function setIdPrograma($IdPrograma) {
        $this->IdPrograma = $IdPrograma;
    }

}

?>