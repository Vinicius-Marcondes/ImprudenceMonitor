<?php 
	require('../../banco.php');
	session_start();
	
	$tmp_nome = $_POST['nome'];
	$c_perfil = "SELECT * FROM perfil where nomePE = '$tmp_nome'";
	$v_perfil =  $conecta_banco->query($c_perfil);	
	unset($tmp_nome);
	
	if($v_perfil->num_rows == 0){ 
		$perfil = $_POST['nome'];
	} else {
		$_SESSION['mensagem_perfil'] = "<div class='alert alert-warning'><strong>Atenção!</strong> Esta função já existe.</div>";
		header('Location: ../adicionar_perfil.php');
	}
	
	if(isset($perfil)){
		$mysql_perfil = "INSERT INTO perfil (nomePE) VALUES ('$perfil')";
		$ins_perfil = $conecta_banco->query($mysql_perfil);
		if($ins_perfil == true){
			$_SESSION['mensagem_perfil'] = "<div class='alert alert-success'><strong>Sucesso!</strong> Função inserida.</div>";
			header('Location: ../adicionar_perfil.php');
		} else {
			$_SESSION['mensagem_perfil'] = "<div class='alert alert-danger'><strong>Erro!</strong> Por favor tente novamente em alguns instantes.</div>";
			header('Location: ../adicionar_perfil.php');
		}
	} else {
		header('Location: ../adicionar_perfil.php');
	}
?>