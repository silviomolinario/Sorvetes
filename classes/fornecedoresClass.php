<?php

class fornecedoresClass {

    private $conn;
    private $IdFornecedor;
    private $TipoCadastro;
    private $Cnpj;
    private $Ie;
    private $Im;
    private $Cnae;
    private $Cpf;
    private $Rg;
    private $RazaoSocial;
    private $NomeFantasia;
    private $Cep;
    private $Endereco;
    private $Numero;
    private $Complemento;
    private $Bairro;
    private $IdMunicipio;
    private $IdEstado;
    private $TipoFornecedor;
    private $Fone;
    private $Fax;
    private $Celular;
    private $Contato;
    private $Email;
    private $Site;
    private $Facebook;
    private $Instagram;
    private $IdEmpresa;
    private $IdUsuarioCad;
    private $DtCadastro;
    private $IdUsuarioAtlz;
    private $DtAtlz;
    private $StatusFornecedor;
    public $retorno;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function SearchById($CpoKey) {
        $querySql = "SELECT * FROM tbwafornececedores " .
                "WHERE " . $CpoKey;
        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->IdFornecedor = $row['idfornecedor'];
            $this->TipoCadastro = $row['tipocadastro'];
            $this->Cnpj = $row['cnpj'];
            $this->Ie = $row['ie'];
            $this->Im = $row['im'];
            $this->Cnae = $row['cnae'];
            $this->Rg = $row['rg'];
            $this->RazaoSocial = $row['razaosocial'];
            $this->NomeFantasia = $row['nomefantasia'];
            $this->Cep = $row['cep'];
            $this->Endereco = $row['endereco'];
            $this->Numero = $row['numero'];
            $this->Complemento = $row['complemento'];
            $this->Bairro = $row['bairro'];
            $this->IdMunicipio = $row['idmunicipio'];
            $this->IdEstado = $row['idestado'];
            $this->TipoFornecedor = $row['tipofornecedor'];
            $this->Fone = $row['fone'];
            $this->Fax = $row['fax'];
            $this->Celular = $row['celular'];
            $this->Contato = $row['contato'];
            $this->Email = $row['email'];
            $this->Site = $row['site'];
            $this->Facebook = $row['facebook'];
            $this->Instagram = $row['instagram'];
            $this->IdEmpresa = $row['idempresa'];
            $this->IdUsuarioAtlz = $row['idusuariocad'];
            $this->DtCadastro = $row['dtcadastro'];
            $this->IdUsuarioAtlz = $row['idusuarioatlz'];
            $this->DtAtlz = $row['dtatlz'];
            $this->StatusFornecedor = $row['statusfornecedor'];
            $this->retorno = '00';
        } else {
            $this->retorno = '02';
        }
    }

    public function searchId() {
        $querySql = "SELECT max(idfornecedor) FROM tbwafornececedores ";

        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->retorno = '00';
            $this->idfornecedor = $row['max(idfornecedor)'];
        } else {
            $this->retorno = '02';
        }
    }

    public function insertRegistro() {

        $querySql = "INSERT INTO tbwafornececedores VALUES ('$this->idfornecedor', " .
                "'$this->TipoCadastro'," .
                "'$this->Cnpj'," .
                "'$this->Ie'," .
                "'$this->Im'," .
                "'$this->Cnae'," .
                "'$this->Cpf'," .
                "'$this->Rg'," .
                "'$this->RazaoSocial'," .
                "'$this->NomeFantasia'," .
                "'$this->Cep'," .
                "'$this->Endereco'," .
                "'$this->Numero'," .
                "'$this->Complemento'," .
                "'$this->Bairro'," .
                "'$this->IdMunicipio'," .
                "'$this->IdEstado'," .
                "'$this->TipoFornecedor'," .
                "'$this->Fone'," .
                "'$this->Fax'," .
                "'$this->Celular'," .
                "'$this->Contato'," .
                "'$this->Email'," .
                "'$this->Site'," .
                "'$this->Facebook'," .
                "'$this->Instagram'," .
                "'$this->IdEmpresa',";
                "'$this->IdUsuarioCad',";
                "'$this->DtCadastro',";
                "'$this->IdUsuarioAtlz',";
                "'$this->DtAtlz',";
                "'$this->StatusFornecedor')";
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

        $querySql = "UPDATE tbwafornececedores SET " .
                "tipocadastro     = '" . $this->TipoCadastro . "'," .
                "cnpj             = '" . $this->Cnpj . "'," .
                "ie               = '" . $this->Ie . "'," .
                "im               = '" . $this->Im . "'," .
                "cnae             = '" . $this->Cnae . "'," .
                "cpf              = '" . $this->Cpf . "'," .
                "rg               = '" . $this->Rg . "'," .
                "razaosocial      = '" . $this->RazaoSocial . "'," .
                "nomefantasia     = '" . $this->NomeFantasia . "'," .
                "cep              = '" . $this->Cep . "'," .
                "endereco         = '" . $this->Endereco . "'," .
                "numero           = '" . $this->Numero . "'," .
                "complemento      = '" . $this->Complemento . "'," .
                "bairro           = '" . $this->Bairro . "'," .
                "idmunicipio      = '" . $this->IdMunicipio . "'," .
                "idestado         = '" . $this->IdEstado . "'," .
                "tipofornecedor   = '" . $this->TipoFornecedor . "'," .
                "fone             = '" . $this->Fone . "'," .
                "fax              = '" . $this->Fax . "'," .
                "celular          = '" . $this->Celular . "'," .
                "contato          = '" . $this->Contato . "'," .
                "email            = '" . $this->Email . "'," .
                "site             = '" . $this->Site . "'," .
                "facebook         = '" . $this->Facebook . "'," .
                "instagram        = '" . $this->Instagram . "'," .
                "idempresa        = '" . $this->IdEmpresa . "', " .
                "idusuariocad     = '" . $this->IdUsuarioCad . "', " .
                "dtcadastro       = '" . $this->DtCadastro . "', " .
                "idusuarioatlz    = '" . $this->IdUsuarioAtlz . "', " .
                "dtatlz           = '" . $this->DtAtlz . "' " .
                " WHERE idfornecedor = " . $this->IdFornecedor;
        $stmt = $this->conn->prepare($querySql);

        if ($stmt->execute()) {
            $this->retorno = '00';
            return true;
        } else {
            $this->retorno = '02';
            return false;
        }
    }


    public function alterarStatus() {
        $querySql = "UPDATE tbwafornececedores SET " .
                "idusuarioatlz    = '" . $this->IdUsuarioAtlz . "', " .
                "dtatlz           = '" . $this->DtAtlz . "', " .
                "statusfornecedor = '" . $this->StatusFornecedor . "' " .
                " WHERE idfornecedor = " . $this->IdFornecedor;
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


        $querySql = "DELETE from tbwafornececedores WHERE idfornecedor = " . $this->IdFornecedor;
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

    public function getIdFornecedor() {
        return $this->IdFornecedor;
    }

    public function getTipoCadastro() {
        return $this->TipoCadastro;
    }

    public function getCnpj() {
        return $this->Cnpj;
    }

    public function getIe() {
        return $this->Ie;
    }

    public function getIm() {
        return $this->Im;
    }

    public function getCnae() {
        return $this->Cnae;
    }

    public function getCpf() {
        return $this->Cpf;
    }

    public function getRg() {
        return $this->Rg;
    }

    public function getRazaoSocial() {
        return $this->RazaoSocial;
    }

    public function getNomeFantasia() {
        return $this->NomeFantasia;
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

    public function getTipoFornecedor() {
        return $this->TipoFornecedor;
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

    public function getContato() {
        return $this->Contato;
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

    public function getIdEmpresa() {
        return $this->IdEmpresa;
    }
    
    public function getIdUsuarioCad() {
        return $this->IdUsuarioCad;
    }

    public function getDtCadastro() {
        return $this->DtCadastro;
    }

    public function getIdUsuarioAtlz() {
        return $this->IdUsuarioAtlz;
    }

    public function getDtAtlz() {
        return $this->DtAtlz;
    }

    public function getStatusFornecedor() {
        return $this->StatusFornecedor;
    }

    /* ========================================================
     * SETTER
      ======================================================== */
    
    public function setIdFornecedor($IdFornecedor) {
        $this->IdFornecedor = $IdFornecedor;
    }

    public function setTipoCadastro($TipoCadastro) {
        $this->TipoCadastro = $TipoCadastro;
    }

    public function setCnpj($Cnpj) {
        $this->Cnpj = $Cnpj;
    }

    public function setIe($Ie) {
        $this->Ie = $Ie;
    }

    public function setIm($Im) {
        $this->Im = $Im;
    }

    public function setCnae($Cnae) {
        $this->Cnae = $Cnae;
    }

    public function setCpf($Cpf) {
        $this->Cpf = $Cpf;
    }

    public function setRg($Rg) {
        $this->Rg = $Rg;
    }

    public function setRazaoSocial($RazaoSocial) {
        $this->RazaoSocial = $RazaoSocial;
    }

    public function setNomeFantasia($NomeFantasia) {
        $this->NomeFantasia = $NomeFantasia;
    }

    public function setCep($Cep) {
        $this->Cep = $Cep;
    }

    public function setEndereco($Endereco) {
        $this->Endereco = $Endereco;
    }

    public function setNumero($Numero) {
        $this->Numero = $Numero;
    }

    public function setComplemento($Complemento) {
        $this->Complemento = $Complemento;
    }

    public function setBairro($Bairro) {
        $this->Bairro = $Bairro;
    }

    public function setIdMunicipio($IdMunicipio) {
        $this->IdMunicipio = $IdMunicipio;
    }

    public function setIdEstado($IdEstado) {
        $this->IdEstado = $IdEstado;
    }

    public function setTipoFornecedor($TipoFornecedor) {
        $this->TipoFornecedor = $TipoFornecedor;
    }

    public function setFone($Fone) {
        $this->Fone = $Fone;
    }

    public function setFax($Fax) {
        $this->Fax = $Fax;
    }

    public function setCelular($Celular) {
        $this->Celular = $Celular;
    }

    public function setContato($Contato) {
        $this->Contato = $Contato;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }

    public function setSite($Site) {
        $this->Site = $Site;
    }

    public function setFacebook($Facebook) {
        $this->Facebook = $Facebook;
    }

    public function setInstagram($Instagram) {
        $this->Instagram = $Instagram;
    }

    public function setIdEmpresa($IdEmpresa) {
        $this->IdEmpresa = $IdEmpresa;
    }

    public function setIdUsuarioCad($IdUsuarioCad){
        $this->IdUsuarioCad = $IdUsuarioCad;
    }

    public function setDtCadastro($DtCadastro) {
        $this->DtCadastro = $DtCadastro;
    }

    public function setIdUsuarioAtlz($IdUsuarioAtlz) {
        $this->IdUsuarioAtlz = $IdUsuarioAtlz;
    }

    public function setDtAtlz($DtAtlz) {
        $this->DtAtlz = $DtAtlz;
    }

    public function setStatusFornecedor($StatusFornecedor) {
        $this->StatusFornecedor = $StatusFornecedor;
    }
    
}

?>