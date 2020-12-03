<?php

class SorvetesClass {

    private $conn;
    private $IdSorvete;
    private $IdFabricante;
    private $Sabor;
    private $quantidade;
    public $retorno;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function SearchById($CpoKey) {
        $querySql = "SELECT * FROM tbsorvetes " .
                "WHERE " . $CpoKey;
        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->IdSorvete = $row['idsorvete'];
            $this->IdFabricante = $row['idfabricante'];
            $this->Sabor = $row['sabor'];
            $this->Quantidade = $row['quantidade'];
            $this->retorno = '00';
        } else {
            $this->retorno = '02';
        }
    }

    public function searchId() {
        $querySql = "SELECT max(idsorvete) FROM tbsorvetes ";

        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->retorno = '00';
            $this->IdSorvete = $row['max(idsorvete)'];
        } else {
            $this->retorno = '02';
        }
    }

    public function insertRegistro() {

        $querySql = "INSERT INTO tbsorvetes VALUES ('$this->IdSorvete', " .
                "'$this->Sabor', ".
                "'$this->Quantidade', ".
                "'$this->IdFabricante')";
        
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

        $querySql = "UPDATE tbsorvetes SET " .
                "sabor = '" . $this->Sabor . "', " .
                "sabor = '" . $this->Quantidade . "', " .
                "idfabricante = '" . $this->IdFabricante . "' " .
                " WHERE idsorvete = " . $this->IdSorvete;
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
        $querySql = "DELETE from tbsorvetes WHERE idsorvete = " . $this->IdSorvete;
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
    public function getIdSorvete() {
        return $this->IdSorvete;
    }

    public function getIdFabricante() {
        return $this->IdFabricante;
    }

    public function getSabor() {
        return $this->Sabor;
    }

    public function getQuantidade() {
        return $this->Quantidade;
    }
    
    /* ========================================================
     * SETTER
      ======================================================== */
    public function setIdSorvete($IdSorvete) {
        $this->IdSorvete = $IdSorvete;
    }

    public function setIdFabricante($IdFabricante) {
        $this->IdFabricante = $IdFabricante;
    }

    public function setSabor($Sabor) {
        $this->Sabor = $Sabor;
    }

    public function setQuantidade($Quantidade) {
        $this->Quantidade = $Quantidade;
    }

}

?>