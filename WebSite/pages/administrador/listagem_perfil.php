<!DOCTYPE html>
<html>
	<head>
		<title>FUNÇÕES | MDI</title>
		<?php session_start(); include_once("../verifica_sessao.php"); include_once("links.php"); ?>
	</head>
	<body class="theme-light-blue">
		<?php include_once("../loader.php"); include_once("menu.php"); ?>
		<section class="content">
			<div class="container-fluid">
			<div class="block-header">
				<h2>FUNÇÕES</h2>
			</div>
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header"><h2>LISTAGEM</h2></div>
						<div class="body">
							<?php 
							if(isset($_SESSION['mensagem_perfil'])){
								echo $_SESSION['mensagem_perfil'];
								unset($_SESSION['mensagem_perfil']);
							}
							?>
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover js-exportable dataTable">
									<thead>
										<tr>
											<th>#</th>
											<th>Nome</th>
											<th>Editar</th>
											<th>Excluir</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Nome</th>
											<th>Editar</th>
											<th>Excluir</th>
										</tr>
									</tfoot>
									<tbody>
										<?php 
										$mysql = "SELECT * FROM perfil";
										$selecionar_perfil =  $conecta_banco->query($mysql);
										while ($coluna_perfil = mysqli_fetch_array($selecionar_perfil)) {
											$id = $coluna_perfil['idPE'];
											$nome = $coluna_perfil['nomePE'];
										?>
										<tr>
											<td><?php echo $id; ?></td>
											<td><?php echo $nome; ?></td>
											<td><form method="post" action="editar_perfil.php"><button type="submit" name="editar" value="<?php echo $id; ?>" class="btn btn-primary btn-circle waves-effect waves-circle waves-float"><i class="material-icons">edit</i></button></form></td>
											<td><form method="post" action="processos/deletar_perfil.php"><button type="submit" name="deletar" value="<?php echo $id; ?>" class="btn btn-danger btn-circle waves-effect waves-circle waves-float"><i class="material-icons">delete</i></button></form></td>
										</tr>
										<?php 
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
    	</div>
		</section>
		<?php include_once("scripts.php"); ?>
	</body>
</html>
