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
						<div class="panel panel-border panel-primary">
							<?php 
								$id = $_GET['id'];
								$selecao_empresa = "SELECT * FROM empresa WHERE ID_EMPRESA = $id";
								$consulta_empresa = $conexao_bd->query($selecao_empresa);
								$empresa = mysqli_fetch_assoc($consulta_empresa);
							?>
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Informações da empresa</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <div class="form-group">
									<label>Nome: <?php echo $empresa['NOME_EMPRESA']; ?></label>
                                </div>
								<div class="form-group">
                                    <label>Email: <?php echo $empresa['EMAIL_EMPRESA']; ?></label>
                                </div>
                                <div class="form-group">
                                    <label>Telefone: <?php echo $empresa['TELEFONE_EMPRESA']; ?></label>
                                </div>
								<div class="form-group">
                                    <label>CNPJ: <?php echo $empresa['CNPJ_EMPRESA']; ?></label>
                                </div>
								<div class="form-group">
                                    <label>CEP: <?php echo $empresa['CEP_EMPRESA']; ?></label>
                                </div>
								<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><a href="empresas.php">Voltar</a></div></div> 
							</div>
						</div>
						<div class="panel panel-border panel-primary">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Funcionários</h3> 
                            </div> 
                            <div class="panel-body"> 
								<?php
									$selecao_funcionarios = "SELECT * FROM pessoas INNER JOIN perfil ON pessoas.PERFIL_ID_PESSOAS = perfil.ID_PERFIL WHERE EMPRESA_ID_PESSOAS = $id";
									$consulta_funcionarios = $conexao_bd->query($selecao_funcionarios);
									if($consulta_funcionarios->num_rows > 0){
								?>
                                <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                                    <table id="datatable" class="table table-small-font table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%;">#</th>
                                                <th>Nome</th>
                                                <th>Email</th>
                                                <th>CPF</th>
                                                <th>RG</th>
                                                <th>CEP</th>
                                                <th>Função</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php while($funcionarios = mysqli_fetch_assoc($consulta_funcionarios)){ ?>
                                            <tr>
                                                <td><?php echo $funcionarios['ID_PESSOAS']; ?></td>
                                                <td><?php echo $funcionarios['NOME_PESSOAS']; ?></td>
                                                <td><?php echo $funcionarios['EMAIL_PESSOAS']; ?></td>
                                                <td><?php echo $funcionarios['CPF_PESSOAS']; ?></td>
                                                <td><?php echo $funcionarios['RG_PESSOAS']; ?></td>
                                                <td><?php echo $funcionarios['CEP_PESSOAS']; ?></td>
                                                <td><?php echo $funcionarios['NOME_PERFIL']; ?></td>
                                            </tr>
											<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
								<?php } else { echo "<div class='col-md-12 col-sm-12 col-xs-12'> Não consta funcionários.</div>"; } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
		<?php include_once('empresas_modal.php'); include_once('includes/scripts_ok.php'); ?>
	</body>
</html>