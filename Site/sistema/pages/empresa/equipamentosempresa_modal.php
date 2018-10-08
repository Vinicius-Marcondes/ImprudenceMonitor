<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Adicionar Equipamento</h4> 
            </div> 
			<form method="post" action="processos/adicionar_equipamentoempresa.php">
            <div class="modal-body">
                <div class="row"> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-1" class="control-label">Identificação Equipamento</label> 
                            <input type="text" class="form-control" id="field-1" placeholder="Ex: XT01" name="nome" required> 
                        </div> 
                    </div> 
					<div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-2" class="control-label">Modelo</label> 
                            <input type="text" class="form-control" id="field-2" placeholder="Ex: v1.0" name="modelo"> 
                        </div> 
                    </div> 
                </div> 
                <div class="row"> 
					<div class="col-md-12"> 
                        <div class="form-group"> 
                            <label for="field-3" class="control-label">Serial</label> 
                            <input type="text" class="form-control" id="field-3" placeholder="Ex: 999999999" pattern=".{9,9}" title="Necessário 9 digitos" name="serial" required> 
                        </div> 
                    </div> 
                </div> 
            </div> 
			<div class="modal-footer"> 
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Voltar</button> 
				<button type="submit" class="btn btn-info waves-effect waves-light">Adicionar</button> 
			</div> 
			</form>
		</div> 
	</div>
</div><!-- /.modal -->