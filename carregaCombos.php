<?php

session_start();

try {
    include_once 'lib/autentica.php';
    include_once 'classes/consultaClass.php';

    $consultaClass = new ConsultaClass($db);
    $carregaCombos = new carregaCombos();


    $opcao = $_REQUEST['opcao'];
    $carregaCombos->IdFabricante  = $_REQUEST['IdFabricante'];

    switch ($opcao) {
        case "Fabricante":
            $carregaCombos->CarregarComboFabricante();
            break;
    }
    exit;
} catch (Exception $e) {

    $erroServico = $e->getMessage();
}

/* ---------------------------------------------------------------------------- */
/* CLASSE CONTROLLER                                                            */
/* ---------------------------------------------------------------------------- */

class carregaCombos {
    public $IdFabricante;

    public function CarregarComboFabricante() {
        global $consultaClass;

        $table = "tbfabricante";
        $cpoSelect = " idfabricante, nomefabricante ";
        $cpoOrderBy = ' idfabricante ';

        $stmt = $consultaClass->consultar($table, $join, $cpoSelect, $cpoKey, $cpoGroupBy, $cpoOrderBy);
        $num = $stmt->rowCount();
        $i = 0;

        $selected = '';
        if ($this->IdFabricante == ''){
            $selected = 'selected';
        }    
        echo "<option value=''". $selected .">Selecione um Fabricante</option>";

        
        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $IdFabricante = $rows['idfabricante'];
            $NomeFabricante = $rows['nomefabricante'];
            $selected = '';
            if ($IdFabricante == $this->IdFabricante){
                $selected = 'selected';
            }
            echo "<option value='" . $IdFabricante . "'".  $selected .">" . $NomeFabricante . "</option>";
        }
    }
}

?>