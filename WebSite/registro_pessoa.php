<?php 
	// Inicializa??o
	require('pages/conexao_banco.php');
	session_start();
	
	if($_POST){
		// Pegando dados fornecidos
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$cpf = $_POST['cpf'];
		$rg = $_POST['rg'];
		$cep = $_POST['cep'];
		$sexo =  $_POST['sexo'];
		$telefone = $_POST['telefone'];
		$celular = $_POST['celular'];
		$senha = $conexao_bd->real_escape_string($_POST['senha']); 
		$senha = hash("sha256", hash("sha256", $senha));
	
		// Verrifica??es
		$selecao_email = "SELECT * FROM pessoas where EMAIL_PESSOAS = '$email'";
		$consulta_email =  $conexao_bd->query($selecao_email);
		if($consulta_email->num_rows != 0){ 
			unset($email);
		} 
		
		$selecao_rg = "SELECT * FROM pessoas where RG_PESSOAS = '$rg'";
		$consulta_rg =  $conexao_bd->query($selecao_rg);
		if($consulta_rg->num_rows != 0){ 
			unset($rg);
		}
		
		$selecao_cpf = "SELECT * FROM pessoas where CPF_PESSOAS = '$cpf'";
		$consulta_cpf =  $conexao_bd->query($selecao_cpf);
		if($consulta_cpf->num_rows != 0){ 
			unset($cpf);
		}
		// Inser??o dos Dados
		if(isset($email) && isset($rg) && isset($cpf)){
			$selecao_pessoa = "INSERT INTO pessoas (NOME_PESSOAS, EMAIL_PESSOAS, CPF_PESSOAS, RG_PESSOAS, CEP_PESSOAS, TELEFONE_PESSOAS, CELULAR_PESSOAS, SENHA_PESSOAS, SEXO_PESSOAS, PERFIL_ID_PESSOAS, EMPRESA_ID_PESSOAS) 
			VALUES ('$nome', '$email', '$cpf', '$rg', '$cep', '$telefone', '$celular', '$senha', '$sexo', '4', NULL)";
			$add_pessoa = $conexao_bd->query($selecao_pessoa);
			if($add_pessoa == true){
				$extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
				$novo_nome = md5(time()). $extensao;
				$diretorio = "images/0_pessoas/";
				move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);
			
				$selecao_pessoa = "SELECT * FROM pessoas WHERE EMAIL_PESSOAS = '$email'";
				$consulta_pessoa = mysqli_fetch_array($conexao_bd->query($selecao_pessoa));
				$id = $consulta_pessoa['ID_PESSOAS'];
			
				$selecao_img = "INSERT INTO imagens_empresas_pessoas (ARQUIVO_IMAGENS, PESSOAS_ID_PESSOAS) 
				VALUES ('$novo_nome', '$id')";
				$add_img = $conexao_bd->query($selecao_img);
				if($add_img == true){
					$_SESSION['msg_login2'] = "<span style='color: green;'>Cadastro efetuado com sucesso</span>";
					header("Location: index.php");
				} else{
					$_SESSION['msg_registro'] = "Erro no cadastro, verifique seus dados e tente novamente!";
					header("Location: criar_conta.php");
				}
			} else {
				$_SESSION['msg_registro'] = "Erro no cadastro, verifique seus dados e tente novamente!";
				header("Location: criar_conta.php");
			}
		} else {
			$_SESSION['msg_registro'] = "Erro, j? existe um cadastro com esses dados!";
			header("Location: criar_conta.php");
		}
	} else {
		$_SESSION['msg_registro'] = "Erro no cadastro, dados n?o foram fornecidos!";
		header("Location: criar_conta.php");
	}
?>