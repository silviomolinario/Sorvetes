<?php

class dadosBancariosClass {

    private $conn;
    private $TipoCadastro;
    private $IdBanco;
    private $IdConta;
    private $Responsavel;
    private $Agencia;
    private $TipoConta;
    private $NumeroConta;
    private $CpfResponsavel;
    private $CnpjResponsavel;
    public $Retorno;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function SearchById($CpoKey) {
        $querySql = "SELECT * FROM tbwadadosbancarios " .
                "WHERE " . $CpoKey;
        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->TipoCadastro = $row['tipocadastro'];
            $this->IdBanco = $row['idbanco'];
            $this->IdConta = $row['idconta'];
            $this->Responsavel = $row['responsavel'];
            $this->Agencia = $row['agencia'];
            $this->TipoConta = $row['tipoconta'];
            $this->NumeroConta = $row['numeroconta'];
            $this->CpfResponsavel = $row['cpfresponsavel'];
            $this->CnpjResponsavel = $row['cnpjresponsavel'];
            $this->retorno = '00';
        } else {
            $this->retorno = '02';
        }
    }

    public function searchId() {
        $querySql = "SELECT max(idconta) " .
                "FROM tbwadadosbancarios " .
                "WHERE tipocadastro = '" . $this->TipoCadastro . "' " .
                "AND idbanco = '" . $this->IdBanco . "' ";
        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->retorno = '00';
            $this->IdConta = $row['max(idconta)'];
        } else {
            $this->retorno = '02';
        }
    }

    public function insertRegistro() {

        $querySql = "INSERT INTO tbwadadosbancarios VALUES ('$this->TipoCadastro', " .
                "'$this->IdBanco'," .
                "'$this->IdConta'," .
                "'$this->Responsavel'," .
                "'$this->Agencia'," .
                "'$this->TipoConta'," .
                "'$this->NumeroConta'," .
                "'$this->CpfResponsavel'," .
                "'$this->CnpjResponsavel'";
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

        $querySql = "UPDATE tbwadadosbancarios SET " .
                "responsavel  = '" . $this->Responsavel . "'," .
                "agencia  = '" . $this->Agencia . "'," .
                "tipoconta  = '" . $this->TipoConta . "'," .
                "numeroconta = '" . $this->NumeroConta . "'," .
                "cpfresponsavel    = '" . $this->CpfResponsavel . "'," .
                "cnpjresponsavel    = '" . $this->CnpjResponsavel . "' " .
                " WHERE tipocadastro = '" . $this->TipoCadastro . "' " .
                "   AND idbanco     = '" . $this->IdBanco . "' " .
                "   AND idconta    = '" . $this->IdConta . "' ";
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


        $querySql = "DELETE from tbwadadosbancarios " .
                " WHERE tipocadastro = '" . $this->TipoCadastro . "' " .
                "   AND idbanco     = '" . $this->IdBanco . "' " .
                "   AND idconta    = '" . $this->IdConta . "' ";

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

    public function getTipoCadastro() {
        return $this->TipoCadastro;
    }

    public function getIdBanco() {
        return $this->IdBanco;
    }

    public function getIdConta() {
        return $this->IdConta;
    }

    public function getResponsavel() {
        return $this->Responsavel;
    }

    public function getAgencia() {
        return $this->Agencia;
    }

    public function getTipoConta() {
        return $this->TipoConta;
    }

    public function getNumeroConta() {
        return $this->NumeroConta;
    }

    public function getCpfResponsavel() {
        return $this->CpfResponsavel;
    }

    public function getCnpjResponsavel() {
        return $this->CnpjResponsavel;
    }

    /* =============================================================
     * SETTER
      ============================================================= */

    public function setTipoCadastro($TipoCadastro) {
        $this->TipoCadastro = $TipoCadastro;
    }

    public function setIdBanco($IdBanco) {
        $this->IdBanco = $IdBanco;
    }

    public function setIdConta($IdConta) {
        $this->IdConta = $IdConta;
    }

    public function setResponsavel($Responsavel) {
        $this->Responsavel = $Responsavel;
    }

    public function setAgencia($Agencia) {
        $this->Agencia = $Agencia;
    }

    public function setTipoConta($TipoConta) {
        $this->TipoConta = $TipoConta;
    }

    public function setNumeroConta($NumeroConta) {
        $this->NumeroConta = $NumeroConta;
    }

    public function setCpfResponsavel($CpfResponsavel) {
        $this->CpfResponsavel = $CpfResponsavel;
    }

    public function setCnpjResponsavel($CnpjResponsavel) {
        $this->CnpjResponsavel = $CnpjResponsavel;
    }

}

?>