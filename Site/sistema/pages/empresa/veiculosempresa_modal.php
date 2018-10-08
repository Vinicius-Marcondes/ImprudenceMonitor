<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog"> 
        <div class="modal-content"> 
            <div class="modal-header"> 
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                <h4 class="modal-title">Adicionar Veiculo</h4> 
            </div> 
			<form method="post" action="processos/adicionar_veiculoempresa.php">
            <div class="modal-body">
				<?php 
					$selecao_equipamento = "SELECT * FROM equipamentos_empresa WHERE EMPRESA_ID_EQUIPAMENTOS = $_SESSION[id]"; 
					$consulta_equipamento = $conexao_bd->query($selecao_equipamento);
					$x = 0;
					while($equipamento = mysqli_fetch_assoc($consulta_equipamento)){ 
                        $id = $equipamento['ID_EQUIPAMENTOS'];
                        $selecao_veiculo = "SELECT * FROM automoveis_empresa WHERE EQUIPAMENTOS_ID_AUTOMOVEIS = $id";
                        $consulta_veiculo = $conexao_bd->query($selecao_veiculo);
						if($consulta_veiculo->num_rows == 0){
							$x = 1;
						}
					}
					if($x == 1){ 
				?>
                <div class="row"> 
                    <div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-1" class="control-label">Identificação Veiculo</label> 
                            <input type="text" class="form-control" id="field-1" placeholder="Ex: BMW C180" name="nome" required> 
                        </div> 
                    </div> 
					<div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-2" class="control-label">Placa</label> 
                            <input type="text" class="form-control" id="field-2" pattern=".{7,7}" title="Necessário 7 caracteres" placeholder="Ex: ABC-1234" name="placa" required> 
                        </div> 
                    </div> 
                </div> 
                <div class="row"> 
					<div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-3" class="control-label">Modelo</label> 
                            <input type="text" class="form-control" id="field-3" placeholder="Ex: C180" name="modelo"> 
                        </div> 
                    </div> 
					<div class="col-md-6"> 
                        <div class="form-group"> 
                            <label for="field-3" class="control-label">Marca</label> 
                            <input type="text" class="form-control" id="field-3" placeholder="Ex: BMW" name="marca"> 
                        </div> 
                    </div>
                </div> 
                <div class="row"> 
					<div class="col-md-3"> 
                        <div class="form-group"> 
                            <label for="field-4" class="control-label">Tipo do Veiculo</label> 
                        </div> 
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group">  
                            <select class="select2" name="tipo">
                                <option value="Carro">Carro</option>
                                <option value="Caminhão">Caminhão</option>
                                <option value="Moto">Moto</option>
							</select> 
                        </div> 
                    </div>
                </div>
				<div class="row"> 
					<div class="col-md-3"> 
                        <div class="form-group"> 
                            <label for="field-4" class="control-label">Equipamento</label> 
                        </div> 
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group">  
                            <select class="select2" name="equipamento" required>
                                <?php 
									$selecao_equipamento2 = "SELECT * FROM equipamentos_empresa WHERE EMPRESA_ID_EQUIPAMENTOS = $_SESSION[id]"; 
									$consulta_equipamento2 = $conexao_bd->query($selecao_equipamento2);
									while($equipamento2 = mysqli_fetch_assoc($consulta_equipamento2)){ 
									   $id2 = $equipamento2['ID_EQUIPAMENTOS'];
									   $selecao_veiculo2 = "SELECT * FROM automoveis_empresa WHERE EQUIPAMENTOS_ID_AUTOMOVEIS = $id2";
									   $consulta_veiculo2 = $conexao_bd->query($selecao_veiculo2);
									   if($consulta_veiculo2->num_rows == 0){
								?>
									<option value="<?php echo $equipamento2['ID_EQUIPAMENTOS']; ?>"><?php echo $equipamento2['NOME_EQUIPAMENTOS']; ?></option>
								<?php }} ?>
							</select> 
                        </div> 
                    </div>
                </div> 
                <div class="row"> 
                    <div class="col-md-3"> 
                        <div class="form-group"> 
                            <label for="field-4" class="control-label">Funcionário</label> 
                        </div> 
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group">  
                            <select class="select2" name="id" required>
                                <?php 
                                    $selecao_pessoa = "SELECT * FROM pessoas WHERE EMPRESA_ID_PESSOAS = $_SESSION[id]"; 
                                    $consulta_pessoa = $conexao_bd->query($selecao_pessoa);
                                    while($pessoa = mysqli_fetch_assoc($consulta_pessoa)){ 
                                ?>
                                    <option value="<?php echo $pessoa['ID_PESSOAS']; ?>"><?php echo $pessoa['NOME_PESSOAS']; ?></option>
                                <?php } ?>
                            </select> 
                        </div> 
                    </div>
                </div>
            </div> 
			<div class="modal-footer"> 
				<button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Voltar</button> 
				<button type="submit" class="btn btn-info waves-effect waves-light">Adicionar</button> 
			</div> 
			</form>
			<?php } else { echo "Você não possue nenhum equipamento a disposição, crie um equipamento para a liberação do processo de criação do veiculo."; } ?>
		</div> 
	</div>
</div><!-- /.modal -->