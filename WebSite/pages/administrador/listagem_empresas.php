<!DOCTYPE html>
<html>
	<head>
		<title>EMPRESAS | MDI</title>
		<?php session_start(); include_once("../verifica_sessao.php"); include_once("links.php"); ?>
	</head>
	<body class="theme-light-blue">
		<?php include_once("../loader.php"); include_once("menu.php"); ?>
		<section class="content">
			<div class="container-fluid">
			<div class="block-header">
				<h2>EMPRESAS</h2>
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
											<th>Email</th>
											<th>CNPJ</th>
											<th>Telefone</th>
											<th>CEP</th>
											<th>Excluir</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Nome</th>
											<th>Email</th>
											<th>CNPJ</th>
											<th>Telefone</th>
											<th>CEP</th>
											<th>Excluir</th>
										</tr>
									</tfoot>
									<tbody>
										<?php 
										$mysql = "SELECT * FROM empresas";
										$selecionar_empresa =  $conecta_banco->query($mysql);
										while ($coluna_empresa = mysqli_fetch_array($selecionar_empresa)) {
											$id = $coluna_empresa['idE'];
											$nome = $coluna_empresa['nomeE'];
											$email = $coluna_empresa['emailE'];
											$cnpj = $coluna_empresa['cnpjE'];
											$telefone = $coluna_empresa['telefoneE'];
											$cep = $coluna_empresa['cepE'];
										?>
										<tr>
											<td><?php echo $id; ?></td>
											<td><?php echo $nome; ?></td>
											<td><?php echo $email; ?></td>
											<td><?php echo $cnpj; ?></td>
											<td><?php echo $telefone; ?></td>
											<td><?php echo $cep; ?></td>
											<td><form method="post" action="processos/deletar_empresa.php"><button type="submit" name="deletar" value="<?php echo $id; ?>" class="btn btn-danger btn-circle waves-effect waves-circle waves-float"><i class="material-icons">delete</i></button></form></td>
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
