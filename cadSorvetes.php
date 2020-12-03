<?php

session_start();

try {
    include_once 'lib/autentica.php';

    include_once 'classes/fabricanteClass.php';
    include_once 'classes/sorvetesClass.php';
    include_once 'classes/consultaClass.php';

    $fabricanteClass = new fabricanteClass($db);
    $sorvetesClass = new sorvetesClass($db);
    $consultaClass = new ConsultaClass($db);
    $WaController = new WaController();


    $opcao = $_REQUEST['opcao'];
    $WaController->IdFabricante = $_REQUEST['IdFabricante'];
    $WaController->IdSorvete    = $_REQUEST['IdSorvete'];
    $WaController->Sabor  = $_REQUEST['Sabor'];
    $WaController->Quantidade  = $_REQUEST['Quantidade'];


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
            include 'views/cadSorvetesHtml.php';
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
    public $IdSorvete;
    public $Sabor;
    public $Quantidade;

    public function LerRegistro() {
        global $sorvetesClass;

        $CpoKey = 'idsorvete = ' . $this->IdSorvete;
        $sorvetesClass->SearchById($CpoKey);

        if ($sorvetesClass->retorno == '00') {
            $dadosList['idsorvete'] = $sorvetesClass->getIdSorvete();
            $dadosList['idfabricante'] = $sorvetesClass->getIdFabricante();
            $dadosList['sabor'] = $sorvetesClass->getSabor();
            $dadosList['quantidade'] = $sorvetesClass->getQuantidade();
            $mensagem = '';
        } else {
            $mensagem = 'Registro não Localizado!!!';
        }

        echo json_encode(Array('retorno' => $sorvetesClass->retorno,
            'mensagem' => $mensagem,
            'dadosList' => $dadosList));
    }

    public function ListarRegistro() {
        global $consultaClass;

        $table = " tbsorvetes as t1";
        $join  = " tbfabricante as t2 ".
                 "on t2.idfabricante = t1.idfabricante ";
        $cpoSelect = " t1.idsorvete, t1.sabor, t2.idfabricante, t2.nomefabricante, t1.quantidade ";
        $cpoOrderBy = "t1.idfabricante";

        $stmt = $consultaClass->consultar($table, $join, $cpoSelect, $cpoKey, $cpoGroupBy, $cpoOrderBy);
        $num = $stmt->rowCount();
        $ind = 0;

        while ($rows = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($rows);
            $IdFabricante = $rows['idfabricante'];
            $NomeFabricante = $rows['nomefabricante'];
            $dadosList['NomeFabricante'][$ind] = $IdFabricante .' - '. $NomeFabricante;
            $dadosList['IdSorvete'][$ind] = $rows['idsorvete'];
            $dadosList['Sabor'][$ind] = $rows['sabor'];
            $dadosList['Quantidade'][$ind] = $rows['quantidade'];
            $ind++;
        }

        $retorno = '00';
        echo json_encode(Array('retorno' => $retorno,
            'dadosList' => $dadosList));
    }

    public function GravarRegistro() {
        global $sorvetesClass;

        $Id = $this->IdSorvete;
        if ($Id == '') {
            $sorvetesClass->searchId();
            if ($sorvetesClass->retorno == '00') {
                $Id = $sorvetesClass->getIdSorvete();
            }
            $Id++;
            $this->IdSorvete = $Id;
            $operacao = 'insertRegistro';
        } else {
            $CpoKey = "idsorvete = '" . $this->IdSorvete . "'";
            $sorvetesClass->SearchById($CpoKey);
            if ($sorvetesClass->retorno == '00') {
                $operacao = 'updateRegistro';
            } else {
                $operacao = 'insertRegistro';
            }
        }

        $sorvetesClass->setIdFabricante($this->IdFabricante);
        $sorvetesClass->setIdSorvete($this->IdSorvete);
        $sorvetesClass->setSabor($this->Sabor);
        $sorvetesClass->setQuantidade($this->Quantidade);

        if ($operacao == 'insertRegistro') {
            $sorvetesClass->insertRegistro();
            $mensagem = '';
            $retorno = $sorvetesClass->retorno;
            if ($sorvetesClass->retorno != '00') {
                $mensagem = '<strong>Erro na inclusão do Registro!!!</strong>';
            } else {
                $mensagem = '<strong>INCLUSÃO EFETUADA COM SUCESSO!!!</strong>';
            }
        }
        if ($operacao == 'updateRegistro') {
            $sorvetesClass->updateRegistro();
            $mensagem = '';
            $retorno = $sorvetesClass->retorno;
            if ($sorvetesClass->retorno != '00') {
                $mensagem = '<strong>Erro na atualização do Registro!</strong>';
            } else {
                $mensagem = '<strong>REGISTRO ATUALIZADO COM SUCESSO!</strong>';
            }
        }

        echo json_encode(Array('retorno' => $retorno,
            'mensagem' => $mensagem));
    }

    public function DeletarRegistro() {
        global $sorvetesClass;

        $CpoKey = "idsorvete = '" . $this->IdSorvete . "'";
        $sorvetesClass->SearchById($CpoKey);
        if ($sorvetesClass->retorno == '00') {
            $sorvetesClass->setIdSorvete($this->IdSorvete);
            $sorvetesClass->deletarRegistro();
            if ($sorvetesClass->retorno == '00') {
                $mensagem = 'Registro Excluido com sucesso!';
            } else {
                $mensagem = 'Erro Excluindo Registro!';
            }
        } else {
            $mensagem = 'Registro não localizado!';
        }


        echo json_encode(Array('retorno' => $sorvetesClass->retorno,
            'mensagem' => $mensagem));
    }

}

?>