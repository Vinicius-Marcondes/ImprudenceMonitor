<!DOCTYPE html>
<html>
	<head>
		<title>FUNÇÕES | MDI</title>
		<?php session_start(); include_once("../verifica_sessao.php"); include_once("links.php"); ?>
	</head>
	<body class="theme-light-blue">
		<?php include_once("../loader.php"); include_once("menu.php");?>
		<section class="content">
			<div class="container-fluid">
				<div class="block-header">
					<h2>FUNÇÕES</h2>
				</div>
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card">
							<div class="header">
								<h2>ALTERAR FUNÇÃO</h2>
							</div>
							<div class="row" style="padding: 20px;">
								<?php 
								if(isset($_SESSION['mensagem_perfil'])){
									echo $_SESSION['mensagem_perfil'];
									unset($_SESSION['mensagem_perfil']);
								}
								
								$id = $_POST['editar'];
								$mysql = "SELECT * FROM perfil WHERE idPE = '$id'";
								$selecionar_perfil =  $conecta_banco->query($mysql);
								$coluna_perfil = mysqli_fetch_array($selecionar_perfil);
								$nome = $coluna_perfil['nomePE'];
								?>
								<form action="processos/editar_funcao.php" method="POST">
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12"><p style="font-size: 14px;"><b>Nome: </b></p></div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
										<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" placeholder="<?php echo $nome; ?>" name="nome" maxlength="100" autofocus>
											</div>
										</div>
									</div>
									<div class='col-xs-12 col-sm-3 col-md-3'>
										<button type="submit" name="editar2" value="<?php echo $id; ?>" class="btn bg-blue waves-effect">
											<i class="material-icons">edit</i>
											<span>Editar</span>
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
	<?php include_once("scripts.php"); ?>
</html>
