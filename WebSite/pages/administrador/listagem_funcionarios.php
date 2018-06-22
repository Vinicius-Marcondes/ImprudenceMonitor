<!DOCTYPE html>
<html>
	<head>
		<title>FUNCIONÁRIOS | MDI</title>
		<?php session_start(); include_once("../verifica_sessao.php"); include_once("links.php"); ?>
	</head>
	<body class="theme-light-blue">
		<?php include_once("../loader.php"); include_once("menu.php"); ?>
		<section class="content">
			<div class="container-fluid">
			<div class="block-header">
				<h2>FUNCIONÁRIOS</h2>
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
											<th>RG</th>
											<th>CPF</th>
											<th>Telefone</th>
											<th>CEP</th>
											<th>Sexo</th>
											<th>Função</th>
											<th>Empresa</th>
											<th>Excluir</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>#</th>
											<th>Nome</th>
											<th>Email</th>
											<th>RG</th>
											<th>CPF</th>
											<th>Telefone</th>
											<th>CEP</th>
											<th>Sexo</th>
											<th>Função</th>
											<th>Empresa</th>
											<th>Excluir</th>
										</tr>
									</tfoot>
									<tbody>
										<?php 
										$mysql = "SELECT * FROM pessoas";
										$selecionar_pessoa =  $conecta_banco->query($mysql);
										while ($coluna_pessoa = mysqli_fetch_array($selecionar_pessoa)) {
											$id = $coluna_pessoa['idP'];
											$nome = $coluna_pessoa['nomeP'];
											$email = $coluna_pessoa['emailP'];
											$rg = $coluna_pessoa['rgP'];
											$cpf = $coluna_pessoa['cpfP'];
											$telefone = $coluna_pessoa['telefoneP'];
											$cep = $coluna_pessoa['cepP'];
											$sexo = $coluna_pessoa['sexoP'];
											$perfilP = $coluna_pessoa['perfilP'];
											$c_perfil = "SELECT * FROM perfil WHERE idPE = '$perfilP'";
											$v_perfil =  $conecta_banco->query($c_perfil);
											$selecao_perfil = mysqli_fetch_array($v_perfil);
											$perfil = $selecao_perfil['nomePE'];
											$empresaP = $coluna_pessoa['empresaP'];
											$c_empresa = "SELECT * FROM empresas WHERE idE = '$empresaP'";
											$v_empresa =  $conecta_banco->query($c_empresa);
											$selecao_empresa = mysqli_fetch_array($v_empresa);
											$empresa = $selecao_empresa['nomeE'];
											if(empty($empresa)){
												$empresa = "Sem informação";
											}
										?>
										<tr>
											<td><?php echo $id; ?></td>
											<td><?php echo $nome; ?></td>
											<td><?php echo $email; ?></td>
											<td><?php echo $rg; ?></td>
											<td><?php echo $cpf; ?></td>
											<td><?php echo $telefone; ?></td>
											<td><?php echo $cep; ?></td>
											<td><?php echo $sexo; ?></td>
											<td><?php echo $perfil; ?></td>
											<td><?php echo $empresa; ?></td>
											<td><form method="post" action="processos/deletar_pessoa.php"><button type="submit" name="deletar" value="<?php echo $id; ?>" class="btn btn-danger btn-circle waves-effect waves-circle waves-float"><i class="material-icons">delete</i></button></form></td>
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
