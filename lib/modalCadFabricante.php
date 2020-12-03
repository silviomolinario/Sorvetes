<div id="modalCadastro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalCadastro" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-cliente modal-xl"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button> 
                <h4 class="modal-title">Manutenção de Fabricante</h4> 
            </div> 
            <div class="modal-body"> 
                <div class="row">
                    <div class="card-box">
                        <div class="form-horizontal" role="form">                                    

                            <div class="form-group">
                                <div class="col-md-3">
                                    <label>Código</label>
                                    <input type='text' class='form-control text-lowercase' id='IdFabricante' name='IdFabricante' value='' placeholder="" tabindex="1">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <label>Nome Proprietário</label>
                                    <input type='text' class='form-control' id='NomeFabricante' name='NomeFabricante' value='' placeholder="" tabindex="2" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="button" class="btn-lg waves-effect waves-light btn-success"  onClick="javascript:gravarRegistro();"   title="Gravar">
                                <i class="fa fa-save"></i> Gravar 
                            </button>
                            <button type="button" class="btn-lg waves-effect waves-light btn-inverse"  onClick="javascript:inicializaForm();"   title="Limpar">
                                <i class="fa fa-file-o"></i> Limpar
                            </button>
                        </div>
                    </div>

                </div> 
            </div> 

        </div>
    </div>
</div><!-- /.modal -->

