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
								$id_equipamento = $veiculo['EQUIPAMENTOS_ID_AUTOMOVEIS'];
								if(!empty($id_equipamento)){
									$selecao_equipamento = "SELECT * FROM equipamentos_empresa WHERE ID_EQUIPAMENTOS = $id_equipamento";
									$consulta_equipamento = $conexao_bd->query($selecao_equipamento);
									if($equipamento = mysqli_fetch_assoc($consulta_equipamento)){
										$nome_equipamento = $equipamento['NOME_EQUIPAMENTOS'];
									} else {
										$nome_equipamento = '';
									}
								}
							?>
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Ficha Técnica</h3> 
                            </div> 
                            <div class="panel-body"> 
								<?php if($veiculo['EMPRESA_ID_AUTOMOVEIS'] == $_SESSION['empresa']){?>
                                <div class="form-group">
									<label>Nome: <?php echo $veiculo['NOME_AUTOMOVEIS']; ?></label>
                                </div>
                                <div class="form-group">
                                    <label>Modelo: <?php if(empty($veiculo['MODELO_AUTOMOVEIS'])){ echo "Indisponivel"; } else { echo $veiculo['MODELO_AUTOMOVEIS']; } ?></label>
								</div>
								<div class="form-group">
                                    <label>Marca: <?php if(empty($veiculo['MARCA_AUTOMOVEIS'])){ echo "Indisponivel"; } else { echo $veiculo['MARCA_AUTOMOVEIS']; } ?></label>
								</div>
								<div class="form-group">
                                    <label>Placa: <?php echo $veiculo['PLACA_AUTOMOVEIS']; ?></label>
                                </div>
								<div class="form-group">
                                    <label>Tipo: <?php echo $veiculo['TIPO_AUTOMOVEIS']; ?></label>
                                </div>
								<div class="form-group">
                                    <label>Equipamento: <?php if(empty($nome_equipamento)){ echo "Indisponivel"; } else { echo "<a href='visualizar_equipamentosempresa.php?id=$id_equipamento'>".$nome_equipamento."</a>"; } ?></label>
                                </div>
								<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><a href="veiculosempresa.php">Voltar</a></div></div> 
								<?php } else { echo "Acesso Restrito. <a href='veiculosempresa.php'>Voltar</a>"; } ?>
							</div>
						</div>
						<?php if(1 == 1){?>
						<div class="panel panel-border panel-primary">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Imprudências</h3> 
                            </div> 
                            <div class="panel-body"> 
								<?php
									if(!empty($id_equipamento)){ 
									$selecao_imprudencias = "SELECT * FROM imprudencias WHERE EQUIPAMENTOS_ID_IMPRUDENCIAS = $id_equipamento";
									$consulta_imprudencias = $conexao_bd->query($selecao_imprudencias);
									if($consulta_imprudencias->num_rows > 0){
								?>
                                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                    <table id="datatable" class="table table-small-font table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th>X</th>
                                                <th>Y</th>
                                                <th style="width: 15%;">Data do ocorrido</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php while($imprudencias = mysqli_fetch_assoc($consulta_imprudencias)){ ?>
                                            <tr>
                                                <td><?php echo $imprudencias['ID_IMPRUDENCIAS']; ?></td>
                                                <td><?php echo $imprudencias['X_IMPRUDENCIAS']; ?></td>
                                                <td><?php echo $imprudencias['Y_IMPRUDENCIAS']; ?></td>
                                                <td><?php echo $imprudencias['DATA_IMPRUDENCIAS']; ?></td>
                                            </tr>
											<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
								<?php } else { echo "<div class='col-md-12 col-sm-12 col-xs-12'> Não consta imprudência.</div>"; } } else { echo "Sem equipamento"; } ?>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
        </div>
		<?php include_once('includes/scripts_ok.php'); ?>
	</body>
</html>