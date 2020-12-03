<?php

class contatosClass {

    private $conn;
    private $TipoCadastro;
    private $IdPessoa;
    private $Sequencia;
    private $Contato;
    private $FoneCom;
    private $FoneRes;
    private $FoneCel;
    private $Whatsapp;
    private $Skype;
    private $Email;
    private $Facebook;
    private $Instagram;
    private $Linkedin;
    public $Retorno;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function SearchById($CpoKey) {
        $querySql = "SELECT * FROM tbwacontatos " .
                "WHERE " . $CpoKey;
        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->TipoCadastro = $row['tipocadastro'];
            $this->IdPessoa = $row['idpessoa'];
            $this->Sequencia = $row['sequencia'];
            $this->Contato = $row['contato'];
            $this->FoneCom = $row['fonecom'];
            $this->FoneRes = $row['foneres'];
            $this->FoneCel = $row['fonecel'];
            $this->Whatsapp = $row['whatsapp'];
            $this->Skype = $row['skype'];
            $this->Email = $row['email'];
            $this->Facebook = $row['facebook'];
            $this->Instagram = $row['instagram'];
            $this->Linkedin = $row['linkedin'];
            $this->retorno = '00';
        } else {
            $this->retorno = '02';
        }
    }

    public function searchId() {
        $querySql = "SELECT max(sequencia) " .
                "FROM tbwacontatos " .
                "WHERE tipocadastro = '" . $this->TipoCadastro . "' " .
                "AND idpessoa = '" . $this->IdPessoa . "' ";
        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->retorno = '00';
            $this->sequencia = $row['max(sequencia)'];
        } else {
            $this->retorno = '02';
        }
    }

    public function insertRegistro() {

        $querySql = "INSERT INTO tbwacontatos VALUES ('$this->TipoCadastro', " .
                "'$this->IdPessoa'," .
                "'$this->Sequencia'," .
                "'$this->Contato'," .
                "'$this->FoneCom'," .
                "'$this->FoneCel'," .
                "'$this->Whatsapp'," .
                "'$this->Skype'," .
                "'$this->Email'," .
                "'$this->Facebook'," .
                "'$this->Instagram'," .
                "'$this->Linkedin')";
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

        $querySql = "UPDATE tbwacontatos SET " .
                "contato  = '" . $this->Contato . "'," .
                "fonecom  = '" . $this->FoneCom . "'," .
                "fonecel  = '" . $this->FoneCel . "'," .
                "whatsapp = '" . $this->Whatsapp . "'," .
                "skype    = '" . $this->Skype . "'," .
                "email    = '" . $this->Email . "'," .
                "facebook = '" . $this->Facebook . "'," .
                "instagram = '" . $this->Instagram . "'," .
                "linkedin = '" . $this->Linkedin . "' " .
                " WHERE tipocadastro = '" . $this->TipoCadastro . "' " .
                "   AND idpessoa     = '" . $this->IdPessoa . "' " .
                "   AND sequencia    = '" . $this->Sequencia . "' ";
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


        $querySql = "DELETE from tbwacontatos " .
                " WHERE tipocadastro = '" . $this->TipoCadastro . "' " .
                "   AND idpessoa     = '" . $this->IdPessoa . "' " .
                "   AND sequencia    = '" . $this->Sequencia . "' ";

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

    public function getIdPessoa() {
        return $this->IdPessoa;
    }

    public function getSequencia() {
        return $this->Sequencia;
    }

    public function getContato() {
        return $this->Contato;
    }

    public function getFoneCom() {
        return $this->FoneCom;
    }

    public function getFoneRes() {
        return $this->FoneRes;
    }

    public function getFoneCel() {
        return $this->FoneCel;
    }

    public function getWhatsapp() {
        return $this->Whatsapp;
    }

    public function getSkype() {
        return $this->Skype;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function getFacebook() {
        return $this->Facebook;
    }

    public function getInstagram() {
        return $this->Instagram;
    }

    public function getLinkedin() {
        return $this->Linkedin;
    }

    /* =============================================================
     * SETTER
      ============================================================= */

    public function setTipoCadastro($TipoCadastro) {
        $this->TipoCadastro = $TipoCadastro;
    }

    public function setIdPessoa($IdPessoa) {
        $this->IdPessoa = $IdPessoa;
    }

    public function setSequencia($Sequencia) {
        $this->Sequencia = $Sequencia;
    }

    public function setContato($Contato) {
        $this->Contato = $Contato;
    }

    public function setFoneCom($FoneCom) {
        $this->FoneCom = $FoneCom;
    }

    public function setFoneRes($FoneRes) {
        $this->FoneRes = $FoneRes;
    }

    public function setFoneCel($FoneCel) {
        $this->FoneCel = $FoneCel;
    }

    public function setWhatsapp($Whatsapp) {
        $this->Whatsapp = $Whatsapp;
    }

    public function setSkype($Skype) {
        $this->Skype = $Skype;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }

    public function setFacebook($Facebook) {
        $this->Facebook = $Facebook;
    }

    public function setInstagram($Instagram) {
        $this->Instagram = $Instagram;
    }

    public function setLinkedin($Linkedin) {
        $this->Linkedin = $Linkedin;
    }

}

?>