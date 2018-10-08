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
								$selecao_equipamento = "SELECT * FROM equipamentos_empresa WHERE ID_EQUIPAMENTOS = $id AND EMPRESA_ID_EQUIPAMENTOS = $_SESSION[id]";
								$consulta_equipamento = $conexao_bd->query($selecao_equipamento);
								$equipamento = mysqli_fetch_assoc($consulta_equipamento);
							?>
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Configurações do equipamento <?php if(!empty($equipamento['NOME_EQUIPAMENTOS'])){ echo "'".$equipamento['NOME_EQUIPAMENTOS']."'"; } ?></h3> 
                            </div> 
                            <div class="panel-body"> 
								<?php if(isset($_SESSION['msg_edit_equipamentos'])){ echo $_SESSION['msg_edit_equipamentos']; unset($_SESSION['msg_edit_equipamentos']); } if($equipamento['EMPRESA_ID_EQUIPAMENTOS'] == $_SESSION['id']){ ?>
                                <form role="form" method="post" action="processos/editar_equipamentoempresa.php">
                                    <div class="form-group">
                                        <label for="Nome">Nome</label>
                                        <input type="text" value="<?php echo $equipamento['NOME_EQUIPAMENTOS']; ?>" id="Nome" name="nome" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="modelo">Modelo</label>
                                        <input type="text" value="<?php echo $equipamento['MODELO_EQUIPAMENTOS']; ?>" id="modelo" name="modelo" class="form-control">
                                    </div>
									<div class="row">
									<div class="col-lg-11 col-md-9 col-sm-9 col-xs-5"><a href="equipamentosempresa.php">Voltar</a></div>
									<div class="col-lg-1 col-md-3 col-sm-3 col-xs-7"><button class="btn btn-primary waves-effect waves-light w-md" type="submit" name="btn" value="<?php echo $id; ?>">Salvar</button></div></div>
                                </form>
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