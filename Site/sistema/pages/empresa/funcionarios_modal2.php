<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Vincular Funcionário</h4> 
            </div> 
			<form method="post" action="processos/notificacao.php">
            <div class="modal-body">
                <div class="row"> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-1" class="control-label">Número de Identificação</label> 
                            <input type="text" class="form-control" id="field-1" placeholder="Ex: 1000" name="id" required> 
                        </div> 
                    </div> 
                </div> 
            </div> 
			<div class="modal-footer"> 
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Voltar</button> 
				<button type="submit" class="btn btn-info waves-effect waves-light">Vincular</button> 
			</div> 
			</form>
		</div> 
	</div>
</div><!-- /.modal -->