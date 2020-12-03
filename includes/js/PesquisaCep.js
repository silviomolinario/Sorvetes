        <!-- PESQUISA CEP -->
        <script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#Endereco").val("");
                $("#Bairro").val("");
                $("#Cidade").val("");
                $("#Estado").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cepCliente").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#Endereco").val("...")
                        $("#Bairro").val("...")
                        $("#Cidade").val("...")
                        $("#Estado").val("...")

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#Endereco").val(dados.logradouro);
                                $("#Bairro").val(dados.bairro);
                                $("#Cidade").val(dados.localidade);
                                $("#Estado").val(dados.uf);
                                $("#IdMunicipio").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                var msg = 'CEP NÃO ENCONTRADO';
                                $.Notification.autoHideNotify('warning','top center', 'ATENÇÃO', msg);
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        var msg = 'CEP NÃO ENCONTRADO';
                        $.Notification.autoHideNotify('warning','top center', 'ATENÇÃO', msg);
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
