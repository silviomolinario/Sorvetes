/* Javascript Assíncrono Crossbrowser */
var AjAxDoc		= null;
var AjAxBrowse	= null;
var AjAxDados	= null;

function instanciaAjax() {
 var xmlajax = ["Microsoft.XMLHTTP", "Msxml2.XMLHTTP", "Msxml2.XMLHTTP.7.0", "Msxml2.XMLHTTP.6.0", "Msxml2.XMLHTTP.4.0", "Msxml2.XMLHTTP.3.0"];
 for (var i = 0; i < xmlajax.length; i++) {
	try {
	    AjAxBrowse = "IE";
		return new ActiveXObject(xmlajax[i]);
	} catch (e){}
 }
 if (navigator.appName == "Microsoft Internet Explorer") {
    AjAxBrowse = "IE";
	return new XMLHttpRequest();
 }
 if (typeof(XMLHttpRequest) != "undefined") {
    AjAxBrowse = "Outros";
	return new XMLHttpRequest();
 }
 alert("Seu navegador não está habilitado para alguns recursos do Sistema");
 return null;
}

function chama_AjAx(metodo, url, flag, nome_ret_fun,json,paramPost) {
 AjAxDoc = instanciaAjax();
 if (AjAxDoc == null) {
	alert("Erro ao instanciar comunicação com o Sistema Contate o administrador do Sistema");
	return false;
 }
 if (AjAxBrowse == "IE") {
	AjAxDoc.onReadyStateChange = function() {
		testa_retorno_Ajax(nome_ret_fun,json);
	};
 } else {
	AjAxDoc.onload = function() {
		testa_retorno_Ajax(nome_ret_fun,json);
	};
 }
 
 AjAxDoc.open(metodo, url, flag);
 if (paramPost!=undefined&&paramPost!='') {
 	AjAxDoc.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	AjAxDoc.setRequestHeader("Content-length", paramPost.length);
	AjAxDoc.setRequestHeader("Connection", "close");
	AjAxDoc.send(paramPost);
 } else {
 	AjAxDoc.send(null);
 }
}

function testa_retorno_Ajax(nome_ret_fun,json) {
 if (AjAxDoc.readyState != 4) return;
 if (AjAxDoc.readyState == 4) {
	if (AjAxDoc.status == 200) {
		if (nome_ret_fun != "") {
			if (json==true) {
				if (AjAxDoc.responseText != '') {
					AjAxDados = eval('(' + AjAxDoc.responseText + ')');
				}
			} else {
				AjAxDados = AjAxDoc.responseXML.getElementsByTagName("dados")[0];
			}
			
			eval("retorno_AjAx_"+ nome_ret_fun +"();");	
		}
	} else {
		devolveMsgErroAjAx(AjAxDoc.status);
	}
 }
}

function devolveMsgErroAjAx(erro) {
 switch(erro) {
	case 0		:
		erro = "Erro indefinido de Javascript";
	break;
	case 400	:
		erro = "Erro 400: Solicita&ccedil;&atilde;o incompreens&iacute;vel";
	break;
	case 403	:
	case 404	:
		erro = "404: A p&aacute;gina solicidata n&atilde;o foi encontrada";
	break;
	case 405	:
		erro = "Erro 405: O servidor n&atilde;o suporta a requisi&ccedil;&atilde;o solicitada";
	break;
	case 500	:
		erro = "Erro 500: Erro desconhecido do servidor";
	break;
	case 503	:
		erro = "Erro 503: Servidor sobrecarregado";
	break;
	default		:
		erro = "Erro "+ erro;
	break;
 }
 if (erro) {
	alert("Falha na comunicação com o Sistema n"+ erro +"\nContate o administrador do Sistema");
	return false;
 } else {
	return true;
 }
}

function tst_elm_ajax(elm, atrib) {
 if (AjAxDados && AjAxDados.getElementsByTagName(elm)[0].childNodes[0]) {
	if (atrib == 1) {
		return AjAxDados.getElementsByTagName(elm)[0].childNodes[0].nodeValue;
	} else {
		return AjAxDados.getElementsByTagName(elm)[0].getAttribute("value");
	}
 }
 return "";
}

function ret_elm_ajax(elm) {
 if (AjAxDados && AjAxDados.getElementsByTagName(elm)) {
	return AjAxDados.getElementsByTagName(elm);
 }
 return null;
}

function trataErroAjax(erros) {
	
	errosArray = [];
	j = 0;
	for (var i in erros) {
		errosArray[j] = erros[i].erro;
		j++;
	}
	return errosArray;
}

function trataParam(parametros) {
	var tmp = parametros.split('&');
	var res = "";
	
	for(i = 0;i<tmp.length;i++) {
		if(tmp[i] != '') {
			var dados = tmp[i].split('=');
			res += "&" + dados[0] +"="+ escape(dados[1]);
		}
	}
	return res;
}

function trataSerialize(campos) {
	var tamCampos = campos.length;
	var res = "";
	for(i = 0;i<tamCampos;i++) {
		cp = gid(campos[i].name);
		if(cp.type == 'checkbox') {
			if (cp.checked) res += "&" + campos[i].name +"=S";
		} else {
			res += "&" + campos[i].name +"="+ escape(cp.value);
		}
	}
	return res;
}
