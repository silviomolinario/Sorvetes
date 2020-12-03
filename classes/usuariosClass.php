<?php

class usuariosClass {

    private $conn;
    private $IdUsuario;
    private $Nome;
    private $Email;
    private $Login;
    private $Password;
    private $Status;
    private $Perfil;
    public $retorno;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function SearchById($CpoKey) {
        $querySql = "SELECT * FROM tbwausuarios " .
                "WHERE " . $CpoKey;
        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->IdUsuario = $row['idusuario'];
            $this->Nome      = $row['nome'];
            $this->Email     = $row['email'];
            $this->Login     = $row['login'];
            $this->Password  = $row['password'];
            $this->Status    = $row['status'];
            $this->Perfil    = $row['perfil'];
            $this->retorno = '00';
        } else {
            $this->retorno = '02';
        }
    }

    public function searchId() {
        $querySql = "SELECT max(idusuario) FROM tbwausuarios ";

        $stmt = $this->conn->prepare($querySql);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->retorno = '00';
            $this->IdUsuario = $row['max(idusuario)'];
        } else {
            $this->retorno = '02';
        }
    }

    public function insertRegistro() {

        $querySql = "INSERT INTO tbwausuarios VALUES ('$this->IdUsuario', " .
                "'$this->Nome', " .
                "'$this->Email'," .
                "'$this->Login'," .
                "'$this->Password'," .
                "'$this->Status',".
                "'$this->Perfil')";
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

        $querySql = "UPDATE tbwausuarios SET " .
                "nome = '" . $this->Nome . "'," .
                "email = '" . $this->Email . "'," .
                "login = '" . $this->Login .  "', " .
                "perfil = '" . $this->Perfil .  "' " .
        " WHERE idusuario = " . $this->IdUsuario;
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
        $querySql = "UPDATE tbwausuarios SET status = '" . $this->Status . "'".
                " WHERE idusuario = " . $this->IdUsuario;
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

    public function getNome() {
        return $this->Nome;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function getLogin() {
        return $this->Login;
    }

    public function getPassword() {
        return $this->Password;
    }

    public function getStatus() {
        return $this->Status;
    }

    public function getPerfil() {
        return $this->Perfil;
    }

    /* ========================================================
     * SETTER
      ======================================================== */
    
    public function setIdUsuario($IdUsuario): void {
        $this->IdUsuario = $IdUsuario;
    }

    public function setNome($Nome): void {
        $this->Nome = $Nome;
    }

    public function setEmail($Email): void {
        $this->Email = $Email;
    }

    public function setLogin($Login): void {
        $this->Login = $Login;
    }

    public function setPassword($Password): void {
        $this->Password = $Password;
    }

    public function setStatus($Status): void {
        $this->Status = $Status;
    }

    public function setPerfil($Perfil): void {
        $this->Perfil = $Perfil;
    }

    
}

?>