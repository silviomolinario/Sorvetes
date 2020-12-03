<?php
header('Content-Type: text/html; charset=utf-8');

    $server = $_SERVER['HTTP_HOST'];
        
    if ($server == 'localhost'){
        $conec = mysql_connect("localhost","root","");
    }else{
		$conec = mysql_connect("storeplus.mysql.dbaas.com.br","storeplus","Nath0406");
    }

    if ($conec) {
        $bco = mysql_select_db("storeplus", $conec);
        if ($bco){
            $conectou = 1;	
            mysql_query("SET NAMES 'utf8'");
            mysql_query('SET character_set_connection=utf8');
            mysql_query('SET character_set_client=utf8');
            mysql_query('SET character_set_results=utf8');
        }else{
           echo "Banco de Dados não Encontrado!!!";
        }
    }  
     
?>