<?php

session_start();

try {
    require_once  'lib/autentica.php';

    require_once 'classes/fabricanteClass.php';
    require_once 'classes/consultaClass.php';


    $fabricanteClass = new fabricanteClass($db);
    $consultaClass = new ConsultaClass($db);
    $WaController = new WaController();


    $opcao = $_REQUEST['opcao'];
    $WaController->IdFabricante = $_REQUEST['IdFabricante'];
    $WaController->NomeFabricante = $_REQUEST['NomeFabricante'];


    switch ($opcao) {
        case "listarRegistros":
            $WaController->ListarRegistro();
            break;

        case "gravarRegistro":
            $WaController->GravarRegistro();
            break;

        case "lerRegistro":
            $WaController->LerRegistro();
            break;

        case 'deletarRegistro':
            $WaController->DeletarRegistro();
            break;

        default:
            include 'views/cadFabricanteHtml.php';
            break;
    }

    exit;
} catch (Exception $e) {

    $erroServico = $e->getMessage();
}

/* ---------------------------------------------------------------------------- */
/* CLASSE CONTROLLER                                                            */
/* ---------------------------------------------------------------------------- */

class WaController {

    public $IdFabricante;
    public $NomeFabricante;
    public $Campos;

    public function LerRegistro() {
        global $fabricanteClass;

        $CpoKey = 'idfabricante = ' . $this->IdFabricante;
        $fabricanteClass->SearchById($CpoKey);

        if ($fabricanteClass->retorno == '00') {
            $dadosList['idfabricante'] = $fabricanteClass->getIdFabricante();
            $dadosList['nomefabricante'] = $fabricanteClass->getNomeFabricante();
            $mensagem = '';
        } else {
            $mensagem = 'Registro não Localizado!!!';
        }

        echo json_encode(Array('retorno' => $fabricanteClass->retorno,
            'mensagem' => $mensagem,
            'dadosList' => $dadosList));
    }

    public function ListarRegistro() {
        global $consultaClass;
        
        $table = "tbfabricante";
        $cpoSelect = " * ";
        $cpoOrderBy = "";

        $stmt = $consultaClass->consultar($table, $join, $cpoSelect, $cpoKey, $cpoGroupBy, $cpoOrderBy);
        $num = $stmt->rowCount();
        $ind = 0;

        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $dadosList['IdFabricante'][$ind] = $rows['idfabricante'];
            $dadosList['NomeFabricante'][$ind] = $rows['nomefabricante'];
            $ind++;
        }

        $retorno = '00';
        echo json_encode(Array('retorno' => $retorno,
            'dadosList' => $dadosList));
    }

    public function GravarRegistro() {
        global $fabricanteClass;

        $Id = $this->IdFabricante;
        if ($Id == '') {
            $fabricanteClass->searchId();
            if ($fabricanteClass->retorno == '00') {
                $Id = $fabricanteClass->getIdFabricante();
            }
            $Id++;
            $this->IdFabricante = $Id;
            $operacao = 'insertRegistro';
        } else {
            $CpoKey = "idfabricante = '" . $this->IdFabricante . "'";
            $fabricanteClass->SearchById($CpoKey);
            if ($fabricanteClass->retorno == '00') {
                $operacao = 'updateRegistro';
            } else {
                $operacao = 'insertRegistro';
            }
        }

        $fabricanteClass->setIdFabricante($this->IdFabricante);
        $fabricanteClass->setNomeFabricante($this->NomeFabricante);

        if ($operacao == 'insertRegistro') {
            $fabricanteClass->insertRegistro();
            $mensagem = '';
            $retorno = $fabricanteClass->retorno;
            if ($fabricanteClass->retorno != '00') {
                $mensagem = '<strong>Erro na inclusão do Registro!!!</strong>';
            } else {
                $mensagem = '<strong>INCLUSÃO EFETUADA COM SUCESSO!!!</strong>';
            }
        }
        if ($operacao == 'updateRegistro') {
            $fabricanteClass->updateRegistro();
            $mensagem = '';
            $retorno = $fabricanteClass->retorno;
            if ($fabricanteClass->retorno != '00') {
                $mensagem = '<strong>Erro na atualização do Registro!</strong>';
            } else {
                $mensagem = '<strong>REGISTRO ATUALIZADO COM SUCESSO!</strong>';
            }
        }

        echo json_encode(Array('retorno' => $retorno,
            'mensagem' => $mensagem));
    }

    public function DeletarRegistro() {
        global $fabricanteClass;

        $CpoKey = "idfabricante = '" . $this->IdFabricante . "'";
        $fabricanteClass->SearchById($CpoKey);
        if ($fabricanteClass->retorno == '00') {
            $fabricanteClass->setIdFabricante($this->IdFabricante);
            $fabricanteClass->deletarRegistro();
            if ($fabricanteClass->retorno == '00') {
                $mensagem = 'Registro Excluido com sucesso!';
            } else {
                $mensagem = 'Erro Excluindo Registro!';
            }
        } else {
            $mensagem = 'Registro não localizado!';
        }


        echo json_encode(Array('retorno' => $fabricanteClass->retorno,
            'mensagem' => $mensagem));
    }

}

?>