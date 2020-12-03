function validaCadastroPessoas() {

    if (document.getElementById('Cnpj').value == '') {
        msg = 'Informe o CNPJ!';
        cpoFocus = 'Cnpj';
        retorno = 'F';
        return;
    }
    if (document.getElementById('RazaoSocial').value == '') {
        msg = 'Informe a Razão Social!';
        cpoFocus = 'RazaoSocial';
        retorno = 'F';
        return;
    }
    if (document.getElementById('NomeFantasia').value == '') {
        msg = 'Informe o Nome Fanstasia!';
        cpoFocus = 'NomeFantasia';
        retorno = 'F';
        return;
    }
    if (document.getElementById('Cep').value == '') {
        msg = 'Informe o Cep!';
        cpoFocus = 'Cep';
        retorno = 'F';
        return;
    }
    if (document.getElementById('Endereco').value == '') {
        msg = 'Informe o Endereço!';
        cpoFocus = 'Endereco';
        retorno = 'F';
        return;
    }
    if (document.getElementById('Numero').value == '') {
        msg = 'Informe o Numero do Endereço!';
        cpoFocus = 'Numero';
        retorno = 'F';
        return;
    }
    if (document.getElementById('Bairro').value == '') {
        msg = 'Informe o Bairro!';
        cpoFocus = 'Bairro';
        retorno = 'F';
        return;
    }
    if (document.getElementById('IdEstado').value == '') {
        msg = 'Informe o Estado!';
        cpoFocus = 'IdEstado';
        retorno = 'F';
        return;
    }
    if (document.getElementById('IdMunicipio').value == '') {
        msg = 'Informe o Município!';
        retorno = 'F';
        cpoFocus = 'IdMunicipio';
        return;
    }
    if ((document.getElementById('Fone').value == '') && (document.getElementById('Celular').value == '')) {
        msg = 'Informe um Telefone ou Celular Valído!';
        retorno = 'F';
        cpoFocus = 'Fone';
        return;
    }
    if (document.getElementById('Email').value == '') {
        msg = 'Informe o E-mail!';
        retorno = 'F';
        cpoFocus = 'Email';
        return ;
    }
    cpoFocus = '';
    retorno = 'V';
}