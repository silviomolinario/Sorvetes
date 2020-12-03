function formatar(cpo, mask) {
 var i     = cpo.value.length;
 var saida = mask.substring(0,1);
 var texto = mask.substring(i)
 if (texto.substring(0,1) != saida) {
    cpo.value += texto.substring(0,1);
    }
}
//---------------------------------------------------------------------------------------------    
function Formata_vlr(fld, milSep, decSep, e) {
if (fld.id == "vlrreais")
   if (flag == 1) return false;
 var sep = 0;
 var key = '';
 var i = j = 0;
 var len = len2 = 0;
 var strCheck = '0123456789';
 var aux = aux2 = '';
 var whichCode = (window.Event) ? e.which : e.keyCode;
 if (whichCode == 13)
 return true;
 key = String.fromCharCode(whichCode);
 if (strCheck.indexOf(key) == -1) return false;
 len = fld.value.length;
 for(i = 0; i < len; i++)
 if ((fld.value.charAt(i) != '0') && (fld.value.charAt(i) != decSep)) break;
 aux = '';
 for(; i < len; i++)
 if (strCheck.indexOf(fld.value.charAt(i))!= -1) aux += fld.value.charAt(i);
 aux += key;
 len = aux.length;
 if (len == 0) fld.value = '';
 if (len == 1) fld.value = '0' + decSep + '0' + aux;
 if (len == 2) fld.value = '0' + decSep + '0' + aux;
 // Se 3 for 3 coloca essa linha sen�o n�o coloca
 if (len == 2) fld.value = '0' + decSep + aux + aux2;
 if (len > 2) {
  aux2 = '';

  // A cada tr�s caracteres adiciona um milSep (ponto)
  for (j = 3, i = len - 3; i >= 0; i--) {
   if (j == 3) {
    aux2 += milSep;
    j = 0;
   }
   aux2 += aux.charAt(i);
   j++;
  }
  fld.value = '';
  len2 = aux2.length;

  // Se 3 for 3 coloca > sen�o coloca >=
  for (i = len2 - 1; i > 0; i--) // Alterei de i >= 0 para i > 0
  fld.value += aux2.charAt(i);
  fld.value += decSep + aux.substr(len - 2, len); // N�mero de casas ap�s a v�rgula
 }
 return false;
}
//---------------------------------------------------------------------------------------------    
function Tecla(e) {
  tecla = event.keyCode;
  if (tecla == 13){
     return true;
  }
  if ((tecla != 48)  && (tecla != 49) && 
      (tecla != 50)  && (tecla != 51) && 
	  (tecla != 52)  && (tecla != 53) && 
	  (tecla != 54)  && (tecla != 55) && 
	  (tecla != 56)  && (tecla != 57) && 
	  (tecla != 96)  && (tecla != 97) && 
      (tecla != 98)  && (tecla != 99) && 
	  (tecla != 100) && (tecla != 101) && 
	  (tecla != 102) && (tecla != 103) && 
	  (tecla != 104) && (tecla != 105)){
     return true;
  }else{
    return false;
  }
} 
//---------------------------------------------------------------------------------------------    
  function Logoff(){
      var urlx = 'logoff.php';
      location = urlx;
  }
