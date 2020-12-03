<?php

class filiaisClass {

    private $conn;
    private $IdFilial;
    private $IdEmpresa;
    private $RazaoSocial;
    private $NomeFantasia;
    private $Cnpj;
    private $Ie;
    private $IeSubTrib;
    private $Im;
    private $Cnae;
    private $RegimeTrib;
    private $Cep;
    private $Endereco;
    private $Numero;
    private $Complemento;
    private $Bairro;
    private $IdMunicipio;
    private $IdEstado;
    private $Fone;
    private $Fax;
    private $Celular;
    private $Whataspp;
    private $Email;
    private $Site;
    private $Facebook;
    private $Instagram;
    private $Status;
    private $DataInclusao;
    private $IdUsuarioInc;
    private $DataAtlz;
    private $IdUsuarioAtlz;
    public $retorno;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function SearchById($CpoKey) {
        $querySql = "SELECT * FROM tbwafiliais " .
                "WHERE " . $CpoKey;
        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->IdFilial = $row['idfilial'];
            $this->IdEmpresa = $row['idempresa'];
            $this->RazaoSocial = $row['razaosocial'];
            $this->NomeFantasia = $row['nomefantasia'];
            $this->Cnpj = $row['cnpj'];
            $this->Ie = $row['ie'];
            $this->IeSubTrib = $row['iesubtrib'];
            $this->Im = $row['im'];
            $this->Cnae = $row['cnae'];
            $this->RegimeTrib = $row['regimetrib'];
            $this->Cep = $row['cep'];
            $this->Endereco = $row['endereco'];
            $this->Numero = $row['numero'];
            $this->Complemento = $row['complemento'];
            $this->Bairro = $row['bairro'];
            $this->IdMunicipio = $row['idmunicipio'];
            $this->IdEstado = $row['idestado'];
            $this->Fone = $row['fone'];
            $this->Fax = $row['fax'];
            $this->Celular = $row['celular'];
            $this->Whataspp = $row['whatsapp'];
            $this->Email = $row['email'];
            $this->Site = $row['site'];
            $this->Facebook = $row['facebook'];
            $this->Instagram = $row['instagram'];
            $this->Status = $row['status'];
            $this->DataInclusao = $row['datainclusao'];
            $this->IdUsuarioInc = $row['idusuarioinc'];
            $this->DataAtlz = $row['dataatlz'];
            $this->IdUsuarioAtlz = $row['idusuarioatlz'];
            $this->retorno = '00';
        } else {
            $this->retorno = '02';
        }
    }

    public function searchId() {
        $querySql = "SELECT max(idfilial) FROM tbwafiliais ";

        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->retorno = '00';
            $this->IdFilial = $row['max(idfilial)'];
        } else {
            $this->retorno = '02';
        }
    }

    public function insertRegistro() {

        $querySql = "INSERT INTO tbwafiliais VALUES ('$this->IdFilial', " .
                "'$this->IdEmpresa', " .
                "'$this->RazaoSocial'," .
                "'$this->NomeFantasia'," .
                "'$this->Cnpj'," .
                "'$this->Ie'," .
                "'$this->IeSubTrib'," .
                "'$this->Im'," .
                "'$this->Cnae'," .
                "'$this->RegimeTrib'," .
                "'$this->Cep'," .
                "'$this->Endereco'," .
                "'$this->Numero'," .
                "'$this->Complemento'," .
                "'$this->Bairro'," .
                "'$this->IdMunicipio'," .
                "'$this->IdEstado'," .
                "'$this->Fone'," .
                "'$this->Fax'," .
                "'$this->Celular'," .
                "'$this->Whataspp'," .
                "'$this->Email'," .
                "'$this->Site'," .
                "'$this->Facebook'," .
                "'$this->Instagram'," .
                "'$this->Status'," .
                "'$this->IdUsuarioInc'," .
                "'$this->DataInclusao'," .
                "'$this->IdUsuarioAtlz',".
                "'$this->DataAtlz')";
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

        $querySql = "UPDATE tbwafiliais SET " .
                "razaosocial = '" . $this->RazaoSocial . "'," .
                "nomefantasia = '" . $this->NomeFantasia . "'," .
                "cnpj = '" . $this->Cnpj . "'," .
                "ie = '" . $this->Ie . "'," .
                "iesubtrib = '" . $this->IeSubTrib . "'," .
                "im = '" . $this->Im . "'," .
                "cnae = '" . $this->Cnae . "'," .
                "regimetrib = '" . $this->RegimeTrib . "'," .
                "cep = '" . $this->Cep . "'," .
                "endereco = '" . $this->Endereco . "'," .
                "numero = '" . $this->Numero . "'," .
                "complemento = '" . $this->Complemento . "'," .
                "bairro = '" . $this->Bairro . "'," .
                "idmunicipio = '" . $this->IdMunicipio . "'," .
                "idestado = '" . $this->IdEstado . "'," .
                "fone = '" . $this->Fone . "'," .
                "fax = '" . $this->Fax . "'," .
                "celular = '" . $this->Celuar . "'," .
                "whatsapp = '" . $this->Whatsapp . "'," .
                "email = '" . $this->Email . "'," .
                "site = '" . $this->Site . "'," .
                "facebook = '" . $this->Facebook . "'," .
                "instagram = '" . $this->Instagram . "'," .
                "idusuarioatlz = '" . $this->IdUsuarioAtlz . "', ".
                "dataatlz = '" . $this->DataAtlz . "' ";
        " WHERE idfilial = " . $this->IdFilial;
        $stmt = $this->conn->prepare($querySql);

        if ($stmt->execute()) {
            $this->retorno = '00';
            return true;
        } else {
            $this->retorno = '02';
            return false;
        }
    }

    public function atualizaStatus() {
        $querySql = "UPDATE tbwafiliais SET status = '" . $this->Status .
                " WHERE idfilial = " . $this->IdFilial;
    }

    /* ========================================================
     * GETTER AND SETTER
      ======================================================== */

    public function getIdFilial() {
        return $this->IdFilial;
    }

    public function getIdEmpresa() {
        return $this->IdEmpresa;
    }

    public function getRazaoSocial() {
        return $this->RazaoSocial;
    }

    public function getNomeFantasia() {
        return $this->NomeFantasia;
    }

    public function getCnpj() {
        return $this->Cnpj;
    }

    public function getIe() {
        return $this->Ie;
    }

    public function getIeSubTrib() {
        return $this->IeSubTrib;
    }

    public function getIm() {
        return $this->Im;
    }

    public function getCnae() {
        return $this->Cnae;
    }

    public function getRegimeTrib() {
        return $this->RegimeTrib;
    }

    public function getCep() {
        return $this->Cep;
    }

    public function getEndereco() {
        return $this->Endereco;
    }

    public function getNumero() {
        return $this->Numero;
    }

    public function getComplemento() {
        return $this->Complemento;
    }

    public function getBairro() {
        return $this->Bairro;
    }

    public function getIdMunicipio() {
        return $this->IdMunicipio;
    }

    public function getIdEstado() {
        return $this->IdEstado;
    }

    public function getFone() {
        return $this->Fone;
    }

    public function getFax() {
        return $this->Fax;
    }

    public function getCelular() {
        return $this->Celular;
    }

    public function getWhataspp() {
        return $this->Whataspp;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function getSite() {
        return $this->Site;
    }

    public function getFacebook() {
        return $this->Facebook;
    }

    public function getInstagram() {
        return $this->Instagram;
    }

    public function getStatus() {
        return $this->Status;
    }

    public function getDataInclusao() {
        return $this->DataInclusao;
    }

    public function getIdUsuarioInc() {
        return $this->IdUsuarioInc;
    }

    public function getDataAtlz() {
        return $this->DataAtlz;
    }

    public function getIdUsuarioAtlz() {
        return $this->IdUsuarioAtlz;
    }

    public function setIdFilial($IdFilial) {
        $this->IdFilial = $IdFilial;
        return $this;
    }

    public function setIdEmpresa($IdEmpresa) {
        $this->IdEmpresa = $IdEmpresa;
        return $this;
    }

    public function setRazaoSocial($RazaoSocial) {
        $this->RazaoSocial = $RazaoSocial;
        return $this;
    }

    public function setNomeFantasia($NomeFantasia) {
        $this->NomeFantasia = $NomeFantasia;
        return $this;
    }

    public function setCnpj($Cnpj) {
        $this->Cnpj = $Cnpj;
        return $this;
    }

    public function setIe($Ie) {
        $this->Ie = $Ie;
        return $this;
    }

    public function setIeSubTrib($IeSubTrib) {
        $this->IeSubTrib = $IeSubTrib;
        return $this;
    }

    public function setIm($Im) {
        $this->Im = $Im;
        return $this;
    }

    public function setCnae($Cnae) {
        $this->Cnae = $Cnae;
        return $this;
    }

    public function setRegimeTrib($RegimeTrib) {
        $this->RegimeTrib = $RegimeTrib;
        return $this;
    }

    public function setCep($Cep) {
        $this->Cep = $Cep;
        return $this;
    }

    public function setEndereco($Endereco) {
        $this->Endereco = $Endereco;
        return $this;
    }

    public function setNumero($Numero) {
        $this->Numero = $Numero;
        return $this;
    }

    public function setComplemento($Complemento) {
        $this->Complemento = $Complemento;
        return $this;
    }

    public function setBairro($Bairro) {
        $this->Bairro = $Bairro;
        return $this;
    }

    public function setIdMunicipio($IdMunicipio) {
        $this->IdMunicipio = $IdMunicipio;
        return $this;
    }

    public function setIdEstado($IdEstado) {
        $this->IdEstado = $IdEstado;
        return $this;
    }

    public function setFone($Fone) {
        $this->Fone = $Fone;
        return $this;
    }

    public function setFax($Fax) {
        $this->Fax = $Fax;
        return $this;
    }

    public function setCelular($Celular) {
        $this->Celular = $Celular;
        return $this;
    }

    public function setWhataspp($Whataspp) {
        $this->Whataspp = $Whataspp;
        return $this;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
        return $this;
    }

    public function setSite($Site) {
        $this->Site = $Site;
        return $this;
    }

    public function setFacebook($Facebook) {
        $this->Facebook = $Facebook;
        return $this;
    }

    public function setInstagram($Instagram) {
        $this->Instagram = $Instagram;
        return $this;
    }

    public function setStatus($Status) {
        $this->Status = $Status;
        return $this;
    }

    public function setDataInclusao($DataInclusao) {
        $this->DataInclusao = $DataInclusao;
        return $this;
    }

    public function setIdUsuarioInc($IdUsuarioInc) {
        $this->IdUsuarioInc = $IdUsuarioInc;
        return $this;
    }

    public function setDataAtlz($DataAtlz) {
        $this->DataAtlz = $DataAtlz;
        return $this;
    }

    public function setIdUsuarioAtlz($IdUsuarioAtlz) {
        $this->IdUsuarioAtlz = $IdUsuarioAtlz;
        return $this;
    }

}

?>