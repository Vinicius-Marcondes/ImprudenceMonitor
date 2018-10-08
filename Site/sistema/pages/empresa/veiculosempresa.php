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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
										<div class="row">
											<?php if(isset($_SESSION['msg_veiculoempresa'])){ echo $_SESSION['msg_veiculoempresa']; unset($_SESSION['msg_veiculoempresa']); } ?>
											<div class="col-sm-6">
												<div class="m-b-30">
													<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Adicionar <i class="fa fa-plus"></i></button>
												</div>
											</div>
										</div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
												<?php 
													$selecao_veiculo = "SELECT * FROM automoveis_empresa WHERE EMPRESA_ID_AUTOMOVEIS = $_SESSION[id]";
													$consulta_veiculo = $conexao_bd->query($selecao_veiculo);
													if($consulta_veiculo->num_rows > 0){
												?>
                                                <table id="datatable" class="table table-small-font table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nome</th>
                                                            <th>Modelo</th>
                                                            <th>Marca</th>
                                                            <th>Placa</th>
                                                            <th>Tipo</th>
                                                            <th>Opções</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														<?php while($veiculo = mysqli_fetch_assoc($consulta_veiculo)){ ?>
                                                        <tr>
                                                            <td><?php echo $veiculo['ID_AUTOMOVEIS']; ?></td>
                                                            <td><?php echo $veiculo['NOME_AUTOMOVEIS']; ?></td>
                                                            <td><?php  if(empty($veiculo['MODELO_AUTOMOVEIS'])){ echo "Indisponivel"; } else { echo $veiculo['MODELO_AUTOMOVEIS']; } ?></td>
                                                            <td><?php  if(empty($veiculo['MARCA_AUTOMOVEIS'])){ echo "Indisponivel"; } else { echo $veiculo['MARCA_AUTOMOVEIS']; } ?></td>
                                                            <td><?php echo $veiculo['PLACA_AUTOMOVEIS']; ?></td>
                                                            <td><?php echo $veiculo['TIPO_AUTOMOVEIS']; ?></td>
                                                            <td class="actions">
																<a href="visualizar_veiculosempresa.php?id=<?php echo $veiculo['ID_AUTOMOVEIS']; ?>"><i class="fa fa-binoculars"></i></a>
																<a href="editar_veiculosempresa.php?id=<?php echo $veiculo['ID_AUTOMOVEIS']; ?>"><i class="fa fa-pencil"></i></a>
																<a href="processos/deletar_veiculoempresa.php?id=<?php echo $veiculo['ID_AUTOMOVEIS']; ?>"><i class="fa fa-trash-o"></i></a>
															</td>
                                                        </tr>
														<?php } ?>
                                                    </tbody>
                                                </table>
												<?php } else { echo "Não consta nenhum veículo."; }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>          
                        </div>
                    </div>
                </div> 
            </div>
        </div>
		<?php include_once('veiculosempresa_modal.php'); include_once('includes/scripts_ok.php'); ?>
	</body>
</html>