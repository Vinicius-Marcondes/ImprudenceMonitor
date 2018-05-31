<?php
	require('../../banco.php');
	session_start();
	
	$id = $_POST['deletar'];
	
	$c_equipamentos = "SELECT * FROM equipamentos where empresaE = '$id'";
	$v_equipamentos =  $conecta_banco->query($c_equipamentos);
	if($v_equipamentos->num_rows > 0){
		$dl_equipamentos = "DELETE FROM equipamentos WHERE empresaE = '$id'";
		$deletar_equipamentos = $conecta_banco->query($dl_equipamentos);
	}
	
	$c_veiculos = "SELECT * FROM veiculos where empresaV = '$id'";
	$v_veiculos =  $conecta_banco->query($c_veiculos);
	if($v_veiculos->num_rows > 0){
		$dl_veiculos = "DELETE FROM veiculos WHERE empresaV = '$id'";
		$deletar_veiculos = $conecta_banco->query($dl_veiculos);
	}
	
	$c_pessoa = "SELECT * FROM pessoas where empresaP = '$id'";
	$v_pessoa =  $conecta_banco->query($c_pessoa);
	if($v_pessoa->num_rows > 0){
		$up_pessoa = "UPDATE pessoas SET empresaP = 0 where empresaP = '$id'";
		$update_pessoa = $conecta_banco->query($up_pessoa);
	}
	
	$dl_empresa = "DELETE FROM empresas WHERE idE = '$id'";
	$deletar_empresa = $conecta_banco->query($dl_empresa);
	
	if ($total = mysqli_affected_rows($conecta_banco)){
		$_SESSION['mensagem_perfil'] = "<div class='alert alert-success'><strong>Sucesso!</strong> Empresa retirada do banco com sucesso.</div>";
		header ("Location: ../listagem_empresas.php");
	} else {
		$_SESSION['mensagem_perfil'] = "<div class='alert alert-danger'><strong>Erro!</strong> Por favor tente novamente em alguns instantes.</div>";
		header ("Location: ../listagem_empresas.php");
	}   
?>