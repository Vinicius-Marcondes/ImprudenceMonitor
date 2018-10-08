<!DOCTYPE html>
<html>
    <head>
		<?php session_start(); include_once('includes/header.php'); ?>
        <title>MDI - EQUIPAMENTOS</title> 
    </head>
    <body class="fixed-left">
        <div id="wrapper">
			<?php include_once('includes/menu.php'); ?>             
            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="pull-left page-title">Equipamentos</h4>
                                <ol class="breadcrumb pull-right">
                                    <li><a href="index.php">MDI</a></li>
                                    <li><a class="active">Empresa</a></li>
                                    <li>Equipamentos</li>
                                </ol>
                            </div>
                        </div>
						<div class="panel panel-border panel-primary">
							<?php 
								$id = $_GET['id'];
								$selecao_equipamento = "SELECT * FROM equipamentos_empresa WHERE ID_EQUIPAMENTOS = $id AND EMPRESA_ID_EQUIPAMENTOS = $_SESSION[empresa]";
								$consulta_equipamento = $conexao_bd->query($selecao_equipamento);
								$equipamento = mysqli_fetch_assoc($consulta_equipamento);
								
							?>
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Ficha Técnica</h3> 
                            </div> 
                            <div class="panel-body"> 
								<?php if($equipamento['EMPRESA_ID_EQUIPAMENTOS'] == $_SESSION['empresa']){?>
                                <div class="form-group">
									<label>Nome: <?php echo $equipamento['NOME_EQUIPAMENTOS']; ?></label>
                                </div>
                                <div class="form-group">
                                    <label>Modelo: <?php if(empty($equipamento['MODELO_EQUIPAMENTOS'])){ echo "Indisponivel"; } else { echo $equipamento['MODELO_EQUIPAMENTOS']; } ?></label>
								</div>
								<div class="form-group">
                                    <label>Serial: <?php echo $equipamento['SERIAL_EQUIPAMENTOS']; ?></label>
                                </div>
								<div class="row"><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><a href="equipamentosempresa.php">Voltar</a></div></div> 
								<?php } else { echo "Acesso Restrito. <a href='equipamentosempresa.php'>Voltar</a>"; } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
		<?php include_once('includes/scripts_ok.php'); ?>
	</body>
</html>