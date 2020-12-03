<?php

class EmpresaClass {

    private $conn;
    public $idEmpresa;
    public $RazaoSocial;
    public $NomeFantasia;
    public $Cnpj;
    public $Ie;
    public $IeSubTrib;
    public $Im;
    public $Cnae;
    public $RegimeTrib;
    public $Cep;
    public $Endereco;
    public $Numero;
    public $Complemento;
    public $Bairro;
    public $IdMunicipio;
    public $IdEstado;
    public $Fone;
    public $Fax;
    public $Celular;
    public $Whataspp;
    public $Email;
    public $Site;
    public $Facebook;
    public $Instagram;
    public $Logo;
    public $DataInclusao;
    public $IdUsuarioInc;
    public $DataAtlz;
    public $IdUsuarioAtlz;
    public $retorno;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function lerEmpresas($CpoKey) {
        $querySql = "SELECT * FROM tbwaempresas " .
                "WHERE ". $CpoKey;
        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->idEmpresa = $row['idempresa'];
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
            $this->Logo = $row['logo'];
            $this->DataInclusao = $row['datainclusao'];
            $this->IdUsuarioInc = $row['idusuarioinc'];
            $this->DataAtlz = $row['dataatlz'];
            $this->IdUsuarioAtlz = $row['idusuarioatlz'];
            $this->retorno = '00';
        } else {
            $this->retorno = '02';
        }
    }

    public function searchId(){
        $querySql = "SELECT max(idempresa) FROM tbwaempresas "; 
       
       
        $stmt = $this->conn->prepare( $querySql );
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
 
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row){
            $this->retorno      = '00';
            $this->idEmpresa = $row['max(idempresa)'];
       }else{
            $this->retorno = '02';
       }
    }
    
    
    public function insertRegistro() {

        $querySql = "INSERT INTO tbwaempresas VALUES ('$this->idEmpresa', " .
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
                "'$this->Logo'," .
                "'$this->DataInclusao'," .
                "'$this->IdUsuarioInc'," .
                "'$this->DataAtlz'," .
                "'$this->IdUsuarioAtlz')";

        $stmt = $this->conn->prepare($querySql);

        if ($stmt->execute()) {
            $this->retorno = '00';
            return true;
        } else {
            $this->retorno = '02';
            return false;
        }
    }

    public function updateRegistro($Campos, $CpoWhere) {

        $querySql = "UPDATE tbwaempresas " .
                "SET " . $Campos .
                " WHERE " . $CpoWhere;
        $stmt = $this->conn->prepare($querySql);

        if ($stmt->execute()) {
            $this->retorno = '00';
            return true;
        } else {
            $this->retorno = '02';
            return false;
        }
    }

}

?>