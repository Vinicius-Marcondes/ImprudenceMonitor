<div id="adicionar_funcionario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Adicionar Funcionário</h4> 
            </div> 
			<form method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row"> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-1" class="control-label">Nome do funcionário</label> 
                            <input type="text" class="form-control" id="field-1" placeholder="Ex: Ricardo" name="nome" required> 
                        </div> 
                    </div> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-2" class="control-label">Email</label> 
                            <input type="email" class="form-control" id="field-2" placeholder="Ex: ricardo@email.com" name="email" required> 
                        </div> 
                    </div> 
                </div>
                <div class="row"> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-3" class="control-label">Senha</label> 
                            <input type="password" class="form-control" id="field-3" pattern=".{6,12}" title="Necessário 6 até 12 caracteres" placeholder="******" name="senha" required> 
                        </div> 
                    </div> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-4" class="control-label">CPF</label> 
                            <input type="text" class="form-control" id="field-4" pattern=".{11,11}" title="Necessário 11 digitos" placeholder="Ex: 00000000000" name="cpf" required> 
                        </div> 
                    </div>
                </div>  
                <div class="row"> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-5" class="control-label">RG</label> 
                            <input type="text" class="form-control" id="field-5" pattern=".{9,9}" title="Necessário 9 digitos" placeholder="Ex: 990009000" name="rg" required> 
                        </div> 
                    </div> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-6" class="control-label">Telefone</label> 
                            <input type="text" class="form-control" id="field-6" pattern=".{10,11}" title="Necessário 10 até 11 digitos" placeholder="Ex: 41990009000" name="telefone" required> 
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group"> 
                            <label for="field-7" class="control-label">Celular</label> 
                            <input type="text" class="form-control" id="field-7" pattern=".{10,11}" title="Necessário 10 até 11 digitos" placeholder="Ex: 41990009000" name="celular" required> 
                        </div> 
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-8" class="control-label">CEP</label> 
                            <input type="text" class="form-control" id="field-8" pattern=".{8,8}" title="Necessário 8 digitos" placeholder="Ex: 00000000" name="cep" required> 
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Sexo</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="sexo">
                                    <option value="Masculino">Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="form-group">
                        <div class="fileUpload btn btn-warning waves-effect waves-light">
                            <span><i class="ion-upload m-r-5"></i>Upload</span>
                            <input type="file" class="upload" name="arquivo" required>
                        </div>    
                    </div>
                </div>
            </div> 
			<div class="modal-footer"> 
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Voltar</button> 
				<button name="teste" type="submit" class="btn btn-info waves-effect waves-light">Adicionar</button> 
			</div> 
			</form>
		</div> 
	</div>
</div><!-- /.modal -->