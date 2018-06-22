<?php 
	require('../../banco.php');
	session_start();
	
	$id = $_POST['deletar'];
	
	$c_pessoa = "SELECT * FROM pessoas where perfilP = '$id'";
	$v_pessoa =  $conecta_banco->query($c_pessoa);	
	if($v_pessoa->num_rows > 0){
		$up_pessoa = "UPDATE pessoas SET perfilP = 5 where perfilP = '$id'";
		$update_pessoa = $conecta_banco->query($up_pessoa);
	}
	
	$dl_perfil = "DELETE FROM perfil WHERE idPE = '$id'";
	$deletar_perfil = $conecta_banco->query($dl_perfil);
	if ($total = mysqli_affected_rows($conecta_banco)){
		$_SESSION['mensagem_perfil'] = "<div class='alert alert-success'><strong>Sucesso!</strong> Função apagada.</div>";
		header ("Location: ../listagem_perfil.php");
	} else {
		$_SESSION['mensagem_perfil'] = "<div class='alert alert-danger'><strong>Erro!</strong> Por favor tente novamente em alguns instantes.</div>";
		header ("Location: ../listagem_perfil.php");
	}    
?>