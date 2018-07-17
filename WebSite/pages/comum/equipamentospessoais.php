<!DOCTYPE html>
<html>
    <head>
		<?php session_start(); include_once('includes/header.php'); ?>
        <title>MDI - EQUIPAMENTOS PESSOAIS</title> 
    </head>
    <body class="fixed-left">
        <div id="wrapper">
			<?php include_once('includes/menu.php'); ?>
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Equipamentos pessoais</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="index.php">MDI</a></li>
                                    <li><a class="active">Veículos</a></li>
                                    <li>Equipamentos pessoais</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
										<div class="row">
											<?php if(isset($_SESSION['msg_equipamentopessoal'])){ echo $_SESSION['msg_equipamentopessoal']; unset($_SESSION['msg_equipamentopessoal']); } ?>
											<div class="col-sm-6">
												<div class="m-b-30">
													<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Adicionar <i class="fa fa-plus"></i></button>
												</div>
											</div>
										</div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
												<?php 
													$selecao_equipamentos = "SELECT * FROM equipamentos_pessoais WHERE PESSOAS_ID_PESSOAS = $_SESSION[id]";
													$consulta_equipamentos = $conexao_bd->query($selecao_equipamentos);
													if($consulta_equipamentos->num_rows > 0){
												?>
                                                <table id="datatable" class="table table-small-font table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nome</th>
                                                            <th>Modelo</th>
                                                            <th>Serial</th>
                                                            <th>Opções</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														<?php while($equipamento = mysqli_fetch_assoc($consulta_equipamentos)){ ?>
                                                        <tr>
                                                            <td><?php echo $equipamento['ID_EQUIPAMENTOS']; ?></td>
                                                            <td><?php echo $equipamento['NOME_EQUIPAMENTOS']; ?></td>
                                                            <td><?php  if(empty($equipamento['MODELO_EQUIPAMENTOS'])){ echo "Indisponivel"; } else { echo $equipamento['MODELO_EQUIPAMENTOS']; } ?></td>
                                                            <td><?php echo $equipamento['SERIAL_EQUIPAMENTOS']; ?></td>
                                                            <td class="actions">
																<a href="visualizar_equipamentospessoais.php?id=<?php echo $equipamento['ID_EQUIPAMENTOS']; ?>"><i class="fa fa-binoculars"></i></a>
																<a href="editar_equipamentospessoais.php?id=<?php echo $equipamento['ID_EQUIPAMENTOS']; ?>"><i class="fa fa-pencil"></i></a>
																<a href="processos/deletar_equipamentopessoal.php?id=<?php echo $equipamento['ID_EQUIPAMENTOS']; ?>"><i class="fa fa-trash-o"></i></a>
															</td>
                                                        </tr>
														<?php } ?>
                                                    </tbody>
                                                </table>
												<?php } else { echo "Não consta nenhum equipamento."; }?>
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
		<?php include_once('equipamentospessoais_modal.php'); include_once('includes/scripts_ok.php'); require_once('../verificar_sessao.php'); ?>
	</body>
</html>