<?php
	session_start();
	require('../../banco.php');
	
	$cod = $_SESSION['id'];
	$sexo = $_POST['gender'];
	$c_selecao = "SELECT * FROM pessoas where idP = '$cod'";
	$v_selecao =  $conecta_banco->query($c_selecao);
	$coluna_selecao = mysqli_fetch_array($v_selecao);
	
	if(empty($_POST['nome'])){
		$nome = $coluna_selecao['nomeP'];
	} else {
		$nome = $_POST['nome'];
	}
	
	if(empty($_POST['telefone'])){
		$telefone = $coluna_selecao['telefoneP'];
	} else {
		$telefone = $_POST['telefone'];
	}
	
	if(empty($_POST['cep'])){
		$cep = $coluna_selecao['cepP'];
	} else {
		$cep = $_POST['cep'];
	}
	
	if(empty($_POST['senha'])){
		$senha = $coluna_selecao['senhaP'];
	} else {
		$senha = hash("sha256", hash("sha256", $_POST['senha']));
	}
	
	if(empty($_POST['email']) || $_POST['email'] == $coluna_selecao['emailP']){
		$email = $coluna_selecao['emailP'];
	} else {
		$ver_email = $_POST['email'];
		$c_email = "SELECT * FROM pessoas where emailP = '$ver_email'";
		$v_email =  $conecta_banco->query($c_email);
		if($v_email->num_rows == 0){
			$email = $_POST['email'];
		} else {
			$_SESSION['mensagem_perfil'] = "<div class='alert alert-warning'><strong>Atenção!</strong> Este email já está em uso.</div>";
			header('Location: ../editar_profile.php');
		}
	}
	
	if(empty($_POST['rg']) || $_POST['rg'] == $coluna_selecao['rgP']){
		$rg = $coluna_selecao['rgP'];
	} else {
		$ver_rg = $_POST['rg'];
		$c_rg = "SELECT * FROM pessoas where rgP = '$ver_rg'";
		$v_rg =  $conecta_banco->query($c_rg);
		if($v_rg->num_rows == 0){
			$rg = $_POST['rg'];
		} else {
			$_SESSION['mensagem_perfil'] = "<div class='alert alert-warning'><strong>Atenção!</strong> Este rg já está em uso.</div>";
			header('Location: ../editar_profile.php');
		}
	}
	
	if(empty($_POST['cpf']) || $_POST['cpf'] == $coluna_selecao['cpfP']){
		$cpf = $coluna_selecao['cpfP'];
	} else {
		$ver_cpf = $_POST['cpf'];
		$c_cpf = "SELECT * FROM pessoas where cpfP = '$ver_cpf'";
		$v_cpf =  $conecta_banco->query($c_cpf);
		if($v_cpf->num_rows == 0){ 
			$cpf = $_POST['cpf'];
		} else {
			$_SESSION['mensagem_perfil'] = "<div class='alert alert-warning'><strong>Atenção!</strong> Este cpf já está em uso.</div>";
			header('Location: ../editar_profile.php');
		}
	}
	
	if(isset($email) && isset($rg) && isset($cpf)){
		$up_funcionario = "UPDATE pessoas SET nomeP = '$nome', emailP = '$email', telefoneP = '$telefone', rgP = '$rg', cpfP = '$cpf', cepP = '$cep', senhaP = '$senha', sexoP = '$sexo',perfilP = '1' where idP = '$cod'";
		$update_funcionario = $conecta_banco->query($up_funcionario);
		if($update_funcionario == true){
			session_unset();
			session_destroy();
			header('Location: ../../../login.php');
		} else {
			$_SESSION['mensagem_perfil'] = "<div class='alert alert-danger'><strong>Erro!</strong> Por favor tente novamente em alguns instantes.</div>";
			header('Location: ../editar_profile.php');
		}
	}
?>