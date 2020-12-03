<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="public/assets/images/favicon_1.ico">
        <title>Cadastro de Fabricante</title>

        <!-- Chamada das Bibliotecas CSS/JS Padrões -->
        <?php include 'lib/library.php'; ?> 


        <script language="javascript1.1">

            function listarRegistros() {

                var dados = 'opcao=listarRegistros';

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    url: 'cadFabricante.php',
                    data: dados,
                    success: function (data) {
                        carregarTabela(data);
                    },
                    error: function (data) {
                        var table = $('#datatable-editable').DataTable();
                        table.clear();
                        table.draw();
                    }
                });
            }

            function carregarTabela(data) {

                var table = $('#mainDataTable').DataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bInfo": false,
                    "filter": true,
                    "destroy": true,
                    "oLanguage": {"sZeroRecords": "Nenhum Registro Encontrado", "sEmptyTable": "Nenhum Registro Encontrado"}
                });
                table.clear();
                table.draw();

                tbId = data.dadosList.IdFabricante;
                var idx = tbId.length;

                for (i = 0; i < idx; i++) {
                    IdFabricante = data.dadosList.IdFabricante[i];
                    NomeFabricante = data.dadosList.NomeFabricante[i];
                    btnEdit = '<a class="btn-mini" href="javascript:editarRegistro(' + "'" + IdFabricante + "'" + ')" title="Editar"><i class="fa fa-lg fa-fw fa-search"></i></a>';
                    btnDel = '<a class="btn-mini" href="javascript:deletarRegistro(' + "'" + IdFabricante + "'" + ')" title="Deletar"><i class="fa fa-lg fa-fw fa-remove"></i></a>';
                    if (IdFabricante) {
                        table.row.add([IdFabricante, NomeFabricante, btnEdit, btnDel]).draw(false);
                    }

                }
                return false;
            }


            function cadastrar() {
                $('#modalCadastro').modal('show');
                inicializaForm();
            }

            function editarRegistro(Id) {

                var dados = 'opcao=lerRegistro&IdFabricante=' + Id;

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    url: 'cadFabricante.php',
                    data: dados,
                    success: function (data) {
                        var retorno = data.retorno;
                        if (retorno == '00') {
                            $('#modalCadastro').modal('show');
                            $('#IdFabricante').val(data.dadosList.idfabricante);
                            $('#NomeFabricante').val(data.dadosList.nomefabricante);
                            $('#IdFabricante').attr('readonly', true);
                            $("#NomeFabricante").focus();
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


            function gravarRegistro() {
                if (document.getElementById('NomeFabricante').value == '') {
                    msg = 'Informe o Nome do Fabricante!';
                    $.Notification.autoHideNotify('warning', 'top center', 'ATENÇÃO', msg);
                    document.getElementById('NomeFabricante').focus();
                    return false;
                }

                document.getElementById('opcao').value = 'gravarRegistro';

                var formulario = document.getElementById('envia');
                var formData = new FormData(formulario);

                $.ajax({
                    url: "cadFabricante.php",
                    type: "POST",
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        var msg = data.mensagem;
                        var retorno = data.retorno;
                        if (retorno == '00') {
                            $.Notification.autoHideNotify('success', 'top center', 'SUCESSO', msg);
                        } else {
                            $.Notification.autoHideNotify('error', 'top center', 'ATENÇÃO', msg);
                        }
                        inicializaForm();
                        $('#modalCadastro').modal('hide');
                        listarRegistros();
                    },
                    error: function (data, status, mensagem) {
                        alert(mensagem);
                    }
                });
                return false;
            }


            function deletarRegistro(Id) {
                var resp = confirm('Deseja Deletar o Fabricante?');

                if (resp == false) {
                    return;
                }
                var dados = 'opcao=deletarRegistro&IdFabricante=' + Id;

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    url: 'cadFabricante.php',
                    data: dados,
                    success: function (data) {
                        var msg = data.mensagem;
                        var retorno = data.retorno;
                        if (retorno == '00') {
                            $.Notification.autoHideNotify('success', 'top center', 'SUCESSO', msg);
                        } else {
                            $.Notification.autoHideNotify('error', 'top center', 'ATENÇÃO', msg);
                        }
                        listarRegistros();
                    },
                    error: function (data) {
                        alert(msg);
                    }
                });
            }

            function inicializaForm() {
                $('#IdFabricante').val('');
                $('#NomeFabricante').val('');
                $('#IdFabricante').attr('readonly', true);
                $('#NomeFabricante').focus();
            }

            function Mensagem() {
                mensagem = document.envia.mensagem.value;
                cpo_focus = document.envia.cpo_focus.value;
                alert(mensagem);
                if (cpo_focus == 'Novo') {
                    document.envia.opcao.value = 'Novo';
                    document.envia.submit();
                } else {
                    document.getElementById(cpo_focus).focus();
                }
            }


        </script>
    </head>
    <body class="widescreen fixed-left-void" onload="listarRegistros()">
        <div id="wrapper" class="enlarged">

            <?php
            include 'lib/header.php';
            include 'lib/carregaMenu.php';
            ?>
            <form name="envia" id="envia" method="post" enctype="multipart/form-data">  
                <input type="hidden" name="opcao"     id="opcao"     value="">

                <div class="content-page">

                    <!-- Start content -->
                    <div class="content">
                        <div class="container">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <h5 class="m-t-0 page-header"><strong>Manutenção de Fabricante</strong></h5>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="m-b-30">
                                                <a class="btn btn-md waves-effect waves-light btn-instagram"  data-toggle="modal" title="Incluir" onclick="javascript:cadastrar()"><i class="fa fa-lg fa-fw fa-plus-square"></i>Cadastrar</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card-box">
                                                <table id="mainDataTable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th width='10%' style='text-align: center'>Id</th>
                                                            <th width='20%' style='text-align: center'>Nome</th>
                                                            <th width='05%' style='text-align: center'>Editar</th>
                                                            <th width='05%' style='text-align: center'>Excluir</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <! -- Listagem por Jquery -->

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <?php
        include 'includes/trailer.php';
        include 'includes/modalLogoff.php';
        include 'lib/modalCadFabricante.php';
        ?>
    </form>
</body>
</html>