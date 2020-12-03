<?php

class fabricanteClass {

    private $conn;
    private $IdFabricante;
    private $NomeFabricante;
    public $retorno;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function SearchById($CpoKey) {
        $querySql = "SELECT * FROM tbfabricante " .
                "WHERE " . $CpoKey;
        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->IdFabricante = $row['idfabricante'];
            $this->NomeFabricante = $row['nomefabricante'];
            $this->retorno = '00';
        } else {
            $this->retorno = '02';
        }
    }

    public function searchId() {
        $querySql = "SELECT max(idfabricante) FROM tbfabricante ";

        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->retorno = '00';
            $this->IdFabricante = $row['max(idfabricante)'];
        } else {
            $this->retorno = '02';
        }
    }

    public function insertRegistro() {

        $querySql = "INSERT INTO tbfabricante VALUES ('$this->IdFabricante', " .
                "'$this->NomeFabricante')";
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

        $querySql = "UPDATE tbfabricante SET " .
                "nomefabricante = '" . $this->NomeFabricante . "' " .
                " WHERE idfabricante = " . $this->IdFabricante;
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
        $querySql = "DELETE from tbfabricante WHERE idfabricante = " . $this->IdFabricante;
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

    public function getIdFabricante() {
        return $this->IdFabricante;
    }

    public function getNomeFabricante() {
        return $this->NomeFabricante;
    }

    /* ========================================================
     * SETTER
      ======================================================== */

    public function setIdFabricante($IdFabricante): void {
        $this->IdFabricante = $IdFabricante;
    }

    public function setNomeFabricante($NomeFabricante): void {
        $this->NomeFabricante = $NomeFabricante;
    }

}

?>