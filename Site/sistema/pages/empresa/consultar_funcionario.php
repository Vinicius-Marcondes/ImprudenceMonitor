<!DOCTYPE html>
<html>
    <head>
		<?php session_start(); include_once('includes/header.php'); ?>
        <title>MDI - CONSULTAR</title> 
    </head>
    <body class="fixed-left">
        <div id="wrapper">
			<?php include_once('includes/menu.php'); ?>             
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Consultar</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="index.php">MDI</a></li>
                                    <li><a class="active">Empresa</a></li>
                                    <li>Consultar</li>
                                </ol>
                            </div>
                        </div>
                        <?php 
                            $id = $_GET['id'];
                            $selecao_pessoa = "SELECT * FROM pessoas INNER JOIN perfil ON pessoas.PERFIL_ID_PESSOAS = perfil.ID_PERFIL WHERE ID_PESSOAS = $id AND EMPRESA_ID_PESSOAS = $_SESSION[id]";
                            $consulta_pessoa = $conexao_bd->query($selecao_pessoa);
                            if($consulta_pessoa->num_rows != 0){
                            $pessoa = mysqli_fetch_assoc($consulta_pessoa);
                            $selecao_veiculo = "SELECT * FROM automoveis_empresa INNER JOIN equipamentos_empresa ON automoveis_empresa.EQUIPAMENTOS_ID_AUTOMOVEIS = equipamentos_empresa.ID_EQUIPAMENTOS WHERE PESSOAS_ID_AUTOMOVEIS = $id";
                            $consulta_veiculo = $conexao_bd->query($selecao_veiculo);
                        ?>
                            <div class="panel panel-border panel-primary">
                            <div class="panel-heading"> 
                                <h3 class="panel-title"><?php echo $pessoa['NOME_PESSOAS']; ?></h3> 
                            </div> 
                            <div class="panel-body"> 
                                <div class="form-group">
                                    <label>Nome: <?php echo $pessoa['NOME_PESSOAS']; ?></label>
                                </div>
                                <div class="form-group">
                                    <label>Email: <?php echo $pessoa['EMAIL_PESSOAS']; ?></label>
                                </div>
                                <div class="form-group">
                                    <label>Telefone: <?php echo $pessoa['TELEFONE_PESSOAS']; ?></label>
                                </div>
                                <div class="form-group">
                                    <label>Celular: <?php if(empty($pessoa['CELULAR_PESSOAS'])){ echo "Indisponivel"; } else { echo $pessoa['CELULAR_PESSOAS']; } ?></label>
                                </div>
                                <div class="form-group">
                                    <label>CPF: <?php echo $pessoa['CPF_PESSOAS']; ?></label>
                                </div>
                                <div class="form-group">
                                    <label>RG: <?php echo $pessoa['RG_PESSOAS']; ?></label>
                                </div>
                                <div class="form-group">
                                    <label>CEP: <?php echo $pessoa['CEP_PESSOAS']; ?></label>
                                </div>
                                <div class="form-group">
                                    <label>Função: <?php echo $pessoa['NOME_PERFIL']; ?></label>
                                </div>
                            </div>
                        </div>
                        <?php
                            while ($veiculo = mysqli_fetch_assoc($consulta_veiculo)){
                        ?>
						<div class="panel panel-border panel-primary">
                            <div class="panel-heading"> 
                                <h3 class="panel-title"><?php echo $veiculo['NOME_AUTOMOVEIS']; ?></h3> 
                            </div> 
                            <div class="panel-body"> 
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
                                    <label>Equipamento: <?php if(empty($veiculo['NOME_EQUIPAMENTOS'])){ echo "Indisponivel"; } else { echo $veiculo['NOME_EQUIPAMENTOS']; } ?></label>
                                </div>
							</div>
						</div>
                        <?php } ?>
						<div class="panel panel-border panel-primary">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Imprudências</h3> 
                            </div> 
                            <div class="panel-body"> 
								<?php
									if(empty($id_equipamento)){ $id_equipamento = 0; }
									$selecao_imprudencias = "SELECT * FROM imprudencias WHERE PESSOAS_ID_IMPRUDENCIAS = $pessoa[ID_PESSOAS]";
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
								<?php } else { echo "<div class='col-md-12 col-sm-12 col-xs-12'> Não consta imprudência.</div>"; }} else { echo "Você não possue permissão para acessar este conteúdo. <a href='funcionarios.php'>Voltar</a>"; } ?>
							</div>
						</div>

					</div>
				</div>
			</div>
        </div>
		<?php include_once('includes/scripts_ok.php'); ?>
	</body>
</html>