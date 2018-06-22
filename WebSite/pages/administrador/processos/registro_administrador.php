<?php 
	require('../../banco.php');
	session_start();
	
	$nome = $_POST['nome'];
	$cep = $_POST['cep'];
	$telefone = $_POST['telefone'];
	$senha = hash("sha256", hash("sha256", $_POST['password']));
	$sexo = $_POST['gender'];

	$tmp_email = $_POST['email'];
	$c_email = "SELECT * FROM pessoas where emailP = '$tmp_email'";
	$v_email =  $conecta_banco->query($c_email);
	if($v_email->num_rows == 0){ 
		$email = $_POST['email'];
	} else {
		$_SESSION['mensagem_perfil'] = "<div class='alert alert-warning'><strong>Atenção!</strong> Este email já está em uso.</div>";
		header('Location: ../adicionar_administrador.php');
	}
		
	$tmp_rg = $_POST['rg'];
	$c_rg = "SELECT * FROM pessoas where rgP = '$tmp_rg'";
	$v_rg =  $conecta_banco->query($c_rg);
	if($v_rg->num_rows == 0){ 
		$rg = $_POST['rg'];
	} else {
		$_SESSION['mensagem_perfil'] = "<div class='alert alert-warning'><strong>Atenção!</strong> Este rg já está em uso.</div>";
		header('Location: ../adicionar_administrador.php');
	}
		
	$tmp_cpf = $_POST['cpf'];
	$c_cpf = "SELECT * FROM pessoas where cpfP = '$tmp_cpf'";
	$v_cpf =  $conecta_banco->query($c_cpf);
	if($v_cpf->num_rows == 0){ 
		$cpf = $_POST['cpf'];
	} else {
		$_SESSION['mensagem_perfil'] = "<div class='alert alert-warning'><strong>Atenção!</strong> Este cpf já está em uso.</div>";
		header('Location: ../adicionar_administrador.php');
	}
		
	if(isset($email) && isset($cpf) && isset($rg)){
		$d_pessoa = "INSERT INTO pessoas (nomeP, emailP, cpfP, rgP, cepP, telefoneP, senhaP, sexoP, perfilP, empresaP) 
		VALUES ('$nome', '$email', '$cpf', '$rg', '$cep', '$telefone', '$senha', '$sexo', '1', '0')";
		$ins_pessoa = $conecta_banco->query($d_pessoa);
		if($ins_pessoa == true){
			$_SESSION['mensagem_perfil'] = "<div class='alert alert-success'><strong>Sucesso!</strong> Administrador adicionado.</div>";
			header('Location: ../adicionar_administrador.php');
		} else {
			$_SESSION['mensagem_perfil'] = "<div class='alert alert-danger'><strong>Erro!</strong> Por favor tente novamente em alguns instantes.</div>";
			header('Location: ../adicionar_administrador.php');
		}
	}
?>