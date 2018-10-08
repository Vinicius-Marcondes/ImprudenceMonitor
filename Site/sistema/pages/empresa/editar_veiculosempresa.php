<!DOCTYPE html>
<html>
    <head>
		<?php session_start(); include_once('includes/header.php'); ?>
        <title>MDI - VEÍCULOS</title> 
    </head>
    <body class="fixed-left">
        <div id="wrapper">
			<?php include_once('includes/menu.php'); ?>             
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Veículos</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="index.php">MDI</a></li>
                                    <li><a class="active">Empresa</a></li>
                                    <li>Veículos</li>
                                </ol>
                            </div>
                        </div>
						<div class="panel panel-border panel-primary">
							<?php 
								$id = $_GET['id'];
								$selecao_veiculo = "SELECT * FROM automoveis_empresa WHERE ID_AUTOMOVEIS = $id AND EMPRESA_ID_AUTOMOVEIS = $_SESSION[empresa]";
								$consulta_veiculo = $conexao_bd->query($selecao_veiculo);
								$veiculo = mysqli_fetch_assoc($consulta_veiculo);
							?>
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Configurações do veículo <?php if(!empty($veiculo['NOME_AUTOMOVEIS'])){ echo "'".$veiculo['NOME_AUTOMOVEIS']."'"; } ?></h3> 
                            </div> 
                            <div class="panel-body"> 
								<?php if(isset($_SESSION['msg_edit_veiculos'])){ echo $_SESSION['msg_edit_veiculos']; unset($_SESSION['msg_edit_veiculos']); } if($veiculo['EMPRESA_ID_AUTOMOVEIS'] == $_SESSION['empresa']){ ?>
                                <form role="form" method="post" action="processos/editar_veiculoempresa.php">
                                    <div class="form-group">
                                        <label for="Nome">Nome</label>
                                        <input type="text" value="<?php echo $veiculo['NOME_AUTOMOVEIS']; ?>" id="Nome" name="nome" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="modelo">Modelo</label>
                                        <input type="text" value="<?php echo $veiculo['MODELO_AUTOMOVEIS']; ?>" id="modelo" name="modelo" class="form-control">
                                    </div>
									<div class="form-group">
                                        <label for="marca">Marca</label>
                                        <input type="text" value="<?php echo $veiculo['MARCA_AUTOMOVEIS']; ?>" id="marca" name="marca" class="form-control">
                                    </div>
									<div class="form-group">
                                        <label for="placa">Placa</label>
                                        <input type="text" value="<?php echo $veiculo['PLACA_AUTOMOVEIS']; ?>" id="placa" name="placa" class="form-control" pattern=".{7,7}" title="Necessário 7 caracteres" required>
                                    </div>
									<div class="form-group"> 
										<label for="field-4" class="control-label">Tipo do Veiculo</label> 
										<select class="select2" name="tipo" id="field-4">
											<?php if($veiculo['TIPO_AUTOMOVEIS'] == "Carro"){ echo "<option value='Carro'>Carro</option><option value='Caminhão'>Caminhão</option><option value='Moto'>Moto</option>"; } else if($veiculo['TIPO_AUTOMOVEIS'] == "Caminhão"){ echo "<option value='Caminhão'>Caminhão</option><option value='Carro'>Carro</option><option value='Moto'>Moto</option>"; } else if($veiculo['TIPO_AUTOMOVEIS'] == "Moto"){ echo "<option value='Moto'>Moto</option><option value='Carro'>Carro</option><option value='Caminhão'>Caminhão</option>"; } ?>
										</select> 
									</div> 
									<div class="form-group">  
										<label for="field-5" class="control-label">Equipamento</label> 
										<select class="select2" name="equipamento" id="field-5" required>
											<?php 
												$id_equip = $veiculo['EQUIPAMENTOS_ID_AUTOMOVEIS'];
												$selecao_equipamento1 = "SELECT * FROM equipamentos_empresa WHERE EMPRESA_ID_EQUIPAMENTOS = $_SESSION[empresa] AND ID_EQUIPAMENTOS = $id_equip"; 
												$consulta_equipamento1 = $conexao_bd->query($selecao_equipamento1);
												$equipamento1 = mysqli_fetch_assoc($consulta_equipamento1);
											?>
											<option value="<?php echo $equipamento1['ID_EQUIPAMENTOS']; ?>"><?php echo $equipamento1['NOME_EQUIPAMENTOS']; ?></option>
											<?php 
												$selecao_equipamento2 = "SELECT * FROM equipamentos_empresa WHERE EMPRESA_ID_EQUIPAMENTOS = $_SESSION[empresa]"; 
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
									<div class="form-group">  
										<label for="field-5" class="control-label">Funcionário</label> 
										<select class="select2" name="pessoa" required>
											<?php 
			                                    $selecao_pessoa = "SELECT * FROM pessoas WHERE EMPRESA_ID_PESSOAS = $_SESSION[empresa] AND ID_PESSOAS = $veiculo[PESSOAS_ID_AUTOMOVEIS]"; 
			                                    $consulta_pessoa = $conexao_bd->query($selecao_pessoa);
			                                    $pessoa = mysqli_fetch_assoc($consulta_pessoa); 
			                                ?>
			                               		<option value="<?php echo $pessoa['ID_PESSOAS']; ?>"><?php echo $pessoa['NOME_PESSOAS']; ?></option>
			                                <?php 
			                                    $selecao_pessoa2 = "SELECT * FROM pessoas WHERE EMPRESA_ID_PESSOAS = $_SESSION[empresa] AND ID_PESSOAS != $veiculo[PESSOAS_ID_AUTOMOVEIS]"; 
			                                    $consulta_pessoa2 = $conexao_bd->query($selecao_pessoa2);
			                                    while($pessoa2 = mysqli_fetch_assoc($consulta_pessoa2)){ 
			                                ?>
                                    		<option value="<?php echo $pessoa2['ID_PESSOAS']; ?>"><?php echo $pessoa2['NOME_PESSOAS']; ?></option>
                               				<?php } ?>
                           				</select> 
									</div>
									<div class="row">
										<div class="col-lg-11 col-md-9 col-sm-9 col-xs-5"><a href="veiculosempresa.php">Voltar</a></div>
										<div class="col-lg-1 col-md-3 col-sm-3 col-xs-7"><button class="btn btn-primary waves-effect waves-light w-md" type="submit" name="btn" value="<?php echo $id; ?>">Salvar</button></div>
									</div>
                                </form>
							</div>
							<?php } else { echo "Acesso Restrito. <a href='veiculosempresa.php'>Voltar</a>"; } ?>
						</div> 
					</div>
                </div> 
            </div>
        </div>
		<?php include_once('includes/scripts_ok.php'); ?>
	</body>
</html>
