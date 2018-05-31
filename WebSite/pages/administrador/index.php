<!DOCTYPE html>
<html>
	<head>
		<title>DASHBOARD | MDI</title>
		<?php session_start(); include_once("../verifica_sessao.php"); include_once("links.php"); ?>
	</head>
	<body class="theme-light-blue">
		<?php include_once("../loader.php"); include_once("menu.php"); ?>
		<section class="content">
			<?php
				$cont = 0;
				$c_empresa = "SELECT * FROM empresas";
				$v_empresa =  $conecta_banco->query($c_empresa);
				while($coluna_empresa = mysqli_fetch_array($v_empresa)){
					$cont++;
				}
				$empresas = $cont;
				$cont = 0;
				$c_func = "SELECT * FROM pessoas";
				$v_func =  $conecta_banco->query($c_func);
				while($coluna_func = mysqli_fetch_array($v_func)){
					$cont++;
				}
				$func = $cont;
				$cont = 0;
				$c_veiculos = "SELECT * FROM veiculos";
				$v_veiculos =  $conecta_banco->query($c_veiculos);
				while($coluna_veiculos = mysqli_fetch_array($v_veiculos)){
					$cont++;
				}
				$veiculos = $cont;
				$cont = 0;
				$c_imp = "SELECT * FROM imprudencias";
				$v_imp =  $conecta_banco->query($c_imp);
				while($coluna_imp = mysqli_fetch_array($v_imp)){
					$cont++;
				}
				$imp = $cont;
			?>
			<div class="container-fluid">
				<div class="block-header">
					<h2>DASHBOARD</h2>
				</div>
				<div class="row clearfix">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="info-box-4 hover-expand-effect">
							<div class="icon">
								<i class="material-icons col-light-blue">business</i>
							</div>
							<div class="content">
								<div class="text">EMPRESAS</div>
								<div class="number count-to" data-from="0" data-to="<?php echo $empresas; ?>" data-speed="1000" data-fresh-interval="20"></div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="info-box-4 hover-expand-effect">
							<div class="icon">
								<i class="material-icons col-light-green">people</i>
							</div>
							<div class="content">
								<div class="text">FUNCIONÁRIOS</div>
								<div class="number count-to" data-from="0" data-to="<?php echo $func; ?>" data-speed="1000" data-fresh-interval="20"></div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="info-box-4 hover-expand-effect">
							<div class="icon">
								<i class="material-icons col-indigo">drive_eta</i>
							</div>
							<div class="content">
								<div class="text">VEÍCULOS</div>
								<div class="number count-to" data-from="0" data-to="<?php echo $veiculos; ?>" data-speed="1000" data-fresh-interval="20"></div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<div class="info-box-4 hover-expand-effect">
							<div class="icon">
								<i class="material-icons col-red">priority_high</i>
							</div>
							<div class="content">
								<div class="text">IMPRUDÊNCIAS</div>
								<div class="number count-to" data-from="0" data-to="<?php echo $imp; ?>" data-speed="1000" data-fresh-interval="20"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php include_once("scripts.php"); ?>
	</body>
</html>
