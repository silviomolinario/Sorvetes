function PesquisaCEP(Cep) {
    var dados = 'Cep=' + Cep;

    $.ajax({
        type: 'POST',
        dataType: 'JSON',
        async: false,
        url: 'consultaCep.php',
        data: dados,
        success: function (data) {
            var retorno = data.retorno;
            if (retorno == '00') {
                $('#Endereco').val(data.Endereco);
                $('#Bairro').val(data.Bairro);
                $('#IdMunicipio').val(data.IdMunicipio);
                $('#IdEstado').val(data.IdEstado);
                IdEstado = data.IdEstado;
                IdMunicipio = data.IdMunicipio;
                //$('#IdEstado').load('carregaCombos.php?opcao=UF&IdEstado='+IdEstado );
                $('#IdMunicipio').load('carregaCombos.php?opcao=Municipio&IdEstado='+IdEstado+'&IdMunicipio='+IdMunicipio );
                $('#Endereco').focus();
            } else {
                var msg = data.mensagem;
                alert(msg);
            }
        },
        error: function (data) {
            alert(msg);
        }
    });


}