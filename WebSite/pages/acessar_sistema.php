<?php
	session_start();
	require('banco.php');

	if(isset($_POST['email']) && isset($_POST['password'])){
		$email = $conecta_banco->real_escape_string($_POST['email']);
		$senha = $conecta_banco->real_escape_string($_POST['password']);
		$senha = hash("sha256", hash("sha256", $senha));

		$c_empresa = "SELECT * FROM empresas where emailE = '$email' AND senhaE = '$senha'";
		$v_empresa =  $conecta_banco->query($c_empresa);

		if($v_empresa->num_rows == 1){
			$coluna_empresa = mysqli_fetch_array($v_empresa);
			$_SESSION['id'] = $coluna_empresa['idE'];
			$_SESSION['nome'] = $coluna_empresa['nomeE'];
			$_SESSION['email'] = $coluna_empresa['emailE'];
			$_SESSION['senha'] = $coluna_empresa['senhaE'];
			$_SESSION['empresa'] = $coluna_empresa['idE'];
			$_SESSION['perfil'] = $coluna_empresa['perfilE'];
			$id_arquivo = $coluna_empresa['idE'];
			$c_logo = "SELECT * FROM imagensperfil where empresaI = '$id_arquivo'";
			$v_logo =  $conecta_banco->query($c_logo);
			$coluna_logo = mysqli_fetch_array($v_logo);
			$_SESSION['logo'] = $coluna_logo['arquivoI'];
		} else {
			$c_pessoa = "SELECT * FROM pessoas where emailP = '$email' AND senhaP = '$senha'";
			$v_pessoa =  $conecta_banco->query($c_pessoa);
			if($v_pessoa->num_rows == 1){
				$coluna_pessoa = mysqli_fetch_array($v_pessoa);
				$_SESSION['id'] = $coluna_pessoa['idP'];
				$_SESSION['nome'] = $coluna_pessoa['nomeP'];
				$_SESSION['email'] = $coluna_pessoa['emailP'];
				$_SESSION['senha'] = $coluna_pessoa['senhaP'];
				$_SESSION['rg'] = $coluna_pessoa['rgP'];
				$_SESSION['cpf'] = $coluna_pessoa['cpfP'];
				$_SESSION['telefone'] = $coluna_pessoa['telefoneP'];
				$_SESSION['cep'] = $coluna_pessoa['cepP'];
				$_SESSION['sexo'] = $coluna_pessoa['sexoP'];
				$_SESSION['perfil'] = $coluna_pessoa['perfilP'];
				$_SESSION['empresa'] = $coluna_pessoa['empresaP'];
				if($_SESSION['empresa'] > 0){
					$idarquivo = $coluna_pessoa['empresaP'];
					$c_logo = "SELECT * FROM imagensperfil where empresaI = '$idarquivo'";
					$v_logo =  $conecta_banco->query($c_logo);
					$coluna_logo = mysqli_fetch_array($v_logo);
					$_SESSION['logo'] = $coluna_logo['arquivoI'];
				} else {
					$_SESSION['logo'] = 'logo.jpg';
				}
			} else {
				unset($_SESSION['id']);
				unset($_SESSION['nome']);
				unset($_SESSION['email']);
				unset($_SESSION['senha']);
				unset($_SESSION['perfil']);
				unset($_SESSION['logo']);
				unset($_SESSION['empresa']);
				header('Location: ../login.php');
			}
		}
	}

	if($_SESSION['perfil'] == 1){
		header('Location: administrador/index.php');
	} else if($_SESSION['perfil'] == 2 || $_SESSION['perfil'] == 3){
		header('Location: empresas/index.php');
	} else if($_SESSION['perfil'] > 3){
		header('Location: motoristas/index.php');
	}
?>
