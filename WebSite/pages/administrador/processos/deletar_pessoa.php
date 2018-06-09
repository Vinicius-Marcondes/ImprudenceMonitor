<?php
	require('../../banco.php');
	session_start();
	
	$id = $_POST['deletar'];
	
	$c_imprudencias = "SELECT * FROM imprudencias where pessoaI = '$id'";
	$v_imprudencias =  $conecta_banco->query($c_imprudencias);
	if($v_imprudencias->num_rows > 0){
		$dl_imprudencias = "DELETE FROM imprudencias WHERE pessoaI = '$id'";
		$deletar_imprudencias = $conecta_banco->query($dl_imprudencias);
	}
	
	$c_pessoa = "SELECT * FROM equipamentos where pessoaE = '$id'";
	$v_pessoa =  $conecta_banco->query($c_pessoa);
	if($v_pessoa->num_rows > 0){
		$up_equipamento = "UPDATE equipamentos SET pessoaE = 0 where pessoaE = '$id'";
		$update_equipamento = $conecta_banco->query($up_equipamento);
	}
	
	$dl_pessoa = "DELETE FROM pessoas WHERE idP = '$id'";
	$deletar_pessoa = $conecta_banco->query($dl_pessoa);
	
	if ($total = mysqli_affected_rows($conecta_banco)){
		$_SESSION['mensagem_perfil'] = "<div class='alert alert-success'><strong>Sucesso!</strong> Pessoa retirada do banco com sucesso.</div>";
		header ("Location: ../listagem_funcionarios.php");
	} else {
		$_SESSION['mensagem_perfil'] = "<div class='alert alert-danger'><strong>Erro!</strong> Por favor tente novamente em alguns instantes.</div>";
		header ("Location: ../listagem_funcionarios.php");
	}   
?>