<?php

class bancosClass {

    private $conn;
    private $IdBanco;
    private $NomeBanco;
    public $Retorno;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function SearchById($CpoKey) {
        $querySql = "SELECT * FROM tbwabancos " .
                "WHERE " . $CpoKey;
        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->IdBanco = $row['idbanco'];
            $this->NomeBanco = $row['nomebanco'];
            $this->retorno = '00';
        } else {
            $this->retorno = '02';
        }
    }

    public function searchId() {
        $querySql = "SELECT max(idbanco) " .
                "FROM tbwabancos ";
        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->retorno = '00';
            $this->IdBanco = $row['max(idbanco)'];
        } else {
            $this->retorno = '02';
        }
    }

    public function insertRegistro() {

        $querySql = "INSERT INTO tbwabancos VALUES ('$this->IdBanco', " .
                "'$this->NomeBanco')";
        $stmt = $this->conn->prepare($querySql);

        if ($stmt->execute()) {
            $this->retorno = '00';
            return true;
        } else {
            $this->retorno = '02';
            return false;
        }
    }

    public function updateRegistro() {

        $querySql = "UPDATE tbwabancos SET " .
                "nomebanco  = '" . $this->NomeBanco . "' " .
                " WHERE idbanco = " . $this->IdBanco;
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


        $querySql = "DELETE from tbwabancos " .
                " WHERE idbanco = '" . $this->IdBanco;

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

    public function getIdBanco() {
        return $this->IdBanco;
    }

    public function getNomeBanco() {
        return $this->NomeBanco;
    }

    /* =============================================================
     * SETTER
      ============================================================= */

    public function setIdBanco($IdBanco){
        $this->IdBanco = $IdBanco;
    }

    public function setNomeBanco($NomeBanco){
        $this->NomeBanco = $NomeBanco;
    }

}

?>