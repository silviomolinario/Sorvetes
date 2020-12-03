<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel="shortcut icon" href="public/assets/images/favicon_1.ico">
        <title><?php echo $tituloPrograma ?></title>

        <!-- Chamada das Bibliotecas CSS/JS Padrões -->
        <?php include 'lib/library.php'; ?> 


        <script language="javascript1.1">

            function listarRegistros() {

                var dados = 'opcao=listarRegistros';

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    url: 'cadSorvetes.php',
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
                    "order": [[ 0, 'asc'],[ 1, 'asc']],        
                    "oLanguage": {"sZeroRecords": "Nenhum Registro Encontrado", "sEmptyTable": "Nenhum Registro Encontrado"}
                });
                table.clear();
                table.draw();

                tbId = data.dadosList.IdSorvete;
                var idx = tbId.length;

                for (i = 0; i < idx; i++) {
                    NomeFabricante   = data.dadosList.NomeFabricante[i];
                    idSorvete = data.dadosList.IdSorvete[i];
                    Sabor = data.dadosList.Sabor[i];
                    Quantidade = data.dadosList.Quantidade[i];
                    btnEdit = '<a class="btn-mini" href="javascript:editarRegistro(' + "'" + idSorvete + "'" + ')" title="Editar"><i class="fa fa-lg fa-fw fa-search"></i></a>';
                    btnDel = '<a class="btn-mini" href="javascript:deletarRegistro(' + "'" + idSorvete + "'" + ')" title="Deletar"><i class="fa fa-lg fa-fw fa-remove"></i></a>';
                    if (idSorvete) {
                        table.row.add([NomeFabricante, idSorvete, Sabor, Quantidade, btnEdit, btnDel]).draw(false);
                    }

                }
                return false;
            }


            function cadastrar() {
                inicializaForm();
                $('#modalCadastro').modal('show');
            }

            function editarRegistro(Id) {

                var dados = 'opcao=lerRegistro&IdSorvete=' + Id;

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    url: 'cadSorvetes.php',
                    data: dados,
                    success: function (data) {
                        var retorno = data.retorno;
                        if (retorno == '00') {
                            IdFabricante = data.dadosList.idfabricante;                            
                            $('#IdFabricante').load('carregaCombos.php?opcao=Fabricante&IdFabricante='+ IdFabricante );
                            $('#idSorvete').val(data.dadosList.idsorvete);
                            $('#Sabor').val(data.dadosList.sabor);
                            $('#Quantidade').val(data.dadosList.quantidade);
                            $('#modalCadastro').modal('show');
                            $('#Sabor').focus();
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
                if (document.getElementById('IdFabricante').value == '') {
                    msg = 'Selecione um Fabricante!';
                    $.Notification.autoHideNotify('warning', 'top center', 'ATENÇÃO', msg);
                    document.getElementById('IdFabricante').focus();
                    return false;
                }
                if (document.getElementById('Sabor').value == '') {
                    msg = 'Informe o Sabor!';
                    $.Notification.autoHideNotify('warning', 'top center', 'ATENÇÃO', msg);
                    document.getElementById('Sabor').focus();
                    return false;
                }
                if (document.getElementById('Quantidade').value == '') {
                    msg = 'Informe a Quantidades!';
                    $.Notification.autoHideNotify('warning', 'top center', 'ATENÇÃO', msg);
                    document.getElementById('Quantidade').focus();
                    return false;
                }
                document.getElementById('opcao').value = 'gravarRegistro';

                var formulario = document.getElementById('envia');
                var formData = new FormData(formulario);

                $.ajax({
                    url: "cadSorvetes.php",
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
                var resp = confirm('Deseja Deletar o Sorvete?');

                if (resp == false) {
                    return;
                }
                var dados = 'opcao=deletarRegistro&IdSorvete=' + Id;

                $.ajax({
                    type: 'POST',
                    dataType: 'JSON',
                    async: false,
                    url: 'cadSorvetes.php',
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
                $('#IdFabricante').load('carregaCombos.php?opcao=Fabricante');

                $('#IdFabricante').val('');
                $('#idSorvete').val('');
                $('#Sabor').val('');
                $('#Quantidade').val('');
                $('#Sabor').focus();
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
                                    <h5 class="m-t-0 page-header"><strong>Manutenção de Sorvetes</strong></h5>
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
                                                            <th width='10%' style='text-align: center'>Fabricante</th>
                                                            <th width='10%' style='text-align: center'>Id</th>
                                                            <th width='20%' style='text-align: center'>Sabor</th>
                                                            <th width='10%' style='text-align: center'>Quantidade</th>
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
        include 'lib/modalCadSorvetes.php';
        ?>
    </form>
</body>
</html>