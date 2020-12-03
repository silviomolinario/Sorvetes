<div id="modalCadastro" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalCadastro" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-cliente modal-xl"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button> 
                <h4 class="modal-title">Manutenção de Sorvetes</h4> 
            </div> 
            <div class="modal-body"> 
                <div class="row">
                    <div class="card-box">
                        <div class="form-horizontal" role="form">                                    

                            <div class="form-group">
                                <div class="col-md-7">
                                    <label>Fabricante</label>
                                    <select class="form-control" id="IdFabricante" name="IdFabricante">
                                        <!-- Carregamento Via JQuery -->
                                    </select>
                                </div>
                                <input type="hidden" id="IdSorvete" name="IdSorvete" value=''>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12"> 
                                    <label for="field-3" class="control-label">Sabor</label> 
                                    <input type="text" id="Sabor" name="Sabor" value='' class="form-control" required="" placeholder="" tabindex="2" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-5"> 
                                    <label for="field-3" class="control-label">Quantidade</label> 
                                    <input type="number" id="Quantidade" name="Quantidade" value='' class="form-control" required="" placeholder="" tabindex="3" required>
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

