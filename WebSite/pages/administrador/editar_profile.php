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
								<h2>ALTERAR DADOS PESSOAIS</h2>
							</div>
							<div class="row" style="padding: 20px;">
								<?php 
								if(isset($_SESSION['mensagem_perfil'])){
									echo $_SESSION['mensagem_perfil'];
									unset($_SESSION['mensagem_perfil']);
								}
								?>
								<form action="processos/editar_funcionario.php" method="POST">
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12"><p style="font-size: 14px;"><b>Nome: </b></p></div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
										<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" placeholder="<?php echo $_SESSION['nome']; ?>" name="nome" maxlength="100" autofocus>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12"><p style="font-size: 14px;"><b>Email: </b></p></div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
										<div class="form-group form-float">
											<div class="form-line">
												<input type="email" class="form-control" placeholder="<?php echo $_SESSION['email']; ?>" name="email" maxlength="100" focus>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12"><p style="font-size: 14px;"><b>Senha: </b></p></div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
										<div class="form-group form-float">
											<div class="form-line">
												<input type="password" class="form-control" placeholder="************" name="senha" minlength="6" maxlength="12" focus>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12"><p style="font-size: 14px;"><b>RG: </b></p></div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
										<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" placeholder="<?php echo $_SESSION['rg']; ?>" name="rg" minlength="9" maxlength="9" focus>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12"><p style="font-size: 14px;"><b>CPF: </b></p></div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
										<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" placeholder="<?php echo $_SESSION['cpf']; ?>" name="cpf" minlength="11" maxlength="11" focus>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12"><p style="font-size: 14px;"><b>Telefone: </b></p></div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
										<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" placeholder="<?php echo $_SESSION['telefone']; ?>" name="telefone" minlength="10" maxlength="11" focus>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12"><p style="font-size: 14px;"><b>CEP: </b></p></div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
										<div class="form-group form-float">
											<div class="form-line">
												<input type="text" class="form-control" placeholder="<?php echo $_SESSION['cep']; ?>" name="cep" minlength="8" maxlength="8" focus>
											</div>
										</div>
									</div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12"><p style="font-size: 14px;"><b>Sexo: </b></p></div>
									<div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">
										<div class="form-group">
											<input type="radio" name="gender" id="male" class="with-gap" value="Masculino" <?php if($_SESSION['sexo'] == "Masculino"){ echo "checked"; }?>>
											<label for="male">Masculino</label>
											<input type="radio" name="gender" id="female" class="with-gap" value="Feminino" <?php if($_SESSION['sexo'] == "Feminino"){ echo "checked"; }?>>
											<label for="female" class="m-l-20">Feminino</label>
										</div>
									</div>
									<div class='col-xs-12 col-sm-3 col-md-3'>
										<button type="submit" name="id" class="btn bg-blue waves-effect">
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
