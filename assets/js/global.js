function carregarComboUF(data) {

    var idx = data.dadosList.length;

    for (i = 0; i < idx; i++) {
        idEstado = data.dadosList[i].idestado;
        UF = data.dadosList[i].uf;
        
        alert(UF);

        if (idEstado) {
            if (idEstado == document.getElementById('idEstado')) {
                $('IdEstado').append(`<option value='${idEstado}' selected>${UF}</option>`);
            } else {
                $('IdEstado').append(`<option value='${idEstado}'>${UF}</option>`);

            }
        }
   }

}