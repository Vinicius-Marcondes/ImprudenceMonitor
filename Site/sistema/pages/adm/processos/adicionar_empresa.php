<?php 
	// Inicialização
	require('../../conexao_banco.php');
	session_start();
	
	if($_POST){
		// Pegando dados fornecidos
		$id = $_SESSION['empresa'];
		$nome = $_POST['nome'];
		$email = $_POST['email'];
		$cnpj = $_POST['cnpj'];
		$telefone = $_POST['telefone'];
		$cep = $_POST['cep'];

		$senha = $conexao_bd->real_escape_string($_POST['senha']); 
		$senha = hash("sha256", hash("sha256", $senha));

		// Verrificações
		$selecao_email = "SELECT * FROM empresa WHERE EMAIL_EMPRESA = '$email'";
		$consulta_email = $conexao_bd->query($selecao_email);
		if($consulta_email->num_rows != 0){ 
			unset($email);
		} 
		
		$selecao_cnpj = "SELECT * FROM empresa WHERE CNPJ_EMPRESA = '$rg'";
		$consulta_cnpj = $conexao_bd->query($selecao_cnpj);
		if($consulta_cnpj->num_rows != 0){ 
			unset($cnpj);
		}

		if(isset($email) && isset($cnpj)){
			$selecao_empresa = "INSERT INTO empresa (NOME_EMPRESA, EMAIL_EMPRESA, CNPJ_EMPRESA, SENHA_EMPRESA, CEP_EMPRESA, TELEFONE_EMPRESA, PERFIL_ID_EMPRESA) 
			VALUES ('$nome', '$email', '$cnpj', '$senha', '$cep', '$telefone', 2)";
			$add_empresa = $conexao_bd->query($selecao_empresa);

			if($add_empresa == true){
				$extensao = strtolower(substr($_FILES['arquivo']['name'], -4));
				$novo_nome = md5(time()). $extensao;
				$diretorio = "../../../images/1_empresas/";
				move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novo_nome);

				$selecao_empresa = "SELECT * FROM empresa WHERE EMAIL_EMPRESA = '$email'";
				$consulta_empresa = mysqli_fetch_array($conexao_bd->query($selecao_empresa));
				$id = $consulta_empresa['ID_EMPRESA'];

				$selecao_img = "INSERT INTO imagens_empresas_pessoas (ARQUIVO_IMAGENS, EMPRESA_ID_IMAGENS) 
				VALUES ('$novo_nome', $id)";
				$add_img = $conexao_bd->query($selecao_img);

				if($add_img == true){
					$_SESSION['msg_empresa'] = "<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Cadastro efetuado com sucesso.</div>";
					header("Location: ../empresas.php");
				} else {
					$_SESSION['msg_empresa'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro no cadastro, verifique seus dados e tente novamente!</div>";
					header("Location: ../empresas.php");
				}
			} else {
				$_SESSION['msg_empresa'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro no cadastro, verifique seus dados e tente novamente!</div>";
				header("Location: ../empresas.php");
			}
		} else {
			$_SESSION['msg_empresa'] = "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>Erro no cadastro, dados não foram fornecidos!</div>";
			header("Location: ../empresas.php");
		}
	}
?>