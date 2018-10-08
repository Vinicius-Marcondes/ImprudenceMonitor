<?php
	// Inicialização
	session_start();
	require('conexao_banco.php');
	
	// Verificação da conta
	if(isset($_POST['email']) && isset($_POST['senha'])){
		$email = $conexao_bd->real_escape_string($_POST['email']);
		$senha = $conexao_bd->real_escape_string($_POST['senha']);
		$senha = hash("sha256", hash("sha256", $senha));
		
		// Selecionar empresa com email e senha correspondente
		$selecao_empresa = "SELECT * FROM empresa INNER JOIN perfil ON empresa.PERFIL_ID_EMPRESA = perfil.ID_PERFIL WHERE EMAIL_EMPRESA = '$email' AND SENHA_EMPRESA = '$senha'";
		$consulta_empresa = $conexao_bd->query($selecao_empresa);

		if($consulta_empresa->num_rows == 1){
			$empresa = mysqli_fetch_array($consulta_empresa);
			$_SESSION['id'] = $empresa['ID_EMPRESA'];
			$_SESSION['nome'] = $empresa['NOME_EMPRESA'];
			$_SESSION['email'] = $empresa['EMAIL_EMPRESA'];
			$_SESSION['senha'] = $empresa['SENHA_EMPRESA'];
			$_SESSION['perfil'] = $empresa['PERFIL_ID_EMPRESA'];
			$_SESSION['funcao'] = $empresa['NOME_PERFIL'];
			$id = $_SESSION['id'];
			$selecao_imagem = "SELECT * FROM imagens_empresas_pessoas WHERE EMPRESA_ID_IMAGENS = $id";
			$consulta_imagem = $conexao_bd->query($selecao_imagem);
			if($consulta_imagem->num_rows == 1){
				$logo = mysqli_fetch_array($consulta_imagem);
				$_SESSION['logo'] = $logo['ARQUIVO_IMAGENS'];
			} else {
					$_SESSION['logo'] = "padrao.png";
			}
		} else {
			// Selecionar pessoa com email e senha correspondente
			$selecao_pessoa = "SELECT * FROM pessoas INNER JOIN perfil ON pessoas.PERFIL_ID_PESSOAS = perfil.ID_PERFIL WHERE EMAIL_PESSOAS = '$email' AND SENHA_PESSOAS = '$senha'";
			$consulta_pessoa = $conexao_bd->query($selecao_pessoa);
			if($consulta_pessoa->num_rows == 1){
				$pessoa = mysqli_fetch_array($consulta_pessoa);
				$_SESSION['id'] = $pessoa['ID_PESSOAS'];
				$_SESSION['nome'] = $pessoa['NOME_PESSOAS'];
				$_SESSION['email'] = $pessoa['EMAIL_PESSOAS'];
				$_SESSION['senha'] = $pessoa['SENHA_PESSOAS'];
				$_SESSION['perfil'] = $pessoa['PERFIL_ID_PESSOAS'];
				$_SESSION['empresa'] = $pessoa['EMPRESA_ID_PESSOAS'];
				$_SESSION['funcao'] = $pessoa['NOME_PERFIL'];
				$_SESSION['lock'] = false;
				$id = $_SESSION['id'];
				$selecao_imagem = "SELECT * FROM imagens_empresas_pessoas WHERE PESSOAS_ID_IMAGENS = $id";
				$consulta_imagem =  $conexao_bd->query($selecao_imagem);
				if($consulta_imagem->num_rows == 1){
					$logo = mysqli_fetch_array($consulta_imagem);
					$_SESSION['logo'] = $logo['ARQUIVO_IMAGENS'];
				} else {
					$_SESSION['logo'] = "padrao.png";
				}
			} else {
				// Pessoa com email e senha correspondente não encontrada
				unset($_SESSION['perfil']);
				$_SESSION['msg_login'] = "Você não atendeu aos requisitos para entrar no sistema!";
				header('Location: ../index.php');
			}
		} 
	}

	switch ($_SESSION['perfil']){
    	case 1:
        	header('Location: adm/index.php');
        	break;
    	case 2:
        	header('Location: empresa/index.php');
        	break;
    	case 3:
        	header('Location: comum/index.php');
        	break;
    	case 4:
    		header('Location: comum/index.php');
       		break;
    	default:
    		// Falha na verificação
    		$_SESSION['msg_login'] = "Você não atendeu aos requisitos para entrar no sistema!";
    		header('Location: ../index.php');
	}
?>