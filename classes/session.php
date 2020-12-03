<?php 
session_start();

if ( $_REQUEST['limpa_ss'] == 'apaga' ){
	unset($_SESSION['dados']);
	echo 'ok';
} else{

	$formulario = $_REQUEST['formulario']; 
	unset($_SESSION['dados']);
	 
	$dados = array();
	while(list($key,$val)=each($_REQUEST))
	{
		$dados[$formulario][$key] = $val;
	}
	
	if (is_array($_SESSION['dados']))
	{ 
		$_SESSION['dados'] += $dados;
	}
	else
	{
		$_SESSION['dados'] = $dados;
	}
}
   
?>