<!DOCTYPE html>
<html>
	<head>
		<title>PERFIL | MDI</title>
		<?php session_start(); include_once("../verifica_sessao.php"); include_once("links.php"); ?>
	</head>
	<body class="theme-light-blue">
		<?php include_once("../loader.php"); include_once("menu.php");?>
		<section class="content">
			<div class="container-fluid">
				<div class="block-header">
					<h2>PERFIL</h2>
				</div>
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card">
							<div class="header">
								<h2>DADOS PESSOAIS</h2>
							</div>
							<div class="row" style="padding: 20px;">
								<div class="col-md-12 col-sm-6 col-lg-3" style="margin-bottom: 10px;"><p style="font-size: 18px;"><b>Nome: </b><?php echo $_SESSION['nome']; ?></p></div>
								<div class="col-md-12 col-sm-6 col-lg-3" style="margin-bottom: 10px;"><p style="font-size: 18px;"><b>Email: </b><?php echo $_SESSION['email']; ?></p></div>
								<div class="col-md-12 col-sm-6 col-lg-3" style="margin-bottom: 10px;"><p style="font-size: 18px;"><b>RG: </b><?php echo $_SESSION['rg']; ?></p></div>
								<div class="col-md-12 col-sm-6 col-lg-3" style="margin-bottom: 10px;"><p style="font-size: 18px;"><b>CPF: </b><?php echo $_SESSION['cpf']; ?></p></div>
								<div class="col-md-12 col-sm-6 col-lg-3" style="margin-bottom: 10px;"><p style="font-size: 18px;"><b>Telefone: </b><?php echo $_SESSION['telefone']; ?></p></div>
								<div class="col-md-12 col-sm-6 col-lg-3" style="margin-bottom: 10px;"><p style="font-size: 18px;"><b>CEP: </b><?php echo $_SESSION['cep']; ?></p></div>
								<div class="col-md-12 col-sm-6 col-lg-3" style="margin-bottom: 10px;"><p style="font-size: 18px;"><b>Sexo: </b><?php echo $_SESSION['sexo']; ?></p></div>
								<div class="col-lg-12 col-md-3 col-sm-3 col-xs-12"><a href="editar_profile.php">Editar</a></div><div class="col-lg-12 col-md-3 col-sm-3 col-xs-12"><a href="index.php">Voltar</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</body>
	<?php include_once("scripts.php"); ?>
</html>
