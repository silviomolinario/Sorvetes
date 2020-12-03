<?php session_start(); ?>

<?php

/*--------------------------------------------------------------------------/*
 *  AREA DE AUTENTICAÇÃO DO SISTEMA
 */

    date_default_timezone_set("America/Sao_Paulo");
    setlocale(LC_ALL, 'pt_BR');
    
    include_once 'classes/conexao.class.php';

    $database = new Database();

    $db       = $database->getConnection(); 
    $db->exec("set names utf8");

    $nomeSistema = 'AmbPlan';
