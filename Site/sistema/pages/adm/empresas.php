<!DOCTYPE html>
<html>
    <head>
		<?php session_start(); include_once('includes/header.php'); ?>
        <title>MDI - EMPRESAS</title> 
    </head>
    <body class="fixed-left">
        <div id="wrapper">
			<?php include_once('includes/menu.php'); ?>             
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Empresas</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="index.php">MDI</a></li>
                                    <li>Empresas</li>
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="row">
											<?php if(isset($_SESSION['msg_empresa'])){ echo $_SESSION['msg_empresa']; unset($_SESSION['msg_empresa']); } ?>
											<div class="col-sm-6">
												<div class="m-b-30">
													<button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal">Adicionar <i class="fa fa-plus"></i></button>
												</div>
											</div>
										</div>
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
												<?php 
													$selecao_empresa = "SELECT * FROM empresa WHERE ID_EMPRESA > 0";
													$consulta_empresa  = $conexao_bd->query($selecao_empresa);
													if($consulta_empresa->num_rows > 0){
												?>
                                                <table id="datatable" class="table table-small-font table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Nome</th>
                                                            <th>Email</th>
                                                            <th>CNPJ</th>
                                                            <th>Telefone</th>
                                                            <th>CEP</th>
                                                            <th>Opções</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
														<?php while($empresa = mysqli_fetch_assoc($consulta_empresa)){ ?>
                                                        <tr>
                                                            <td><?php echo $empresa['ID_EMPRESA']; ?></td>
                                                            <td><?php echo $empresa['NOME_EMPRESA']; ?></td>
                                                            <td><?php echo $empresa['EMAIL_EMPRESA']; ?></td>
                                                            <td><?php echo $empresa['CNPJ_EMPRESA']; ?></td>
                                                            <td><?php echo $empresa['TELEFONE_EMPRESA']; ?></td>
                                                            <td><?php echo $empresa['CEP_EMPRESA']; ?></td>
                                                            <td class="actions">
																<a href="visualizar_empresas.php?id=<?php echo $empresa['ID_EMPRESA']; ?>"><i class="fa fa-binoculars"></i></a>
																<a href="processos/deletar_empresa.php?id=<?php echo $empresa['ID_EMPRESA']; ?>"><i class="fa fa-trash-o"></i></a>
															</td>
                                                        </tr>
														<?php } ?>
                                                    </tbody>
                                                </table>
												<?php } else { echo "Não consta nenhuma empresa."; }?>
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
		<?php include_once('empresas_modal.php'); include_once('includes/scripts_ok.php'); ?>
	</body>
</html>